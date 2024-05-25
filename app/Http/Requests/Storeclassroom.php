<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroom extends FormRequest
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
            
            'List_Classes.*.Name' => 'required|unique:classrooms,Name_class->ar,'.$this->id,
            'List_Classes.*.Name_class_en' => 'required|unique:classrooms,Name_class->en,'.$this->id,
        ];
    }


    public function messages()
    {
        // return [
            
        //      'title.required' =>  trans('validation.required'),
        // 'Name.required' => trans('validation.required'),
        // 'Name.unique' => trans('validation.unique'),
        // 'Name_en.required' => trans('validation.required'),
        // 'Name_en.unique' => trans('validation.unique'),
        // ];
        $messages = [];

        foreach ($this->request->get('List_Classes', []) as $index => $class) {
            $messages["List_Classes.$index.Name_class_en.required"] = trans('validation.required'). ($index + 1) ;
            $messages["List_Classes.$index.Name.required"] = trans('validation.required'). ($index + 1) ;
            $messages["List_Classes.$index.Name_class_en.unique"] =trans('validation.unique').($index + 1) ;
            $messages["List_Classes.$index.Name.unique"] = trans('validation.unique'). ($index + 1) ;
        }

        return $messages;
        
    }
}