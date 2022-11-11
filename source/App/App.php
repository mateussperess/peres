<?php


namespace Source\App;

use League\Plates\Engine;
use Source\Models\Category;
use Source\Models\Propertie;

class App
{

    private $view;
    private $categories;

    public function __construct()
    {
        if(empty($_SESSION["user"]) || empty($_COOKIE["user"])){
            header("Location:http://www.localhost/peres/");
        }

        $categories = new Category();
        $this->categories = $categories->selectAll();
        $this->view = new Engine(CONF_VIEW_APP,'php');
    }

    public function home() : void
    {

        // echo "Olá, {$_SESSION["user"]["name"]}<br>";

        $propertie = new Propertie();
        $properties = $propertie->selectAll();

        echo $this->view->render("home",
            [
                "categories" => $this->categories,
                "properties" => $properties
            ]
        );
    }

    public function PropertyRegister(array $data) : void
    {
        // 
    }

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
        header("Location:http://www.localhost/peres/");
    }
}
?>