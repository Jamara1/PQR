<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PQRRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => 'numeric|exists:users,id',
            'pqr_type_id' => 'required|numeric|exists:pqr_types,id',
            'subject' => 'required|string|min:5|max:200',
            'status' => 'numeric',
            'deadline_date' => 'date',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function attributes()
    {
        return [
            'user_id' => strtolower(__('User')),
            'pqr_type_id' => strtolower(__('PQR type')),
            'subject' => strtolower(__('Subject')),
            'status' => strtolower(__('Status')),
            'deadline_date' => strtolower(__('Deadline date')),
        ];
    }
}
