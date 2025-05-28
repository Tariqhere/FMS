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
            'folder_id' => 'required|exists:folders,id',
            'date' => 'nullable|date',
            'office_id' => 'required|exists:offices,id',
            'received_from' => 'required|string|max:255',
            'send_to' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }
}