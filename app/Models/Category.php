<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_ids'
    ];


    protected $casts = [
        'category_ids' => 'array', // Cast the product_ids field to an array
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
