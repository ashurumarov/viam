<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $img
 * @property bool $approve
 */
class Picsum extends Model
{
    use HasFactory;

    protected $table = 'picsum';

    protected $fillable = [
        'img',
        'approve',
    ];
}
