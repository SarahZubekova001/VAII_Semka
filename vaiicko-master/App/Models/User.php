<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected ?int $id = null;
    protected ?string $username = null;
    protected ?string $passwordHash = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPasswordHash(): ?string
    {
        return $this->passwordHash;
    }

    public function setPassword(string $password): void
    {
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
    }
}
