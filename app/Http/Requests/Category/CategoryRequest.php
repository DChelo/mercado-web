<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$rules = [
			'name' => ['required', 'string'],
		];

		if ($this->method() == 'POST') {
			array_push($rules['name'], 'unique:categories,name');
		}

		return $rules;
	}

	public function messages(){
		return [
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe de ser valido',
			'name.unique' => 'El nombre ya esta en uso, porfavor ingrese uno diferente'
		];
	}
}
