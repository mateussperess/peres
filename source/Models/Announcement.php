<?php

namespace Source\Models;

use Source\Core\Connect;

class Announcement
{
  private $id;
  private $user_id;
  private $title;
  private $description;
  private $price;
  private $address_id;
  private $created_at;
  private $updated_at;
  private $is_deleted;
  private $deleted_at;

  public function __construct(
    int     $id           = null,
    int     $user_id      = null,
    string  $title        = null,
    string  $description  = null,
    float   $price        = null,
    int     $address_id   = null,
    string  $created_at   = null,
    string  $updated_at   = null,
    int     $is_deleted   = null,
    string  $deleted_at   = null
  ) {
    $this->id           = $id;
    $this->user_id      = $user_id;
    $this->title        = $title;
    $this->description  = $description;
    $this->price        = $price;
    $this->address_id   = $address_id;
    $this->created_at   = $created_at;
    $this->updated_at   = $updated_at;
    $this->is_deleted   = $is_deleted;
    $this->deleted_at   = $deleted_at;
  }

  // Getters
  public function getId(): ?int
  {
    return $this->id;
  }

  public function getUserId(): ?int
  {
    return $this->user_id;
  }

  public function getTitle(): ?string
  {
    return $this->title;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function getPrice(): ?float
  {
    return $this->price;
  }

  public function getAddressId(): ?int
  {
    return $this->address_id;
  }

  public function getCreatedAt(): ?string
  {
    return $this->created_at;
  }

  public function getUpdatedAt(): ?string
  {
    return $this->updated_at;
  }

  public function getIsDeleted(): ?int
  {
    return $this->is_deleted;
  }

  public function getDeletedAt(): ?string
  {
    return $this->deleted_at;
  }

  // Setters
  public function setId(?int $id): void
  {
    $this->id = $id;
  }

  public function setUserId(?int $user_id): void
  {
    $this->user_id = $user_id;
  }

  public function setTitle(?string $title): void
  {
    $this->title = $title;
  }

  public function setDescription(?string $description): void
  {
    $this->description = $description;
  }

  public function setPrice(?float $price): void
  {
    $this->price = $price;
  }

  public function setAddressId(?int $address_id): void
  {
    $this->address_id = $address_id;
  }

  public function setCreatedAt(?string $created_at): void
  {
    $this->created_at = $created_at;
  }

  public function setUpdatedAt(?string $updated_at): void
  {
    $this->updated_at = $updated_at;
  }

  public function setIsDeleted(?int $is_deleted): void
  {
    $this->is_deleted = $is_deleted;
  }

  public function setDeletedAt(?string $deleted_at): void
  {
    $this->deleted_at = $deleted_at;
  }
}
