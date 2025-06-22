<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DispatchRequest extends FormRequest
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
            'folder_id'=> 'required|exists:folders,id',
            'office_id' => 'required|exists:offices,id',
            'dispatch_number' => 'required|string|max:255',
            'file_number' => 'required|string|max:255',
            'date' => 'nullable|date',
            'date' => 'nullable|date',
            'send_to' => 'required|string|max:255',
            'received_from' => 'required|string|max:255',
            'description' => 'required|string',

            'attachments' => 'nullable|array',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xlsx,xls|max:20480',
        ];
    }
}
