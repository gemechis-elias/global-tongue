<?php

namespace App\Http\Requests;

class CourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'       => 'required|max:255',
            'description' => 'nullable|max:5000',
         
            'level'       => 'required|max:255',
            'type'=> 'required|max:255',
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
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'name.required'  => 'Please give course title',
            'name.max'       => 'Please give course title maximum of 255 characters',
            'description.max' => 'Please give course description maximum of 5000 characters',
            'level.required'  => 'Please give course level',
            'level.max'       => 'Please give course level maximum of 255 characters',
            'type.required'  => 'Please give course type',
            'type.max'       => 'Please give course type maximum of 255 characters',
         ];
    }
}
