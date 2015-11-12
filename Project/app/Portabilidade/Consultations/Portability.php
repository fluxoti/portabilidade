<?php namespace Portabilidade\Consultations;

use Eloquent;

class Portability extends Eloquent {

    protected $connection = 'portabilidade';

    protected $table = 'portado';


    public function phoneCompany()
    {
        return $this->hasOne(
            'Portabilidade\Consultations\PhoneCompany',
            'rn1', 'rn1');
    }

}