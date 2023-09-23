<?php

namespace App\Tests\Util;

use App\Util\NISUtil;
use PHPUnit\Framework\TestCase;

class NISUtilTest extends TestCase
{
    public function testIsValidNis()
    {
        $validNIS = NISUtil::generateNIS();
        $this->assertTrue(NISUtil::isValidNis($validNIS));

        $invalidNIS = '12345678901'; // NIS arbitrário
        $this->assertFalse(NISUtil::isValidNis($invalidNIS));
    }

    public function testGenerateNIS()
    {
        $nis = NISUtil::generateNIS();
        $this->assertMatchesRegularExpression(NISUtil::NIS_REGEX, $nis);
        $this->assertTrue(NISUtil::isValidNis($nis));
    }
}