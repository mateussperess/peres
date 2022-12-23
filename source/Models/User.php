<?php

namespace Source\Models;

use Source\Core\Connect;

class User
{
  private $id;
  private $name;
  private $email;
  private $password;
  private $photo;
  private $message;

  public function __construct(
    int $id = null,
    string $name = null,
    string $email = null,
    string $password = null,
    string $photo = null,
    string $message = null
  ){
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
    $this->photo = $photo;
    $this->message = $message;
  }

  /**
   * @return mixed
   */
  public function getPhoto()
  {
    return $this->photo;
  }

  /**
   * @param mixed $photo
   */
  public function setPhoto($photo): void
  {
    $this->photo = $photo;
  }
    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }



    public function selectAll()
    {
        $query = "SELECT ALL * FROM users";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
            echo json_encode($stmt, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function findById() : bool
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            $user = $stmt->fetch();
            $this->name = $user->name;
            $this->email = $user->email;
            return true;
        }
    }

    public function findByEmail(string $email) : bool
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }

    //public function validate (string $email, string $password, string $type) : bool
    public function validate (string $email, string $password) : bool
    {
        //$query = "SELECT * FROM users WHERE email LIKE :email AND type = :type";
        $query = "SELECT * FROM users WHERE email LIKE :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        //$stmt->bindParam(":type", $type);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            $this->message = "Usuário e/ou Senha não cadastrados!";
            return false;
        } else {
            $user = $stmt->fetch();
            if(!password_verify($password, $user->password)){
                $this->message = "Usuário e/ou Senha não cadastrados!";
                return false;
            }
        }

        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->photo = $user->photo;
        $this->message = "Usuário Autorizado, redirect to APP!";

        $arrayUser = [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "photo" => $this->photo
        ];

        $_SESSION["user"] = $arrayUser;
        setcookie("user","Logado",time()+60*60,"/");

        return true;
    }

    public function insert() : bool
    {
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindValue(":password", password_hash($this->password,PASSWORD_DEFAULT));
        $stmt->execute();
        $this->message = "Usuário cadastrado com sucesso!";
        return true;
    }

    public function update()
    {
        $query = "UPDATE users SET name = :name, email = :email, photo = :photo WHERE id = :id";
        
        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":photo",$this->photo);
        $stmt->bindParam(":id", $this->id);

      $stmt->execute();
      $arrayUser = [
        "name" => $this->name,
        "email" => $this->email,
        "photo" => $this->photo,
        "id" => $this->id
      ];

      $_SESSION["user"] = $arrayUser;
      $this->message = "Usuário alterado com sucesso!";
    }

    public function getArray() : array
    {
      return [
        "id" => $this->id,
        "name" => $this->name,
        "email" => $this->email,
        "photo" => $this->photo
      ];
    }
}