<?php
namespace Mezon\Rules\Terminal\Literal;

use Mezon\Rules\RuleInterface;

/**
 * Base rule class wich defines literals (case sensitive or case insensitive)
 *
 * @package FormalGrammar
 * @subpackage LiteralBase
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Base rule class wich defines literals (case sensitive or case insensitive)
 *
 * @author gdever
 */
abstract class LiteralBase implements RuleInterface
{

    /**
     * Literal
     *
     * @var string
     */
    private $literal = '';

    /**
     * Constructor
     *
     * @param string $literal
     *            the defined literal
     */
    public function __construct(string $literal)
    {
        $this->literal = $literal;
    }

    /**
     * Method returns literal
     *
     * @return string literal
     */
    public function getLiteral(): string
    {
        return $this->literal;
    }

    /**
     * Method compares two strings.
     * Must be overriden in the derived classes
     *
     * @param string $str1
     *            the first string to compare
     * @param string $str2
     *            the second string to compare
     * @return bool true if the strings are equal
     */
    protected abstract function compare(string $str1, string $str2): bool;
}
