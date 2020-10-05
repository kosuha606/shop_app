<?php

namespace App\Controller\Api;

use App\Core\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function catalogAction()
    {
        return $this->asJson([
            'result' => true
        ]);
    }
}