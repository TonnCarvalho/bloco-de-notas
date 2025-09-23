<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Exception;

class OperationsServices
{
    public static function descryptId(string $value)
    {
        try {
            $value = Crypt::decrypt($value);
        } catch (Exception $e) {
            return redirect()->route('/');
        }
        return $value;
    }
}
