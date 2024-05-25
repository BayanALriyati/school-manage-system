<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClass extends FormRequest
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
            
            'Name' => 'required|unique:classrooms,Name_class->ar,'.$this->id,
            'Name_en' => 'required|unique:classrooms,Name_class->en,'.$this->id,
        ];
    }


    public function messages()
    {
        return [
            
            //  'title.required' =>  trans('validation.required'),
        'Name.required' => trans('validation.required'),
        'Name.unique' => trans('validation.unique'),
        'Name_en.required' => trans('validation.required'),
        'Name_en.unique' => trans('validation.unique'),
        ];

      
    }
}