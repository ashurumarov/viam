<?php
declare(strict_types=1);

namespace App\DTO;

class Picsum
{
    public string $picture;
    public int $id;

    public function __construct(string $picture, int $id)
    {
        $this->picture = $picture;
        $this->id = $id;
    }
}
