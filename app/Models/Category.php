<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Tambahkan baris di bawah ini:
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory; // Sekarang baris ini tidak akan error lagi

    protected $fillable = ['name'];

    public function items() {
        return $this->hasMany(Item::class);
    }
}