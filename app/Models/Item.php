<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory; 

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'quantity',
        'price'
    ];

    public function category() {    
        return $this->belongsTo(Category::class);
    }
}
