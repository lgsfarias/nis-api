<?php

namespace App\Util;

class NISUtil {

    // A validação do NIS foi baseado no algoritmo do link abaixo:
    // https://www.macoratti.net/alg_pis.htm

    const NIS_REGEX = '/^[0-9]{11}$/';
    const WEIGHTS = [3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    static function generateNIS(): string
    {
        $baseNIS = str_pad((string)random_int(100000000, 999999999), 10, '0', STR_PAD_LEFT);

        $sum = 0;
        foreach (self::WEIGHTS as $i => $weight) {
            $sum += $baseNIS[$i] * $weight;
        }

        $remainder = $sum % 11;
        $digit = 11 - $remainder;
        if ($digit >= 10) {
            $digit = 0;
        }

        return $baseNIS . $digit;
    }

    static function isValidNis(string $nis): bool
    {
        if (!preg_match(self::NIS_REGEX, $nis)) {
            return false;
        }

        $baseNIS = substr($nis, 0, 10);
        $sum = 0;
        foreach (self::WEIGHTS as $i => $weight) {
            $sum += $baseNIS[$i] * $weight;
        }

        $remainder = $sum % 11;
        $digit = 11 - $remainder;
        if ($digit >= 10) {
            $digit = 0;
        }

        return $digit === (int)$nis[10];
    }
}
