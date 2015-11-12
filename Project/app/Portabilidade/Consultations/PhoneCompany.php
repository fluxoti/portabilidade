<?php namespace Portabilidade\Consultations;

use Eloquent;

class PhoneCompany extends Eloquent {

    protected $connection = 'portabilidade';

    protected $table = 'operadora';

    protected $primaryKey = 'rn1';

    public function Portability()
    {
        return $this->hasOne(
            'Portabilidade\Consultations\Portability',
            'rn1', 'rn1');
    }


}