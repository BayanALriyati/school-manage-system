<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrades extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'Name' => 'required|unique:grades,name->ar,'.$this->id,
            'Name_en' => 'required|unique:grades,name->en,'.$this->id,
            'Notes' => 'required',
            'Notes_en'=> 'required'
        ];
    }
    

    public function messages(): array
    {
        return [
        'title.required' =>  trans('validation.required'),
        'Name.required' => trans('validation.required'),
        'Name.unique' => trans('validation.unique'),
        'Name_en.required' => trans('validation.required'),
        'Name_en.unique' => trans('validation.unique'),
    ];
    }
}
 