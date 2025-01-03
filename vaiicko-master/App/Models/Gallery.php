<?php
namespace App\Models;

use App\Core\Model;

class Gallery extends Model
{
    protected ?int $id = null;
    protected ?int $post_id = null;
    protected ?string $path = null;

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPost(Post $post): void
    {
        $this->post_id = $post->getId();
    }

    public function getPostId(): ?int
    {
        return $this->post_id;
    }

    public static function getByPostId(int $postId): array
    {
        return self::getAll('post_id = ?', [$postId]);
    }
}

