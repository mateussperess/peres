<?php

namespace Source\Models;

use Source\Core\Connect;

class User
{
  private $id;
  private $first_name;
  private $last_name;
  private $mail;
  private $password;
  private $profile_photo;
  private $created_at;
  private $updated_at;
  private $deleted_at;
  private $is_deleted;
  private $message;

  public function __construct(
    int     $id             = null,
    string  $first_name     = null,
    string  $last_name      = null,
    string  $mail           = null,
    string  $password       = null,
    string  $profile_photo  = null,
    string  $created_at     = null,
    string  $updated_at     = null,
    string  $deleted_at     = null,
    string  $is_deleted     = null,
    string  $message        = null
  ) {
    $this->id               = $id;
    $this->first_name       = $first_name;
    $this->last_name        = $last_name;
    $this->mail             = $mail;
    $this->password         = $password;
    $this->profile_photo    = $profile_photo;
    $this->created_at       = $created_at;
    $this->updated_at       = $updated_at;
    $this->deleted_at       = $deleted_at;
    $this->is_deleted       = $is_deleted;
    $this->message          = $message;
  }

  public function selectAll()
  {
    $query = "SELECT ALL * FROM users";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
      return false;
    } else {
      return $stmt->fetchAll();
      echo json_encode($stmt, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
      return;
    }
  }

  public function findById(): bool
  {
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->bindParam(":id", $this->id);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
      return false;
    } else {
      $user = $stmt->fetch();
      $this->first_name = $user->first_name;
      $this->last_name = $user->last_name;
      $this->mail = $user->mail;
      return true;
    }
  }

  public function findByEmail(string $mail): bool
  {
    $query = "SELECT * FROM users WHERE mail = :mail";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->bindParam(":mail", $mail);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
      return true;
    } else {
      return false;
    }
  }

  //public function validate (string $email, string $password, string $type) : bool
  public function validate(string $mail, string $password): bool
  {
    //$query = "SELECT * FROM users WHERE mail LIKE :mail AND type = :type";
    $query = "SELECT * FROM users WHERE mail LIKE :mail";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->bindParam(":mail", $mail);
    //$stmt->bindParam(":type", $type);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
      $this->message = "Usuário e/ou Senha não cadastrados!";
      return false;
    } else {
      $user = $stmt->fetch();
      if (!password_verify($password, $user->password)) {
        $this->message = "Usuário e/ou Senha não cadastrados!";
        return false;
      }
    }

    $this->id = $user->id;
    $this->first_name = $user->first_name;
    $this->last_name = $user->last_name;
    $this->mail = $user->mail;
    $this->profile_photo = $user->profile_photo;
    $this->message = "Usuário Autorizado, redirect to APP!";

    $arrayUser = [
      "id" => $this->id,
      "first_name" => $this->first_name,
      "last_name" => $this->last_name,
      "mail" => $this->mail,
      "profile_photo" => $this->profile_photo
    ];

    $_SESSION["user"] = $arrayUser;
    setcookie("user", "Logado", time() + 60 * 60, "/");

    return true;
  }

  public function insert(): bool
  {
    $query = "INSERT INTO users (first_name, last_name, mail, password) VALUES (:first_name, :last_name, :mail, :password)";
    $stmt = Connect::getInstance()->prepare($query);
    $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":last_name", $this->last_name);
    $stmt->bindParam(":mail", $this->mail);
    $stmt->bindValue(":password", password_hash($this->password, PASSWORD_DEFAULT));
    $stmt->execute();
    $this->message = "Usuário cadastrado com sucesso!";
    return true;
  }

  public function update()
  {
    $query = "UPDATE users SET first_name = :first_name, mail = :mail, profile_photo = :profile_photo WHERE id = :id";

    $stmt = Connect::getInstance()->prepare($query);

    $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":mail", $this->mail);
    $stmt->bindParam(":profile_photo", $this->profile_photo);
    $stmt->bindParam(":id", $this->id);

    $stmt->execute();
    $arrayUser = [
      "first_name" => $this->first_name,
      "mail" => $this->mail,
      "profile_photo" => $this->profile_photo,
      "id" => $this->id
    ];

    $_SESSION["user"] = $arrayUser;
    $this->message = "Usuário alterado com sucesso!";
  }

  public function getArray(): array
  {
    return [
      "id" => $this->id,
      "first_name" => $this->first_name,
      "last_name" => $this->last_name,
      "mail" => $this->mail,
      "profile_photo" => $this->profile_photo
    ];
  }

  // Getters
  public function getId(): ?int
  {
    return $this->id;
  }

  public function getFirstName(): ?string
  {
    return $this->first_name;
  }

  public function getLastName(): ?string
  {
    return $this->last_name;
  }

  public function getMail(): ?string
  {
    return $this->mail;
  }

  public function getPassword(): ?string
  {
    return $this->password;
  }

  public function getProfilePhoto(): ?string
  {
    return $this->profile_photo;
  }

  public function getCreatedAt(): ?string
  {
    return $this->created_at;
  }

  public function getUpdatedAt(): ?string
  {
    return $this->updated_at;
  }

  public function getDeletedAt(): ?string
  {
    return $this->deleted_at;
  }

  public function getIsDeleted(): ?int
  {
    return $this->is_deleted;
  }

  public function getMessage(): ?string
  {
    return $this->message;
  }

  // Setters
  public function setId(?int $id): void
  {
    $this->id = $id;
  }

  public function setFirstName(?string $first_name): void
  {
    $this->first_name = $first_name;
  }

  public function setLastName(?string $last_name): void
  {
    $this->last_name = $last_name;
  }

  public function setMail(?string $mail): void
  {
    $this->mail = $mail;
  }

  public function setPassword(?string $password): void
  {
    $this->password = $password;
  }

  public function setProfilePhoto(?string $profile_photo): void
  {
    $this->profile_photo = $profile_photo;
  }

  public function setCreatedAt(?string $created_at): void
  {
    $this->created_at = $created_at;
  }

  public function setUpdatedAt(?string $updated_at): void
  {
    $this->updated_at = $updated_at;
  }

  public function setDeletedAt(?string $deleted_at): void
  {
    $this->deleted_at = $deleted_at;
  }

  public function setIsDeleted(?int $is_deleted): void
  {
    $this->is_deleted = $is_deleted;
  }

  public function setMessage(?string $message): void
  {
    $this->message = $message;
  }
}
