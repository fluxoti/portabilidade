<?php namespace Portabilidade\Consultations;

class ConsultSanitizer
{
    public function sanitize($number)
    {
        $number = ltrim($number, '0');
        $ddd = substr($number, 0, 2);
        if (strlen($number) == 11) {
            $pre = substr($number, 2, 5);
            $mcd = substr($number, 7, 4);
        } else {
            $pre = substr($number, 2, 4);
            $mcd = substr($number, 6, 4);
        }

        return ['ddd' => $ddd, 'pre' => $pre, 'mcd' => $mcd];
    }
}