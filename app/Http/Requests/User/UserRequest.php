<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$rules = [
			'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'number_id' => ['required', 'numeric'],
			'email' => ['required', 'email'],
			'password' => ['confirmed', 'string', 'min:8'],
		];

		if ($this->method() == 'POST') {
			array_push($rules['number_id'], 'unique:users,number_id');
			array_push($rules['email'], 'unique:users,email');
			array_push($rules['password'], 'required');
		} else {
			array_push($rules['number_id'], 'unique:users,number_id,' . $this->user->id);
			array_push($rules['email'], 'unique:users,email,' . $this->user->id);
			array_push($rules['password'], 'nullable');
		}

		if ($this->path() != 'api/register') {
			$rules['role'] = ['required', 'string', 'in:user,admin'];
		}

		return $rules;
	}

	public function messages(){
		return [
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe de ser valido',
			'last_name.required' => 'El apellido es requerido',
			'last_name.string' => 'El nombre debe de ser valido',
			'number_id.required' => 'La identificacion es requerida',
			'number_id.numeric' => 'La identificacion debe de ser valida',
			'number_id.unique' => 'La identificacion ya esta en uso, ingrese una diferente',
			'email.required' => 'El email es requerido',
			'email.email' => 'El email debe de ser valido',
			'email.unique' => 'El email ya esta en uso, ingrese uno diferente',
			'password.required' => 'La contraseña es requerida',
			'password.confirmed' => 'La contraseña debe coincidir',
			'password.string' => 'La contraseña debe ser valida',
			'password.min' => 'La contraseña debe tener minimo 8 caracteres',
		];
	}
}
