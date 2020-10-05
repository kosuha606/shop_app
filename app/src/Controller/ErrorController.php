<?php

namespace App\Controller;

use App\Core\AbstractController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ErrorController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function errorAction()
    {
        $exception = $this->app()->requestException();
        $status = 500;

        if ($exception instanceof HttpException) {
            $status = $exception->getStatusCode();
        }

        return $this->renderView('error.php', [
            'exception' => $exception,
            'isDebug'   => $this->app()->getConfig()['isDebug'],
            'status'    => $status,
        ], $status);
    }
}