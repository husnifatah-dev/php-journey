<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'shift' => 'required|in:Pagi,Siang,Malam',
            'departemen_id' => 'required|exists:departemens,id'
        ];
    }
    
    public function message(): array 
    {
        return [
            'nama.required' => 'Nama pegawai wajib diisi!',
            'posisi.required' => 'Posisi atau jabatan tidak boleh kosong.',
            'shift.in' => 'Pilih shift hanya boleh Pagi, Siang atau Malam.',
            'departemen_id.required' => 'Departemen wajib dipilih.',
            'departemen_id.exists' => 'Departemen yang dipilih tidak terdaftar di sistem.'
        ];
    }
}
