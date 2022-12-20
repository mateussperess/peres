<?php

namespace Source\Models;

use Source\Core\Connect;

class CreatePropertie
{
  private $id;
  private $idCategory;
  private $idUser;
  private $idPropertie;


  /**
   * @param $id
   * @param $idCategory
   * @param $idUser
   */
  public function __construct($id = NULL, $idPropertie, $idUser)
  {
    $this->id = $id;
    $this->idPropertie = $idPropertie;
    $this->idUser = $idUser;
  }

  public function createPropertieInsert()
  {
    $query = "INSERT INTO create_propertie (idPropertie, idUser) 
                  VALUES (:idPropertie, :idUser)";
    $stmt = Connect::getInstance()->prepare($query); 
    $stmt->bindParam(":idPropertie", $this->idPropertie);
    $stmt->bindParam(":idUser", $this->idUser);
    $stmt->execute();

    return true;
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
  public function getIdUser()
  {
    return $this->idUser;
  }

  /**
   * @param mixed $idUser
   */
  public function setIdUser($idUser): void
  {
    $this->idUser = $idUser;
  }

  /**
   * @return mixed
   */
  public function getIdPropertie()
  {
    return $this->idPropertie;
  }

  /**
   * @param mixed $idPropertie
   */
  public function setIdPropertie($idPropertie): void
  {
    $this->idPropertie = $idPropertie;
  }

}