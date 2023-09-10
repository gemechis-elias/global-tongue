<?php

namespace App\Http\Requests;

class UnitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        // [
        //     'course_id',
        //     'level_id',
    
        //     'unit_name', 
        //     'unit_title', 
        //     'unit_description', 
        //     'unit_image', 
        //     'no_of_lessons'];

        return [
            'course_id'    => 'required|max:255',

        ];
    } 

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     * Custom validation message */
    public function messages(): array
    {
        return [
            'course_id.required'  => 'Please give course_id',
         ];
    }
}
