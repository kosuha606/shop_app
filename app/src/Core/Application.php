<?php

namespace App\Core;

use App\Core\Interfaces\ApplicationInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernel;

class Application implements ApplicationInterface
{
    /**
     * @var array
     */
    private $config;

    /** @var ContainerInterface */
    private $container;

    /** @var Request */
    private $request;

    /**
     * @var \Throwable|null
     */
    private $requestException = null;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @throws \Exception
     */
    public function run(): void
    {
        $this->request = Request::createFromGlobals();
        $dispatcher = new EventDispatcher();
        $controllerResolver = new ControllerResolver($this);
        $argumentResolver = new ArgumentResolver();
        $kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

        try {
            $response = $kernel->handle($this->request);
        } catch (\Throwable $exception) {
            $this->requestException = $exception;
            $errorControllerClass = $this->config['errorRoute'][0];
            $errorController = new $errorControllerClass($this);
            $response = call_user_func([$errorController, $this->config['errorRoute'][1]]);
        }

        $response->send();
        $kernel->terminate($this->request, $response);
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @return Request
     */
    public function request(): Request
    {
        return $this->request;
    }

    public function requestException(): ?\Throwable
    {
        return $this->requestException;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        if (!$this->container) {
            $containerBuilder = new ContainerBuilder();
            $this->container = $containerBuilder;

            foreach ($this->config['container'] as $containerizedClassName => $classConfig) {
                $containerElement = $containerBuilder->register($containerizedClassName, $containerizedClassName);

                if (!isset($classConfig['arguments'])) {
                    continue;
                }

                foreach ($classConfig['arguments'] as $classArgument) {
                    $containerElement->addArgument($classArgument);
                }
            }
        }

        return $this->container;
    }
}