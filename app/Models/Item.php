<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Tambahkan baris di bawah ini:
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory; 

    protected $fillable = [
        'name',
        'category_id', // Jangan lupa tambahkan kolom lain jika ada
        'description',
        'stock',
        'price'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}