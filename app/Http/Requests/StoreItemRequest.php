<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    protected function prepareForValidation(){
        $input = $this->all();

        // Bersihkan input dari tag HTML dan spasi berlebih
        array_walk($input, function (&$val) {
            if (is_string($val)) {
                $val = trim(strip_tags($val));
            }
        });

        $this->merge($input);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    // fungsi message untuk memberikan pesan error yang lebih spesifik saat validasi gagal
    public function messages(): array
    {
        return [
            'name.required' => 'Nama item wajib diisi.',
            'quantity.integer' => 'Jumlah harus berupa angka bulat.',
            'quantity.min' => 'Jumlah minimal adalah 0.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal adalah 0.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
        ];
    }

    
}