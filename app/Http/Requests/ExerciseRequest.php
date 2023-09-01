<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseRequest extends FormRequest
{
   /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
  
        return [
            'unit_id'       => 'required|numeric',
            'course_id'=> 'required|numeric',
            'lesson_id'=> 'required|numeric',
            'exercise_type'       => 'required|max:255',
            'instruction' => 'nullable|max:5000',
            'question'=> 'nullable|max:5000',
            'image'       => 'nullable|image|mimes:png,jpg,jpeg,gif,webp|max:2048',
            'voice'=>'nullable|mimes:mp3,mp4,wav,ogg,webm,m4a,flac,aac|max:2048',
            'choice'=>'nullable|max:5000', 
            'incorrect_hint'=> 'nullable|max:5000',
            'correct_answer'=> 'required|numeric',
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
            'unit_id.required' => 'Please provide a unit ID',
            'unit_id.numeric' => 'The unit ID must be a number',
            'course_id.required' => 'Please provide a course ID',
            'course_id.numeric' => 'The course ID must be a number',
            'lesson_id.required' => 'Please provide a lesson ID',
            'lesson_id.numeric' => 'The lesson ID must be a number',
            'exercise_type.required' => 'Please provide an exercise type',
            'exercise_type.max' => 'The exercise type cannot exceed :max characters',
            'instruction.max' => 'The instruction cannot exceed :max characters',
            'question.max' => 'The question cannot exceed :max characters',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be a PNG, JPG, JPEG, GIF, or WEBP file',
            'image.max' => 'The image cannot be larger than :max kilobytes',
            'voice.mimes' => 'The voice file must be an MP3, MP4, WAV, OGG, WEBM, M4A, FLAC, or AAC file',
            'voice.max' => 'The voice file cannot be larger than :max kilobytes',
            'choice.max' => 'The choice cannot exceed :max characters',
            'incorrect_hint.max' => 'The incorrect hint cannot exceed :max characters',
            'correct_answer.required' => 'Please provide a correct answer',
            'correct_answer.numeric' => 'The correct answer must be a number',
        ];
    }
}
