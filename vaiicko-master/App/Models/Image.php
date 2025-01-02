<?php

namespace App\Models;

use App\Core\Model;

class Image extends Model {

    protected ?int $id = null;
    protected ?string $path = null;
    protected ?int $restaurant_id = null;
    protected ?int $post_id = null;

    protected static string $tableName = 'images';

    public function getPath(): ?string {
        return $this->path;
    }

    public function setPath(string $path): void {
        $this->path = $path;
    }

    public function getRestaurant(): ?Restaurant {
        return $this->restaurant_id ? Restaurant::getOne($this->restaurant_id) : null;
    }

    public function setRestaurant(?Restaurant $restaurant): void {
        $this->restaurant_id = $restaurant?->getId();
    }

    public function getPost(): ?Post {
        return $this->post_id ? Post::getOne($this->post_id) : null;
    }

    public function setPost(?Post $post): void {
        $this->post_id = $post?->getId();
    }
}
