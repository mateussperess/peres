<?php

namespace Source\App;

use Source\Models\Propertie;
use Source\Models\User;
use Source\Models\CreatePropertie;

// IDEAL QUE OS RETORNOS SEJAM TODOS MINUSCULOS E INGLES, SEM ACENTOS OU CARACTERES ESPECIAIS
// A API SE TRATA DE DESENVOLVIMENTO, E NÃO DE CONSUMO DO USUÁRIO

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

      // if($headers["Rule"] === "P") {
      //   return;
      // }

      if($headers["Rule"] === "A") {
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
          "requisition" => [
            "code" => 200,
            "type" => "success",
            "message" => "User encontrado com sucesso!",
            "action" => "user returned"
          ],
          "user" => [
            "id" => $this->user->getId(),
            "name" => $this->user->getName(),
            "email" => $this->user->getEmail(),
            "photo" => empty($this->user->getPhoto()) ? "Sem foto..." : $this->user->getPhoto()
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
        "requisition" => [
          "code" => 200,
          "type" => "success",
          "message" => "Usuário alterado com sucesso!",
          "action" => "user updated"
        ],
        "user" => [
          "Name" => $this->user->getName(),
          "Email" => $this->user->getEmail(),
          "Photo" => empty($this->user->getPhoto()) ? "Sem foto..." : $this->user->getPhoto()
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
      "requisition" => [
        "code" => 201,
        "type" => "success",
        "message" => "user inserted"
      ],
      "user" => [
        "Email" => $this->user->getEmail(),
        "Name:" => $this->user->getName()
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
          "requisition" => [
            "code" => 200,
            "type" => "success",
            "message" => "Propriedade encontrada!",
            "action" => "propertie founded"
          ],
          "propertie" => [
            "idPropertie" => $propertie->getId(),
            "title" => $propertie->getTitle(),
            "description" => $propertie->getDescription(),
            "price" => $propertie->getPrice(),
            "idCategory" => $propertie->getIdCategory()
          ]
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
      }
    }


  public function createPropertie(array $data)
  {
    if($data["idCategory"] > 3) {
      $response = [
          "code" => 404,
          "type" => "bad-request",
          "message" => "Categoria não é válida!",
          "action" => "category not valid",

          "Categorias Disponíveis" => [
           "1" => "Apartamento",
           "2" => "Casa",
           "3" => "Terreno"
          ]
      ];

      echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      return;
    }

    $propertie = new Propertie();
    $propertie->setTitle($data["title"]);
    $propertie->setPrice($data["price"]);
    $propertie->setImage($data["image"]);
    $propertie->setDescription($data["description"]);
    $propertie->setIdCategory($data["idCategory"]);

    $propertie->insert();

    $createPropertie = new CreatePropertie(
      NULL,
      $propertie->getId(),
      $this->user->getId()    
    );

    $createPropertie->createPropertieInsert();

    $response = [
        "requisition" => [
            "code" => 201,
            "type" => "success",
            "message" => "Propriedade cadastrada com sucesso! Confira os dados:",
            "action" => "propertie created"
        ],
        "propertie" => [
            "title" => $propertie->getTitle(),
            "price" => $propertie->getPrice(),
            "image" => $propertie->getImage(),
            "description" => $propertie->getDescription(),
            "category" => $propertie->getIdCategory(),
            "idUser" => $this->user->getId(),
            "idPropertie" => $propertie->getId()
        ]
    ];
    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return;
  }

//  Adm Methods
  public function getUserAsAdm(array $data)
  {
    if (!empty($data["id"])) {
      $user = new User($data["id"]);

      if (!$user->findById()) {
        $response = [
            "code" => 404,
            "type" => "bad-request",
            "message" => "User não encontrado!",
            "action" => "invalid user id"
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
      }

      $response = [
        "requisition" => [
          "code" => 200,
          "type" => "success",
          "message" => "User encontrado!",
          "action" => "user founded"
        ],
        "user" => [
          "id" => $user->getId(),
          "Name" => $user->getName(),
          "Email" => $user->getEmail(),
          "Photo" => $user->getPhoto()
          ]
      ];

      echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      return;

//    echo json_encode($data);
    }
  }

  public function getAllUsers()
  {
    $user = new User();

    $user->selectAll();

    echo json_encode($user, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
  }

  public function getPropertiebyName(array $data) {

    // echo json_encode($data);
    // return; 

    if(!empty($data["title"])) {
      $propertie = new Propertie($data["title"]);

      if(!$propertie->findByName()) {
        $response = [
          "code" => 404,
          "type" => "bad-request",
          "message" => "User não encontrado!",
          "action" => "invalid propertie title"
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
      }

      $response = [
        "requisition" => [
          "code" => 200,
          "type" => "success",
          "message" => "User encontrado!",
          "action" => "propertie title founded"
        ],
        "propertie" => [
          "title" => $propertie->getTitle(),
          "price" => $propertie->getPrice(),
          "image" => $propertie->getImage(),
          "description" => $propertie->getDescription(),
          "category" => $propertie->getIdCategory(),
          "idUser" => $this->user->getId(),
          "idPropertie" => $propertie->getId()
          ]
        ];
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
      }
    }

  public function getUserProperties()
  {

  }
}