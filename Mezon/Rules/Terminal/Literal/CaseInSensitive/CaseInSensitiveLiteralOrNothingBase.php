<?php
namespace Mezon\Rules\Terminal\Literal\CaseInSensitive;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;
use Mezon\Rules\Complex\AnyRuleFromSet;
use Mezon\Rules\Terminal\Literal\CaseSensitive\CaseSensitiveLiteralBase;
use Mezon\Rules\Terminal\Literal\EmptyString;

/**
 * Base class for the rule wich defines case sensitive literal or empty string
 *
 * @package FormalGrammar
 * @subpackage CaseInSensitiveLiteralOrNothingBase
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Base class for the rule wich defines case sensitive literal or empty string
 *
 * @author gdever
 */
class CaseInSensitiveLiteralOrNothingBase implements RuleInterface
{

    /**
     * List of rules
     *
     * @var AnyRuleFromSet
     */
    private $anyRuleFromSet;

    /**
     * Constructor
     *
     * @param CaseSensitiveLiteralBase $rule
     *            rule for literal validation
     */
    public function __construct(CaseSensitiveLiteralBase $rule)
    {
        $this->anyRuleFromSet = new AnyRuleFromSet();

        $this->anyRuleFromSet->addRule($rule);
        $this->anyRuleFromSet->addRule(new EmptyString());
    }

    /**
     *
     * {@inheritdoc}
     * @see RuleInterface::validate()
     */
    public function validate(StringIterator $iterator, bool &$ruleWasApplied): StringIterator
    {
        return $this->anyRuleFromSet->validate($iterator, $ruleWasApplied);
    }
}

