<?php namespace Portabilidade\Consultations;

use Illuminate\Support\Facades\App;
use Portabilidade\Support\Api\AbstractApiValidator;
use Auth;

class ConsultMultipleValidator extends AbstractApiValidator
{
    protected function rules()
    {
        return ['numbers' => 'required|limit'];
    }

    public function validateLimit($attribute, $value, $params)
    {
        return count($value) <= 100;
    }


    protected function messages()
    {
        return [
            'limit' => 'Você não pode requisitar mais de 100 números em uma só consulta.'
        ];
    }

}