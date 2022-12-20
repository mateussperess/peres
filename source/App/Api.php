<?php

namespace Source\App;

use Source\Models\Propertie;
use Source\Models\User;

class Api
{
    private $user;

    public function __construct()
    {
      header('Content-Type: application/json; charset=UTF-8');
      $headers = getallheaders();
      $this->user = new User();

      if($headers["Rule"] === "N"){
        return;
      }

      if(empty($headers["Email"]) || empty($headers["Password"]) || empty($headers["Rule"])) {
        $response = [
          "code" => 400,
          "type" => "bad_request",
          "message" => "Campos Email/Senha não preenchidos corretamente!"
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
      }

      if(!$this->user->validate($headers["Email"], $headers["Password"])) {
        $response = [
          "code" => 401,
          "type" => "unauthorized",
          "message" => $this->user->getMessage()
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
      }
    }

    public function getUser()
    {
      if ($this->user->getId() != null) {
        echo json_encode($this->user->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      }
    }

  public function updateUser(array $data)
  {
    if ($this->user->getId() != null) {
      $this->user->setName($data["name"]);
      $this->user->setEmail($data["email"]);
      $this->user->update();

      $response = [
        "code" => 200,
        "type" => "success",
        "message" => "Usuário alterado com sucesso!"
      ];

      echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
//    echo "Alterando dados do usuário";
  }

  public function createUser(array $data)
  {
    if($this->user->findByEmail($data["email"])) {
      $response = [
        "code" => 400,
        "type" => "bad-request",
        "message" => "Email já cadastrado!"
      ];
      echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      return;
    }

//    parametrização de dados recebidos
    $this->user->setName($data["name"]);
    $this->user->setEmail($data["email"]);
    $this->user->setPassword($data["password"]); // vou colocar mais atributos, fiz a estrutura inicial para poder apresentar apenas

// inserção de dados através do método insert
    $this->user->insert();

    $response = [
      "code" => 201,
      "type" => "success",
      "message" => "Usuário cadastrado com sucesso! Confira os dados:",
      "Email" => $this->user->getEmail(),
      "Name:" => $this->user->getName(),
      "Password:" => $this->user->getPassword()
    ];

    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
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