<?php declare(strict_types=1);

namespace App\Exception;

use App\Exception\LogicalException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class NotSupportedException
 *
 * @package App\Exception
 */
class NotSupportedException extends LogicalException
{
    public function __construct($type)
    {
        parent::__construct(
            sprintf(
                'Sorry (%s) is not supported type',
                $type,
            ),
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

    }
}
