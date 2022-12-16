<?php

namespace Source\App;

use Source\Models\Propertie;
use Source\Models\User;

class Api
{
    private $user;

    // public function __construct()
    // {
    //     header('Content-Type: application/json; charset=UTF-8');
    //     $headers = getallheaders();
    //     if(empty($headers["Email"]) || empty($headers["Password"]) || empty($headers["Rule"])){
    //         $response = [
    //             "code" => 400,
    //             "type" => "bad_request",
    //             "message" => "Informe E-mail, Senha e Tipo de Usuário para acessar"
    //         ];
    //         echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    //         return;
    //     }

    //     $this->user = new User();
    //     if(!$this->user->validate($headers["Email"],$headers["Password"])){
    //         $response = [
    //             "code" => 401,
    //             "type" => "unauthorized",
    //             "message" => "E-mail ou Senha inválidos"
    //         ];
    //         echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    //         return;
    //     }
    // }

    public function getUser()
    {
        header('Content-Type: application/json; charset=UTF-8');
        $headers = getallheaders();
        if(empty($headers["Email"]) || empty($headers["Password"]) || empty($headers["Rule"])) {
            $response = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Informe E-mail, Senha e Tipo de Usuário para acessar"
            ];
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $user = new User();

        if(!$user->validate($headers["Email"], $headers["Password"])) {
          $response = [
            "code" => 401,
            "type" => "unauthorized",
            "message" => $user->getMessage()
          ];
          echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
          return;
        }

//        $response = [
//          "code" => 200,
//          "type" => "success",
//          "messsage" => $user->getMessage(),
//          $user->getArray()
//        ];
        echo json_encode($user->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        // var_dump($headers);
        // echo "Olá, getUser";
        // echo json_encode($this->user->getArray(),JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

  public function getProperties(array $data)
    {
      var_dump($data);
//      echo "Olá, propriedades!";
    }

    

    // public function getProjects()
    // {
    //     echo "Olá projetos";
    // }

    // public function getProject(array $data) : void
    // {
    //     if(!empty($data)){
    //         var_dump($data);
    //         $propertie = new Propertie();
    //         // $propertie->findByid(12);
    //     }
    // }
}