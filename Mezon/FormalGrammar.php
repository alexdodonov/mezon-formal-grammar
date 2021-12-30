<?php
namespace Mezon;

use Mezon\Rules\RuleInterface;

/**
 * Main class
 *
 * @package FormalGrammar
 * @subpackage FormalGrammar
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Main class for interacting with formal grammar
 *
 * @author Dodonov A.A.
 */
class FormalGrammar
{

    /**
     * Root rule
     *
     * @var RuleInterface
     */
    private $rootRule;

    /**
     * Method sets rule
     *
     * @param RuleInterface $rule
     *            rule to be set
     */
    public function __construct(RuleInterface $rule)
    {
        $this->rootRule = $rule;
    }

    /**
     * Method validates string - was it formed according to the defined grammar?
     *
     * @param string $stringToValidate
     *            string to be validated
     * @return bool result of the validation
     */
    public function validate(string $stringToValidate): bool
    {
        // create iterator for the validating string
        $iterator = new StringIterator($stringToValidate);

        // find the one wich fits
        $ruleWasApplied = false;
        $iterator = $this->rootRule->validate($iterator, $ruleWasApplied);

        // thw whole string was parsed and rules were applied
        return $iterator->current() === $iterator->end() && $ruleWasApplied;
    }
}
