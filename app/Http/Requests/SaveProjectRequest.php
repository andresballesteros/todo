<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class SaveProjectRequest extends FormRequest
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
            'title' => 'required',
            'url' => [
                $this->route('project') ? '' : 'required',
                Rule::unique('projects')->ignore($this->route('project'))
            ],
            'image' => [
                $this->route('project') ? 'nullable' : 'required',
                'mimes:jpeg,png'
            ], //'image'=>jpeg,png,bmp,gif,svg o webp
            'description' => 'required',
            'category_id' => [
                'required',
                'exists:categories,id'
            ],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Favor ingresar un título',
            'url.required' => 'Favor ingresar una url',
            'description.required' => 'Favor ingresar una descripción',
        ];
    }
}
