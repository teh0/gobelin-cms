<?php


namespace App\EventSubscriber;


use App\Exception\ExceptionHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{

    /**
     * @var Handler
     */
    private $exceptionHandler;

    public function __construct(ExceptionHandler $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            ExceptionEvent::class => 'onKernelException'
        ];
    }

    /**
     * @param ExceptionEvent $exceptionEvent
     */
    public function onKernelException(ExceptionEvent $exceptionEvent)
    {
        /* Call custom exception handler */
        $redirectUrl = $this->exceptionHandler->getUrlRedirection($exceptionEvent->getThrowable());
        $exceptionEvent->setResponse(new RedirectResponse($redirectUrl));
    }

}