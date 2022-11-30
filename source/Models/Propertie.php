<?php

namespace Source\Models;

use Source\Core\Connect;

class Propertie
{
  private $id;
  private $title;
  private $price;
  private $image;
  private $description;
  private $idCategory;
  private $message;

  /**
   * @param $id
   * @param $title
   * @param $price
   * @param $image
   * @param $description
   * @param $idCategory
   * @param $message
   */
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

  public function insert() : bool
    {
        $query = "INSERT INTO properties (title, price, image, description, idCategory) 
                  VALUES (:title, :price, :image, :description, :idCategory)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":image", $this->image);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":idCategory", $this->idCategory);
        $stmt->execute();
        $this->id = Connect::getInstance()->lastInsertId(); // armazena o id do projeto incluido
        $this->message = "Projeto cadastrado com sucesso!";
        return true;
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