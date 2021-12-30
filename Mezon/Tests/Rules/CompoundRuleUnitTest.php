<?php
namespace Mezon\Tests\Rules;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\CompoundRule;
use Mezon\Rules\Terminal\CharSet\OneOrMore;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class CompoundRuleUnitTest extends TestCase
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
            // #1, the second case, not matches
            [
                'aac',
                false
            ],
            // #2, the third case, not matches, all rules must be applied
            [
                'aa',
                false
            ],
            // #3, the forth case, not matches, empty strings are not allowed
            [
                '',
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
        $rule = new CompoundRule();
        $rule->addRule(new OneOrMore('a'));
        $rule->addRule(new OneOrMore('b'));

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
