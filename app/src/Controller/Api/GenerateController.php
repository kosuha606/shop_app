<?php

namespace App\Controller\Api;

use App\Core\AbstractController;

class GenerateController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function productAction()
    {
        return $this->asJson([
            'result' => true
        ]);
    }
}
