<?php
namespace Mezon\Tests\RealLifeCases;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\CompoundRule;
use Mezon\Rules\Terminal\CharSet\OneOrMore;
use Mezon\Rules\Terminal\CharSet\OneExactly;
use Mezon\Rules\Terminal\CharSet\OneExactlyOrNothing;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class FixPointFloatUnitTest extends TestCase
{

    /**
     * Testing data provider
     *
     * @return array testing data
     */
    public function validateDataProvider(): array
    {
        return [
            // #0
            [
                '1.0',
                true
            ],
            // #1
            [
                '11.00122',
                true
            ],
            // #2
            [
                '+1.00',
                true
            ],
            // #3
            [
                '-1.00',
                true
            ],
            // #4
            [
                '-.00',
                false
            ],
            // #5
            [
                '--0.00',
                false
            ],
            // #6
            [
                '++0.0',
                false
            ],
            // #6
            [
                '0.',
                false
            ]
        ];
    }

    /**
     * Testing method validate for simple cases (context free grammars)
     *
     * @param string $stringToValidate
     *            string to validate
     * @param bool $expectedResult
     *            expected result of validation
     * @dataProvider validateDataProvider
     */
    public function testValidate(string $stringToValidate, bool $expectedResult): void
    {
        // setup
        $grammar = new FormalGrammar(
            new CompoundRule(
                new OneExactlyOrNothing('-+'),
                new OneOrMore('0123456789'),
                new OneExactly('.'),
                new OneOrMore('0123456789')));

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
