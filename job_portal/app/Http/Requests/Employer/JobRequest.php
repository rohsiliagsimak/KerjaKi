<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full-time,part-time,freelance',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'salary' => 'required|numeric|min:1000',
            'status' => 'required|string|in:active,closed,draft',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul lowongan wajib diisi',
            'location.required' => 'Lokasi wajib diisi',
            'job_type.required' => 'Tipe pekerjaan wajib diisi',
            'contact_email.required' => 'Email wajib diisi',
            'contact_email.email' => 'Format email tidak valid',
            'contact_phone.required' => 'Nomor telepon wajib diisi',
            'description.required' => 'Deskripsi pekerjaan wajib diisi',
            'requirements.required' => 'Persyaratan pekerjaan wajib diisi',
            'salary.required' => 'Gaji wajib diisi',
            'salary.numeric' => 'Gaji harus berupa angka',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status harus salah satu dari: active, closed, draft',
        ];
    }
}
