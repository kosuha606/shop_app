<?php

namespace App\Core;

use App\Core\Interfaces\ApplicationInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractController
{
    protected $layout = 'layouts/main.php';

    protected $jsVars = [];

    /**
     * @var ApplicationInterface
     */
    private $application;

    public function __construct(ApplicationInterface $application)
    {
        $this->application = $application;
    }

    /**
     * @return ApplicationInterface
     */
    public function app(): ApplicationInterface
    {
        return $this->application;
    }

    /**
     * @param array $args
     * @return Response
     */
    public function asJson(array $args): Response
    {
        $response = new JsonResponse($args, 200);

        return $response;
    }

    /**
     * @param string $view
     * @param array $args
     * @return Response
     */
    public function renderView(string $view, array $args, int $status = 200): Response
    {
        $pageView = $this->renderViewPartial($view, $args);
        $layoutView = $this->renderViewPartial($this->layout, ['content' => $pageView]);

        return new Response($layoutView, $status);
    }

    /**
     * @param string $view
     * @param array $args
     * @return string
     */
    public function renderViewPartial(string $view, array $args): string
    {
        $viewPath = $this->application->getConfig()['viewPath'];
        ob_start();
        ob_implicit_flush(false);
        extract($args);
        require $viewPath.$view;
        $content = ob_get_clean();

        return $content;
    }
}