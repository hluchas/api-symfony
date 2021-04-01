<?php

namespace App\Tests\Shortener;

use App\Shortener\ShortGenerator;
use PHPUnit\Framework\TestCase;

class ShortGeneratorTest extends TestCase
{
    public function testGenerateRandomParameterName(): void
    {
        $generator = new ShortGenerator();

        $expectedValues = [
            '0',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            'a',
            'b',
            'c',
            'd',
            'e',
            'f',
            'g',
            'h',
            'i',
            'j',
            'k',
            'l',
            'm',
            'n',
            'o',
            'p',
            'q',
            'r',
            's',
            't',
            'u',
            'v',
            'w',
            'x',
            'y',
            'z',
            '10',
            '11',
        ];

        $i = 0;

        foreach ($expectedValues as $expectedValue) {
            $i++;
            self::assertSame($expectedValue, $generator->generate($i));
        }
    }
}
