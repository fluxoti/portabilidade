<?php namespace Portabilidade\Consultations;

use Eloquent;

class Prefix extends Eloquent {


    protected $connection = 'portabilidade';

    protected $table = 'prefixo';

    public function phoneCompany()
    {
        return $this->hasOne('Portabilidade\Consultations\PhoneCompany', 'rn1', 'rn1');
    }



}