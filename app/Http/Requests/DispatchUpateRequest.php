<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DispatchUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Allow all users, or implement custom logic for authorization
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'flag_id' => 'required|exists:flags,id',
            'office_id' => 'required|exists:offices,id',  
            'user_id' => 'required|exists:users,id', 
            'title' => 'required|string|max:255',
            'description' => 'nullable|string', 
            'remark' => 'nullable|string', 
            'flag' => 'nullable|string|max:255', 
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', 
            'dispatch_date' => 'nullable|date', 
            'complete_date' => 'nullable|date|after_or_equal:dispatch_date', 
             'status' => 'nullable|integer|in:0,1,2,3,4',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'flag_id.exists' => 'The selected flag ID is invalid.',
            'office_id.exists' => 'The selected office ID is invalid.',
            'user_id.exists' => 'The selected user ID is invalid.',
            'dispatch_date.date' => 'The dispatch date must be a valid date.',
            'complete_date.after_or_equal' => 'The complete date must be after or equal to the dispatch date.',
        ];
    }
}
