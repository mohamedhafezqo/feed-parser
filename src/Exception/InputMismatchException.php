<?php declare(strict_types=1);

namespace App\Exception;

use App\Exception\LogicalException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class InputMismatchException
 *
 * @package App\Exception
 */
class InputMismatchException extends LogicalException
{
    public function __construct($actualInput)
    {
        parent::__construct(
            sprintf(
                'Illegal argument input (%s)',
                $actualInput,
            ),
            Response::HTTP_BAD_REQUEST
        );

    }
}
