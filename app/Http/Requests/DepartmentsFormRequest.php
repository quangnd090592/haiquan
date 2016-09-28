<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\Models\DepartmentsModel;

class DepartmentsFormRequest extends FormRequest
{
    protected $rules = [
        'name'=>'required|unique:departments,name'
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
            $departmentsModel = new DepartmentsModel();
            $department = $departmentsModel->find($data['id']);
            if($department->name == $data['name']) {
                $rules['name']= 'required';
            }
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.unique' => 'Tên trùng.'
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['status'=>0, 'errors'=>$errors]);
    }
}
