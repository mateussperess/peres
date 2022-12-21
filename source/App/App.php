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

    // public function __construct()
    // {
    //     if(empty($_SESSION["user"]) || empty($_COOKIE["user"])){
    //         header("Location:http://www.localhost/peres/");
    //     }

    //     $categories = new Category();
    //     $this->categories = $categories->selectAll();
    //     $this->view = new Engine(CONF_VIEW_APP,'php');
    // }

    // public function home() : void
    // {

    //     // echo "Olá, {$_SESSION["user"]["name"]}<br>";

    //     $propertie = new Propertie();
    //     $properties = $propertie->selectAll();

    //     echo $this->view->render("home",
    //         [
    //             "categories" => $this->categories,
    //             "properties" => $properties
    //         ]
    //     );
    // }
    
    public function __construct()
    {
        if(empty($_SESSION["user"]) || empty($_COOKIE["user"])){
            header("Location:http://www.localhost/peres/login");
        }

        $this->view = new Engine(CONF_VIEW_APP,'php');
    }

    public function home () : void
    {
        echo "Olá, {$_SESSION["user"]["name"]}<br>";
        echo "O ID: {$_SESSION["user"]["id"]}<br>";
        echo "O email é : {$_SESSION["user"]["email"]}<br>";
        echo $this->view->render("home");
    }
    
    public function anuncio(array $data) : void
    {
        $categories = new Category();
        $categoriesList = $categories->selectAll();

        if(!empty($data)){
            $data = filter_var_array($data,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $propertie = new Propertie(
                null,
                $data["title"],
                $data["price"],
                "teste",
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
                "image" => null,
                "description" => $data["description"],
                "idCategory" => $data["idCategory"],
                "teste" => $idPropertie,
                "teste2" => $createPropertie->getIdUser()
            ];

            echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
        echo $this->view->render("anunciar",[
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

    public function list () : void 
    {
        require __DIR__ . "/../../themes/app/list.php";
    }

    public function createPDF () : void
    {
       require __DIR__ . "/../../themes/app/create-pdf.php";
    }

    public function logout()
    {
        session_destroy();
        setcookie("user","Logado",time() - 3600,"/");
        header("Location:http://www.localhost/peres/login");
    }

   public function profile(array $data) : void
    {

        $user = new User($_SESSION["user"]["id"]);
        $user->findById();

        // var_dump($user);

        echo $this->view->render("profile",
            [
                "user" => $_SESSION["user"]
            ]);
    }

    public function profileUpdate(array $data) : void
    {
        if(!empty($data)){

            $data = filter_var_array($data,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if(in_array("",$data)){
                $json = [
                    "message" => "Informe Nome e Email...",
                    "type" => "alert-danger"
                ];
                echo json_encode($json);
                return;
            }
            if(!is_email($data["email"])){
                $json = [
                    "message" => "Informe um e-mail válido...",
                    "type" => "alert-danger"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User(
                $_SESSION["user"]["id"],
                $data["name"],
                $data["email"],
                null
                // null
                // $upload
            );

//          echo json_encode($user->getId());
//          return;

            $user->update();
            $json = [
                "message" => $user->getMessage(),
                "type" => "alert-success",
                "name" => $user->getName(),
                "email" => $user->getEmail()
                // "photo" => url($user->getPhoto())
            ];
            echo json_encode($json);
        }
    }
}
?>