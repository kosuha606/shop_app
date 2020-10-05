<?php

namespace App\Controller\Api;

use App\Core\AbstractController;
use App\Service\ProductService;

class GenerateController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function productAction()
    {
        return $this->asJson([
            'result' => true,
            'wasGenerated' => $this
                ->app()
                ->getContainer()
                ->get(ProductService::class)
                ->generateProducts(),
        ]);
    }
}
