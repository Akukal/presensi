<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_siswa' => 'required|exists:siswa,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:hadir,izin,sakit,alfa',
            'jam_masuk' => 'required|date_format:H:i:s',
            'jam_keluar' => 'nullable|date_format:H:i:s',
            'status_masuk' => 'nullable|in:telat,tepat_waktu',
            'keterangan' => 'nullable|string|max:255',
        ];
    }
}
