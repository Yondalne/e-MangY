<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'img',
        'link'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
