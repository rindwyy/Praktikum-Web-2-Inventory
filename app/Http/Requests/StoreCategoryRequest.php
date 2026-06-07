<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:categories,name|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Nama kategori sudah ada.',
        ];
    }

    protected function prepareForValidation(){
        $input = $this->all();

        // Bersihkan input dari tag HTML dan spasi berlebih
        array_walk($input, function (&$val) {
            if (is_string($val)) {
                $val = trim(strip_tags($val)); // Hapus tag HTML dan trim spasi
            }
        });

        $this->merge($input);
    }
}