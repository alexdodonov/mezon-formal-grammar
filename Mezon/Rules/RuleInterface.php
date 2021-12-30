<?php
namespace Mezon\Rules;

use Mezon\StringIterator;

/**
 * Common interface for all rules
 *
 * @package FormalGrammar
 * @subpackage RuleInterface
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Common interface for all rules
 *
 * @author gdever
 */
interface RuleInterface
{

    /**
     * Method validates string
     *
     * @param StringIterator $iterator
     *            iterator for validating string
     * @param bool $ruleWasApplied
     *            was the rool applied
     * @return StringIterator iterator after validation
     */
    public function validate(StringIterator $iterator, bool &$ruleWasApplied): StringIterator;
}
