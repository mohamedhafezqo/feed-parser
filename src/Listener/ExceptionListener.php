<?php declare(strict_types=1);

namespace App\Listener;

use App\Exception\LogicalException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

/**
 * Class ExceptionListener
 *
 * @package App\Listener
 */
class ExceptionListener
{
    protected SessionInterface $session;

    /**
     * ExceptionListener constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof LogicalException) {
            $this->session->getFlashBag()->add('danger', $exception->getMessage());
            $response = new RedirectResponse(
                $event->getRequest()->headers->get('referer')
            );
            $event->setResponse($response);
        }
    }
}
