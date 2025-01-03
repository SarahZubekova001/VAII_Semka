<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $description = null;
    protected ?string $season = null;
    protected ?string $category = null;
    protected ?int $id_address = null;
    protected ?string $opening_hours = null;
    protected static string $tableName = 'posts';

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): void
    {
        $this->season = $season;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getIdAddress(): ?int
    {
        return $this->id_address;
    }

    public function setIdAddress(?int $id): void
    {
        $this->id_address = $id;
    }

    public function getOpeningHours(): ?string
    {
        return $this->opening_hours;
    }

    public function setOpeningHours(?string $opening_hours): void
    {
        $this->opening_hours = $opening_hours;
    }

    /**
     * Získanie adresy priradenej k príspevku
     *
     * @return Address|null
     * @throws \Exception
     */
    public function getAddressDetails(): ?Address
    {
        return $this->id_address ? Address::getOne($this->id_address) : null;
    }

    /**
     * Získanie všetkých obrázkov priradených k príspevku
     *
     * @return Image[]
     * @throws \Exception
     */
    public function getImagePath(): ?Image
    {
        $images = Image::getAll("post_id  = ?", [$this->id]);
        return $images[0] ?? null; // Vráti prvý obrázok alebo null, ak obrázky neexistujú
    }
    public function setImagePath(string $path): void {

        $image = new Image();
        $image->setPath($path);
        $image->setPost($this);
        $image->save();
    }
    public static function where($columnOrConditions, $value = null): array
    {
        $db = \App\Core\DB\Connection::connect();
        $query = "SELECT * FROM " . static::$tableName . " WHERE ";
        $params = [];
        $filters = [];

        if (is_array($columnOrConditions)) {
            foreach ($columnOrConditions as $column => $value) {
                if (is_array($value)) {
                    $placeholders = implode(',', array_fill(0, count($value), '?'));
                    $filters[] = "$column IN ($placeholders)";
                    $params = array_merge($params, $value);
                } else {
                    $filters[] = "$column = ?";
                    $params[] = $value;
                }
            }
        } else {
            if (is_array($value)) {
                $placeholders = implode(',', array_fill(0, count($value), '?'));
                $filters[] = "$columnOrConditions IN ($placeholders)";
                $params = array_merge($params, $value);
            } else {
                $filters[] = "$columnOrConditions = ?";
                $params[] = $value;
            }
        }

        $query .= implode(" AND ", $filters);
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, static::class);
    }





}
