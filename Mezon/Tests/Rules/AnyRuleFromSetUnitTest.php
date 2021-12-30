<?php
namespace Mezon\Tests\Rules;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\AnyRuleFromSet;
use Mezon\Rules\Terminal\CharSet\OneOrMore;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class AnyRuleFromSetUnitTest extends TestCase
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
            // #1, the second case, matches
            [
                'aac',
                true
            ],
            // #2, the third case, not matches
            [
                'cccbbcc',
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
        $rule = new AnyRuleFromSet();
        $rule->addRule(new OneOrMore('ab'));
        $rule->addRule(new OneOrMore('ac'));

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }
}
