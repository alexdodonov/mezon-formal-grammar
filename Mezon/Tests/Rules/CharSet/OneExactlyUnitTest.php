<?php
namespace Mezon\Tests\Rules\CharSet;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Terminal\CharSet\OneExactly;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class OneExactlyUnitTest extends TestCase
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
                'a',
                true
            ],
            // #1
            [
                'b',
                true
            ],
            // #2
            [
                'ab',
                false
            ],
            // #3
            [
                '',
                false
            ]
        ];
    }

    /**
     * Testing method validate for MoreThanOneCharFromSet rule
     *
     * @param string $stringToValidate
     *            string to validate
     * @param bool $expectedResult
     *            expected result of validation
     * @dataProvider validateDataProvider
     */
    public function testOneExactlyRule(string $stringToValidate, bool $expectedResult): void
    {
        // setup
        $grammar = new FormalGrammar(new OneExactly('ab'));

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
