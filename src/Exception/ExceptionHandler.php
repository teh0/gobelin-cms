<?php


namespace App\Exception;


use App\Utils\Constants\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionHandler
{
    const URL_ROUTE_CRITERIA = 'route_url';
    const NAME_ROUTE__CRITERIA = 'route_url';

    /**
     * @param \Throwable $exception
     *
     * @return mixed
     */
    public function getUrlRedirection(\Throwable $exception)
    {
        return $this->getInfoFromRules($exception, self::URL_ROUTE_CRITERIA);
    }

    /**
     * @param \Throwable $exception
     *
     * @return mixed
     */
    public function getNameRedirection(\Throwable $exception)
    {
        return $this->getInfoFromRules($exception, self::NAME_ROUTE__CRITERIA);
    }

    /**
     * @param \Throwable $exception
     * @param string     $criteria
     *
     * @return mixed
     */
    private function getInfoFromRules(\Throwable $exception, $criteria)
    {
        $instance = $this->getExceptionInstance($exception);
        $rules = $this->rules();

        return array_key_exists($instance, $rules) ? $rules[$instance][$criteria] : $rules['default'][$criteria];
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            NotFoundHttpException::class => [ // @TODO Change to 404 page when it will be ready
                'route_url' => '/404',
                'route_name' => Route::ERROR_404
            ],

            AccessDeniedHttpException::class => [
                'route_url' => '/login',
                'route_name' => Route::LOGIN
            ],

            'default' => [
                'route_url' => '/',
                'route_name' => Route::HOME_VISITOR
            ]
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
