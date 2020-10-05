<?php

namespace App\Core;

use App\Core\Interfaces\ApplicationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ControllerResolver implements ControllerResolverInterface
{
    /**
     * @var ApplicationInterface
     */
    private $application;

    public function __construct(ApplicationInterface $application)
    {
        $this->application = $application;
    }

    /**
     * @param Request $request
     * @return array|callable|false
     */
    public function getController(Request $request)
    {
        $config = $this->application->getConfig();
        $path = $request->getRequestUri();

        if (isset($config['routes'][$path])) {
            $controllerConfig = $config['routes'][$path];

            if (in_array($request->getMethod(), $controllerConfig[2])) {
                $controllerClass = $controllerConfig[0];
                $controller = new $controllerClass($this->application);

                return [$controller, $controllerConfig[1]];
            }
        }

        throw new NotFoundHttpException('Page was not found');
    }
}