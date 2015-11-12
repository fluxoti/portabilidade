<?php namespace Portabilidade\Support;



class PhoneHelper  {

    public static function type($phone)
    {
        $phone = ltrim($phone, '0');

        if (!(is_numeric($phone) && strlen($phone) >= 10)) {
            return  'f';
        } else {
            if (strlen($phone) == 10) {
                $pre = substr($phone, 2, 4);

                if ($pre < 6000) {
                    return  'f';
                }
            } elseif (strlen($phone) == 11) {
                $pre = substr($phone, 2, 5);

                if ($pre < 96000) {
                    return 'f';
                }
            }
        }
        return 'm';
    }

}