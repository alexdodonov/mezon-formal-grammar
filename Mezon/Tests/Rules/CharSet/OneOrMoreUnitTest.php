<?php
namespace Mezon\Tests\Rules\CharSet;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\RulesInAnyOrder;
use Mezon\Rules\Terminal\CharSet\OneOrMore;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class OneOrMoreUnitTest extends TestCase
{

    /**
     * Testing data provider
     *
     * @return array testing data
     */
    public function validateDataProvider(): array
    {
        return [
            // #0, the first case, matches
            [
                'aab',
                true
            ],
            // #1, the second case, unexpected symbol
            [
                'aac',
                false
            ]
        ];
    }

    /**
     * Testing method validate for OneOrMoreCharFromSet rule
     *
     * @param string $stringToValidate
     *            string to validate
     * @param bool $expectedResult
     *            expected result of validation
     * @dataProvider validateDataProvider
     */
    public function testOneOrMoreRule(string $stringToValidate, bool $expectedResult): void
    {
        // setup
        $rule = new RulesInAnyOrder();
        $rule->addRule(new OneOrMore('ab'));

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
