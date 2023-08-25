<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelangganRequest extends FormRequest
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
        $form = [
            'nama' => 'required',
            'email' => 'required|email|unique:pelanggan|max:255',
            'alamat' => 'required',
            'no_hp' => 'required',
            'foto' => 'mimes:png,jpg,jpeg',
            'password' => 'required',
        ];
        if($this->isMethod('put')){
            $form['email'] = 'nullable';
            $form['password'] = 'nullable';
        }
        return $form;
    }
}
