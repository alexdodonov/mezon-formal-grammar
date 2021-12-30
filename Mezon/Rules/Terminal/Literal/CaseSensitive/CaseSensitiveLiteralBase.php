<?php
namespace Mezon\Rules\Terminal\Literal\CaseSensitive;

use Mezon\StringIterator;
use Mezon\Rules\RuleInterface;
use Mezon\Rules\Terminal\Literal\LiteralBase;

/**
 * Base rule class wich defines literals (case sensitive or case insensitive)
 *
 * @package FormalGrammar
 * @subpackage CaseSensitiveLiteralBase
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Base rule class wich defines literals (case sensitive or case insensitive)
 *
 * @author gdever
 */
abstract class CaseSensitiveLiteralBase extends LiteralBase
{

    /**
     *
     * {@inheritdoc}
     * @see RuleInterface::validate()
     */
    public function validate(StringIterator $iterator, bool &$ruleWasApplied): StringIterator
    {
        $ruleWasApplied = false;
        $tmpIterator = clone $iterator;

        // wait for the end of the parsing string
        // and wait for the end of the checking literal
        while ($tmpIterator->current() <= $tmpIterator->end() &&
            $tmpIterator->current() - $iterator->current() < strlen($this->getLiteral())) {
            if (! $this->compare(
                $this->getLiteral()[$tmpIterator->current() - $iterator->current()],
                $tmpIterator->get())) {
                $ruleWasApplied = false;
                return $iterator;
            }
            $tmpIterator->next();
        }

        if ($tmpIterator->current() - $iterator->current() === strlen($this->getLiteral())) {
            // we have successfully reached the end of the checking literal
            $ruleWasApplied = true;
            $iterator = $tmpIterator;
        }

        return $iterator;
    }
}
