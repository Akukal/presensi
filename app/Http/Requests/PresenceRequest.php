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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:absen_masuk,absen_pulang,izin,sakit,alfa',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_pulang' => 'nullable|date_format:H:i',
            'status_masuk' => 'nullable|in:telat,tepat_waktu',
            'keterangan' => 'nullable|string|max:255',
        ];
    }
}
