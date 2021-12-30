<?php
namespace Mezon\Rules\Terminal\Literal;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;

/**
 * Rule wich validates empty string
 *
 * @package FormalGrammar
 * @subpackage EmptyString
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Rule wich validates empty string
 *
 * @author gdever
 */
class EmptyString implements RuleInterface
{

    /**
     *
     * {@inheritdoc}
     * @see RuleInterface::validate()
     */
    public function validate(StringIterator $iterator, bool &$ruleWasApplied): StringIterator
    {
        $ruleWasApplied = true;

        return $iterator;
    }
}
