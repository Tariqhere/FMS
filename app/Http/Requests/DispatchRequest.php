<?php



namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DispatchRequest extends FormRequest
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
             'flag_id' => 'required|exists:flags,id',  
             'office_id' => 'required|exists:offices,id',  
             'user_id' => 'required|exists:users,id', 
             'title' => 'required|string|max:255',
           'description' => 'nullable|string', 
            'remark' => 'nullable|string', 
             'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048', 
            'dispatch_date' => 'nullable|date', 
            'complete_date' => 'nullable|date|after_or_equal:dispatch_date', 
               'status' => 'nullable|integer|in:0,1,2,3,4',
         ];
     }
}
