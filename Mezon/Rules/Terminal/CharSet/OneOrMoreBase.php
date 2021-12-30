<?php
namespace Mezon\Rules\Terminal\CharSet;

use Mezon\Rules\RuleInterface;

/**
 * Base class for the rule wich allows the defined set of characters
 *
 * @package FormalGrammar
 * @subpackage OneOrMoreBase
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Base class for the rule wich allows the defined set of characters
 * Empty strings are not allowed.
 * At least one character from the defined set of chars.
 *
 * @author gdever
 */
abstract class OneOrMoreBase implements RuleInterface
{

    /**
     * Charset
     *
     * @var string
     */
    private $charSet = '';

    /**
     * Constructor
     *
     * @param string $charSet
     *            the defined character set
     */
    public function __construct(string $charSet)
    {
        $this->charSet = $charSet;
    }

    /**
     * Method returns char set
     *
     * @return string char set
     */
    protected function getCharSet(): string
    {
        return $this->charSet;
    }
}
