<?php

namespace Source\App;

use Source\Models\Propertie;
use Source\Models\User;

class Api
{
    private $user;
    private $propertie;

    public function __construct()
    {
      header('Content-Type: application/json; charset=UTF-8');
      $headers = getallheaders();
      $this->user = new User();
      $this->propertie = new Propertie();

      if($headers["Rule"] === "N"){
        return;
      }

      if($headers["Rule"] === "P") {
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

//    Métodos relacionados à entidade usuário

    public function getUser()
    {
      if ($this->user->getId() != null) {
        $response = [
          "Retorno da Requisição" => [
            "code" => 200,
            "type" => "success",
            "message" => "User encontrado com sucesso!"
          ],
          "Dados do User" => [
            "ID" => $this->user->getId(),
            "Nome" => $this->user->getName(),
            "Email" => $this->user->getEmail()
//            $this->user->getArray() -> substituí o método getArray por esse padrão de objeto em json, padronizando com os outros retornos da classe Api;
          ]
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      }
    }

  public function updateUser(array $data)
  {
    if ($this->user->getId() != null) {
      $this->user->setName($data["name"]);
      $this->user->setEmail($data["email"]);
      $this->user->update();

      $response = [
        "Retorno da Requisição" => [
          "code" => 200,
          "type" => "success",
          "message" => "Usuário alterado com sucesso!"
        ],
        "Dados alterados" => [
          "Nome" => $this->user->getName(),
          "Email" => $this->user->getEmail()
        ]
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
      "Retorno da Requisição" => [
        "code" => 201,
        "type" => "success",
        "message" => "Usuário cadastrado com sucesso! Confira os dados:"
      ],
      "Dados do Usuário" => [
        "Email" => $this->user->getEmail(),
        "Name:" => $this->user->getName(),
        "Password:" => $this->user->getPassword()
      ]
    ];
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  }
////////////////////////////////////////////////////////////////
//  Métodos relacionados à entidade principal (propriedades)  //

  public function getProperties(array $data)
    {

      if(!empty($data["id"])) {
        $propertie = new Propertie($data["id"]);

        if(!$propertie->findById()) {
          $response = [
            "code" => 404,
            "type" => "bad-request",
            "message" => "Propriedade não encontrada!"
          ];
          echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
          return;
        }

        $response = [
          "Retorno de Requisição" => [
            "code" => 200,
            "type" => "success",
            "message" => "Propriedade encontrada!",
          ],
          "Atributos" => [
            "id da propriedade" => $propertie->getId(),
            "título da propriedade" => $propertie->getTitle(),
            "descrição da propriedade" => $propertie->getDescription(),
            "preço da propiedade" => $propertie->getPrice(),
            "id da categoria da propriedade" => $propertie->getIdCategory()
          ]
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
      }
    }


  public function createPropertie(array $data)
  {

  }
}