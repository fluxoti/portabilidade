<?php namespace Portabilidade\Consultations;

interface ConsultationRepositoryInterface {

    public function consult($ddd, $prefix, $ddd);
    public function debit($billing_info);

}