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

    public function setRestaurant(?Restaurant $restaurant): void {
        $this->restaurant_id = $restaurant?->getId();
    }

    public function getPostId(): ?int
    {
        return $this->post_id;
    }
    public function setPostId(?int $postId): void
    {
        $this->post_id = $postId;
    }
    public function setRestaurantId(?int $restaurantId): ?int
    {
        return $this->restaurant_id = $restaurantId;
    }
    public function getRestaurantId(): ?int
    {
        return $this->restaurant_id;
    }

    public function setPost(?Post $post): void {
        $this->post_id = $post?->getId();
    }
    public function getGallery(): array {
        return Image::getAll("post_id = ?", [$this->id]);
    }
    public static function getByPostId(int $postId): array
    {
        return self::getAll('post_id = ?', [$postId]);
    }

}
