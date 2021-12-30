<?php
namespace Mezon\Tests\Rules;

use PHPUnit\Framework\TestCase;
use Mezon\FormalGrammar;
use Mezon\Rules\Complex\CompoundRule;
use Mezon\Rules\Terminal\Literal\EmptyString;
use Mezon\Rules\Complex\AnyRuleFromSet;
use Mezon\Rules\Terminal\Literal\CaseSensitive\CaseSensitiveLiteral;
use Mezon\Rules\Terminal\CharSet\MoreThanOne;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class EmptyStringUnitTest extends TestCase
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
                ' ',
                true
            ],
            // #1, the second case, matches
            [
                '  ',
                true
            ],
            // #2, the third case, matches, all rules must be applied
            [
                ' literal',
                true
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
        $literalOrNothing = new CompoundRule();
        $literalOrNothing->addRule(new CaseSensitiveLiteral('literal'));
        $literalOrNothing->addRule(new EmptyString());

        $rule = new AnyRuleFromSet();
        $rule->addRule(new MoreThanOne(' '));
        $rule->addRule($literalOrNothing);

        $grammar = new FormalGrammar($rule);

        // test body
        $result = $grammar->validate($stringToValidate);

        // assertions
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * Testing method validate empty string
     */
    public function testValidateEmptyString(): void
    {
        // setup
        $grammar = new FormalGrammar(new EmptyString());

        // test body and assertions
        $this->assertTrue($grammar->validate(''));
        $this->assertFalse($grammar->validate(' '));
    }
}
