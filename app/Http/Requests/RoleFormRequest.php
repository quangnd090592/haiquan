<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\Models\RolesModel;

class RoleFormRequest extends FormRequest
{
    protected $rules = [
        'slug'=>'required|unique:roles,slug'
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
            $rolesModel = new RolesModel();
            $role = $rolesModel->find($data['id']);
            if($role->slug == $data['slug']) {
                $rules['slug']= 'required';
            }
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'slug.unique' => 'Tên đại diện trùng.'
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['status'=>0, 'errors'=>$errors]);
    }
}
