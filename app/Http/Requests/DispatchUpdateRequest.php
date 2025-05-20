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
            'description' => 'nullable|string',
            'remark' => 'nullable|string',
            'dispatch_date' => 'required|date',
            'complete_date' => 'nullable|date|after_or_equal:dispatch_date',
            'flag_id' => 'required|exists:flags,id',
            'office_id' => 'required|exists:offices,id',
            'user_id' => 'required|exists:users,id',
            'attachments.*' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx|max:2048', // each file max 2MB
        ];
    }
}
