<?php
declare(strict_types=1);

namespace App\Services;

use App\DTO\Picsum as PicsumDTO;
use App\Models\Picsum;
use Illuminate\Database\Eloquent\Collection;

class PicsumService
{

    public function discover(): PicsumDTO
    {
        $picture = config('app.viam.url') . "1/500/500";
        $id = $this->createPicsum($picture, 0);

        return new PicsumDTO($picture, $id);
    }

    public function decline(int $id, int $height, int $width): PicsumDTO
    {
        $picture = config('app.viam.url') . "$id/$height/$width";
        $id = $this->createPicsum($picture, 0);

        return new PicsumDTO($picture, $id);
    }

    public function approve(int $id, int $height, int $width): PicsumDTO
    {
        $picture = config('app.viam.url') . "$id/$height/$width";
        $id = $this->createPicsum($picture, 1);

        return new PicsumDTO($picture, $id);
    }

    private function createPicsum(string $picture, int $approve): ?int
    {
        $pic = Picsum::create([
            'img'     => $picture,
            'approve' => $approve,
        ]);

        return ++$pic->id;
    }

    public function listPicsum(): Collection
    {
        return Picsum::all();
    }

    public function revert(int $id): int
    {
        return Picsum::destroy($id);
    }
}
