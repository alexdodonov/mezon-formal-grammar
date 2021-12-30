<?php
namespace Mezon\Rules\Terminal\Literal\CaseInSensitive;

/**
 * Rule wich defines case in sensitive literal or empty string
 *
 * @package FormalGrammar
 * @subpackage CaseInSensitiveLiteralOrNothing
 * @author Dodonov A.A.
 * @version v.1.0 (2021/12/29)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Rule wich defines case in sensitive literal or empty string
 *
 * @author gdever
 */
class CaseInSensitiveLiteralOrNothing extends CaseInSensitiveLiteralOrNothingBase
{

    /**
     * Constructor
     *
     * @param string $literal
     *            the defined literal
     */
    public function __construct(string $literal)
    {
        parent::__construct(new CaseInSensitiveLiteral($literal));
    }
}

