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

    public function __construct()
    {
        $categories = new Category();
        $this->categories = $categories->selectAll();
        $this->view = new Engine(CONF_VIEW_WEB,'php');
    }

    public function home() : void
    {
        $propertie = new Propertie();
        $properties = $propertie->selectAll();

        echo $this->view->render("home",
            [
                "categories" => $this->categories,
                "properties" => $properties
            ]
        );
    }
    
    public function properties (?array $data) : void
    {
        if(!empty($data)){
            $propertie = new Propertie();
            $properties = $propertie->findByCategory($data["idCategory"]);
        }
        echo $this->view->render(
            "properties",[
                "categories" => $this->categories,
                "properties" => $properties
            ]
        );
    }

    public function anunciar() : void
    {
        echo $this->view->render(
            "anunciar",
            []);
    }

    public function about() : void
    {
        echo $this->view->render(
            "about",
            ["name" => "Fábio", "age" => 46]
        );

    }

    public function contact(array $data) : void
    {
        var_dump($data);
        echo $this->view->render("contact");
    }

    public function error(array $data) : void
    {
//      echo "<h1>Erro {$data["errcode"]}</h1>";
//      include __DIR__ . "/../../themes/web/404.php";
        echo $this->view->render("404", [
            "title" => "Erro {$data["errcode"]} | " . CONF_SITE_NAME,
            "error" => $data["errcode"]
        ]);
    }

    public function login(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "Informe e-mail e senha para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if(!$user->validate($data["email"],$data["password"])){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "message" => $user->getMessage(),
                "type" => "success"
            ];
            echo json_encode($json);
            return;

        }
        echo $this->view->render(
            "login");

    }

    public function register(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("", $data)) {
                $json = [
                    "message" => "Informe nome, e-mail e senha para cadastrar!",
                    "type" => "warning"
                ];

                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if($user->findByEmail($data["email"])){
                $json = [
                    "message" => "Email já cadastrado!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User(
                null,
                $data["name"],
                $data["email"],
                $data["password"]
            );

            if(!$user->insert()){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data["name"],
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
        "register");
    }
}