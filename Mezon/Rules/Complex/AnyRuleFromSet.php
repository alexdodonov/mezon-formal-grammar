<?php
namespace Mezon\Rules\Complex;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;

/**
 * Rule wich allows the defined set of characters
 *
 * @package FormalGrammar
 * @subpackage AnyRuleFromSet
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * This rule tries to apply subrules in any order it can
 *
 * @author gdever
 */
class AnyRuleFromSet extends RulesSet
{

    /**
     *
     * {@inheritdoc}
     * @see RuleInterface::validate()
     */
    public function validate(StringIterator $iterator, bool &$ruleWasApplied): StringIterator
    {
        // we apply rules in greedy mode
        $appliedLength = 0;
        $appliedIterator = $iterator;

        // find the one wich fits
        foreach ($this->getRules() as $rule) {
            $atLeastOneRuleWasApplied = false;
            $newIterator = $rule->validate($iterator, $atLeastOneRuleWasApplied);

            // is the applied rule more greedy than previos ones
            if ($atLeastOneRuleWasApplied && $newIterator->current() - $iterator->current() >= $appliedLength) {
                // ^^^ here we have '>=' if the sub rule makes available empty strings valid
                $appliedIterator = $newIterator;
                $appliedLength = $newIterator->current() - $iterator->current();
                $ruleWasApplied = true;
            }
        }

        // return result
        return $appliedIterator;
    }
}
