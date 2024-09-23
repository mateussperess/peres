<?php


namespace Source\App;

use League\Plates\Engine;
use Source\Models\Category;
use Source\Models\CreatePropertie;
use Source\Models\Propertie;
use Source\Models\User;
use CoffeeCode\Uploader\Image;

class App
{

  private $view;
  private $categories;
  private $properties;

  public function __construct()
  {
    if (empty($_SESSION["user"]) || empty($_COOKIE["user"])) {
      header("Location:http://www.localhost/peres/login");
    }

    $properties = new Propertie();
    $categories = new Category();

    //   $this->categories = $categories->selectAll();
    //   $this->properties = $properties->selectAll();
    $this->view = new Engine(CONF_VIEW_APP, 'php');
  }

  public function home(): void
  {
    echo "Olá, {$_SESSION["user"]["first_name"]}<br>";
    echo "O ID: {$_SESSION["user"]["id"]}<br>";
    echo "O email é : {$_SESSION["user"]["mail"]}<br>";
    echo $this->view->render("home", ["categories" => $this->categories]);
  }

  public function anuncio(array $data): void
  {
    $categories = new Category();
    $categoriesList = $categories->selectAll();

    if (!empty($data)) {
      $data = filter_var_array($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $uploadImage = uploadImage($_FILES['image']);

      $propertie = new Propertie(
        null,
        $data["title"],
        $data["price"],
        $uploadImage,
        $data["description"],
        $data["idCategory"]
      );

      //            $propertie->insert();

      $idPropertie = $propertie->insert();

      $createPropertie = new CreatePropertie(
        NULL,
        $idPropertie,
        $_SESSION["user"]["id"]
      );

      $createPropertie->createPropertieInsert();

      $json = [
        "id" => $propertie->getId(),
        "title" => $data["title"],
        "price" => $data["price"],
        "image" => $data["image"],
        "description" => $data["description"],
        "idCategory" => $data["idCategory"],
        "teste" => $idPropertie,
        "teste2" => $createPropertie->getIdUser()
      ];

      echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      return;
    }
    echo $this->view->render("anunciar", [
      "categoriesList" => $categoriesList
    ]);
  }

  //  public function properties (?array $data) : void
  //  {
  //    if(!empty($data)){
  //      $propertie = new Propertie();
  //      $properties = $propertie->findByCategory($data["idCategory"]);
  //    }
  //    echo $this->view->render(
  //        "properties",[
  //            "categories" => $this->categories,
  //            "properties" => $properties
  //        ]
  //    );
  //  }

  public function list(): void
  {
    require __DIR__ . "/../../themes/app/list.php";
  }

  public function createPDF(): void
  {
    require __DIR__ . "/../../themes/app/create-pdf.php";
  }

  public function logout()
  {
    session_destroy();
    setcookie("user", "Logado", time() - 3600, "/");
    header("Location:http://www.localhost/peres/login");
  }

  public function profile($id): void
  {

    $user = new User($_SESSION["user"]["id"]);
    $user->findById();

    // var_dump($user);

    echo $this->view->render(
      "profile",
      [
        "user" => $user // passando o objeto user para a view
      ]
    );
  }

  public function profileUpdate(): void
  {
    $data = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Recupera os dados atuais do usuário
    $user = new User($_SESSION["user"]["id"]);
    $user->findById();

    // Verifica se os dados foram alterados
    $updateRequired = false;
    $changes = [];

    if ($data["first_name"] !== $user->getFirstName()) {
      $changes[] = "Nome";
      $updateRequired = true;
    }
    if ($data["last_name"] !== $user->getLastName()) {
      $changes[] = "Sobrenome";
      $updateRequired = true;
    }
    if ($data["mail"] !== $user->getMail()) {
      $changes[] = "Email";
      $updateRequired = true;
    }

    if ($updateRequired) {
      // Se a flag for true, atualiza os dados
      $user->setFirstName($data["first_name"]);
      $user->setLastName($data["last_name"]);
      $user->setMail($data["mail"]);

      if ($user->update()) {
        $_SESSION["user"]["first_name"] = $user->getFirstName();
        $_SESSION["user"]["last_name"] = $user->getLastName();
        $_SESSION["user"]["mail"] = $user->getMail();

        $changesList = implode(", ", $changes); // Converte o array de mudanças em string

        echo json_encode([
          "message" => "Dados atualizados com sucesso: {$changesList}.",
          "type" => "alert-success",
          "first_name" => $user->getFirstName(),
          "last_name" => $user->getLastName(),
          "mail" => $user->getMail(),
        ]);
      } else {
        echo json_encode([
          "message" => "Erro ao atualizar os dados. Tente novamente.",
          "type" => "alert-danger"
        ]);
      }
    } else {
      // Se não houver alterações, pode retornar uma mensagem informando que nada foi alterado
      echo json_encode([
        "message" => "Nenhuma alteração foi feita.",
        "type" => "alert-info"
      ]);
    }
  }
}
