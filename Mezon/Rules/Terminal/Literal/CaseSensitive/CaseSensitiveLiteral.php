<?php
namespace Mezon\Rules\Terminal\Literal\CaseSensitive;

/**
 * Rule wich defines case sensitive literal
 *
 * @package FormalGrammar
 * @subpackage CaseSensitiveLiteral
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Rule wich defines case sensitive literal
 *
 * @author gdever
 */
class CaseSensitiveLiteral extends CaseSensitiveLiteralBase
{

    /**
     *
     * {@inheritdoc}
     * @see CaseSensitiveLiteralBase::compare()
     */
    protected function compare(string $str1, string $str2): bool
    {
        return strcmp($str1, $str2) === 0;
    }
}
