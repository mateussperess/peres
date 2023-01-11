<?php

namespace Source\Models;

use Source\Core\Connect;

class Propertie
{
  private $id;
//  private $idUser;
  private $title;
  private $price;
  private $image;
  private $description;
  private $idCategory;
  private $message;

  public function __construct($id = null, $title = null, $price = null, $image = null, $description = null, $idCategory = null)
  {
    $this->id = $id;
    $this->title = $title;
    $this->price = $price;
    $this->image = $image;
    $this->description = $description;
    $this->idCategory = $idCategory;
  }

//  MÉTODOS

  public function findById()
  {
    $query = "SELECT * FROM properties WHERE id = :id";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->bindParam(":id", $this->id);
    $stmt->execute();


    if($stmt->rowCount() == 0){
      return false;
    } else {
      $propertie = $stmt->fetch();
      $this->id = $propertie->id;
      $this->title = $propertie->title;
      $this->description = $propertie->description;
      $this->price = $propertie->price;
      $this->idCategory = $propertie->idCategory;
      return true;
    }

  }

  public function getArray() : array
  {
    return ["propertie" => [
      "id" => $this->getId(),
      "title" => $this->getTitle()
//      "description" => $this->getDescription(),
//      "price" => $this->getPrice(),
//      "category" => $this->getIdCategory(),
    ]];
  }

  public function findByCategory(int $idCategory)
  {
    $query = "SELECT * FROM properties WHERE idCategory = :idCategory";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->bindParam(":idCategory",$idCategory);
    $stmt->execute();
    if($stmt->rowCount() == 0){
      return false; 
    } else {
      return $stmt->fetchAll();
    }
  }

  public function findByIdUser()
  {
    $query = "SELECT * FROM properties JOIN";
  }

  public function insert()
    {
        $query = "INSERT INTO properties (title, price, image ,description, idCategory) 
                  VALUES (:title, :price, :image, :description, :idCategory)";
        $stmt = Connect::getInstance()->prepare($query);
        
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":price", $this->price);

        $stmt->bindParam(":image", $this->image);

        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idCategory", $this->idCategory);
        $stmt->execute();

//        $this->id = Connect::getInstance()->lastInsertId();
        $this->message = "Propriedade cadastrado com sucesso!";
        return Connect::getInstance()->lastInsertId();
    }

  public function selectAll()
  {
    $query = "SELECT * FROM properties";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->execute();

    if($stmt->rowCount() == 0){
      return false;
    } else {
      return $stmt->fetchAll();
    }
  }

  public function getAll()
  {
    $query = "SELECT * FROM properties JOIN create_propertie ON properties.id = create_propertie.idPropertie";

    $stmt = Connect::getInstance()->prepare($query);

    $stmt->execute();

    if ($stmt->rowCount() == 0) {
      return false;
    }
    return $stmt->fetchAll();
  }

  /**
   * @return mixed
   */
  public function getMessage()
  {
    return $this->message;
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id): void
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * @param mixed $title
   */
  public function setTitle($title): void
  {
    $this->title = $title;
  }

  /**
   * @return mixed
   */
  public function getPrice()
  {
    return $this->price;
  }

  /**
   * @param mixed $price
   */
  public function setPrice($price): void
  {
    $this->price = $price;
  }

  /**
   * @return mixed
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * @param mixed $description
   */
  public function setDescription($description): void
  {
    $this->description = $description;
  }

  /**
   * @return mixed
   */
  public function getIdCategory()
  {
    return $this->idCategory;
  }

  /**
   * @param mixed $idCategory
   */
  public function setIdCategory($idCategory): void
  {
    $this->idCategory = $idCategory;
  }

  /**
   * @return mixed
   */
  public function getImage()
  {
    return $this->image;
  }
  public function setImage($image): void
  {
    $this->image = $image;
  }
}