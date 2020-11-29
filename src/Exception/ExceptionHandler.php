<?php


namespace App\Exception;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

class ExceptionHandler
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function handle(ExceptionEvent $exceptionEvent): void {
        $exception = $exceptionEvent->getThrowable();
        $exceptionEvent->setResponse($this->getResponse($exception));
    }

    /**
     * @param \Throwable $exception
     *
     * @return Response
     */
    private function getResponse(\Throwable $exception): Response
    {
        $instance = $this->getExceptionInstance($exception);
        $responses = $this->responses();

        return array_key_exists($instance, $responses) ? $responses[$instance]() : $responses['default']();
    }

    /**
     * @return array
     */
    private function responses(): array
    {
        return [
            NotFoundHttpException::class => function(): Response {
                return new Response($this->twig->render('pages/error/error404.html.twig'));
            },

            AccessDeniedHttpException::class => function(): Response {
                return new RedirectResponse('/');
            },

            'default' => function(): Response {
                return new RedirectResponse('/');
            }
        ];
    }

    /**
     * @param \Throwable $exception
     *
     * @return string
     */
    public function getExceptionInstance(\Throwable $exception): string
    {
        return get_class($exception);
    }

}
