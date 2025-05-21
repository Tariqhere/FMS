<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DispatchUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'flag_id' => 'required|exists:flags,id',
            'dispatch_number' => 'required|string|max:255',
            'file_number' => 'required|string|max:255',
            'dispatch_date' => 'nullable|date',
            'complete_date' => 'nullable|date',
            'dispatch_time' => 'required|date_format:H:i', // Added new field as mandatory
            'office_id' => 'required|exists:offices,id',
            'description' => 'nullable|string',
        ];
    }
}
