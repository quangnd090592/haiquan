<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\Models\UsersModel;

class UserFormRequest extends FormRequest
{
    protected $rules = [
        'email'=>'required|unique:users,email'
    ];
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
        $rules = $this->rules;
        $data = $this->all();

        if (!empty($data['id'])) {
            $usersModel = new UsersModel();
            $user = $usersModel->find($data['id']);
            if($user->email == $data['email']) {
                $rules['email']= 'required';
            }
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'email.unique' => 'Email không được trùng!'
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['status'=>0, 'errors'=>$errors]);
    }
}
