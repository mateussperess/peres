<?php

namespace Source\App;


use Source\Models\User;
use League\Plates\Engine;
use Source\Models\Category;
use Source\Models\Propertie;


header("Access-Control-Allow-Origin: *");
class Web
{
  private $view;
  private $categories;
  private $properties;

  public function __construct()
  {
    $propertie = new Propertie();
    // $this->properties = $propertie->selectAll();
    $categorie = new Category();
    // $this->categories = $categorie->selectAll();
    $this->view = new Engine(CONF_VIEW_WEB, 'php');
  }

  // public function home() : void
  // {
  //     $propertie = new Propertie();
  //     $properties = $propertie->selectAll();

  //     echo $this->view->render("home",
  //         [
  //             "categories" => $this->categories,
  //             "properties" => $properties
  //         ]
  //     );
  // }

  public function home(): void
  {
    echo $this->view->render(
      "home",
      [
        "properties" => $this->properties,
        "categories" => $this->categories
      ]
    );
  }

  public function properties(?array $data): void
  {
    if (!empty($data)) {
      $propertie = new Propertie();
      $properties = $propertie->findByCategory($data["idCategory"]);
    }
    echo $this->view->render(
      "properties",
      [
        "categories" => $this->categories,
        "properties" => $this->properties
      ]
    );
  }


  public function about(): void
  {
    echo $this->view->render(
      "about"
    );
  }

  public function contact(array $data): void
  {
    var_dump($data);
    echo $this->view->render("contact");
  }

  public function error(array $data): void
  {
    echo $this->view->render("404", [
      "title" => "Erro {$data["errcode"]} | " . CONF_SITE_NAME,
      "error" => $data["errcode"]
    ]);
  }

  public function login(?array $data): void
  {
    if (!empty($data)) {
      $user = new User();

      if (!$user->validate($data["mail"], $data["password"])) {
        $json = [
          "message" => $user->getMessage(),
          "type" => "error"
        ];
        echo json_encode($json);
        return;
      }

      $json = [
        "first_name" => $user->getFirstName(),
        "mail" => $user->getMail(),
        "message" => $user->getMessage(),
        "type" => "success"
      ];
      echo json_encode($json);
      return;
    }
    echo $this->view->render("login");
  }


  public function register(?array $data): void
  {
    if (!empty($data)) {

      if (in_array("", $data)) {
        $json = [
          "message" => "Informe nome, e-mail e senha para cadastrar!",
          "type" => "warning"
        ];

        echo json_encode($json);
        return;
      }

      if (!is_email($data["mail"])) {
        $json = [
          "message" => "Por favor, informe um e-mail válido!",
          "type" => "warning"
        ];
        echo json_encode($json);
        return;
      }

      $user = new User();

      if ($user->findByEmail($data["mail"])) {
        // echo 'entrou aqui';
        $json = [
          "message" => "Email já cadastrado!",
          "type" => "warning"
        ];
        echo json_encode($json);
        return;
      }

      $user = new User(
        null,
        $data["first_name"],
        $data["last_name"],
        $data["mail"],
        $data["password"]
      );

      if (!$user->insert()) {
        $json = [
          "message" => $user->getMessage(),
          "type" => "error"
        ];
        echo json_encode($json);
        return;
      } else {
        $json = [
          "first_name" => $data["first_name"],
          "last_name" => $data["last_name"],
          "message" => $user->getMessage(),
          "type" => "success"
        ];
        echo json_encode($json);
        return;
      }

      // Usuário salvo com sucesso
      return;
    }

    echo $this->view->render(
      "register"
    );
  }
}
