<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\Models\ProducersModel;

class ProducerFormRequest extends FormRequest
{
    protected $rules = [
        'name'=>'required|unique:producers,name'
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
            $producersModel = new ProducersModel();
            $producer = $producersModel->find($data['id']);
            if($producer->name == $data['name']) {
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
