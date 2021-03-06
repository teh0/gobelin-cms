<?php


namespace App\EventSubscriber;


use App\Exception\ExceptionHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{

    /**
     * @var ExceptionHandler
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
        $this->exceptionHandler->handle($exceptionEvent);
    }

}