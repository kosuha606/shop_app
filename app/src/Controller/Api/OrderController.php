<?php

namespace App\Controller\Api;

use App\Core\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        return $this->asJson([
            'result' => true
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function completeAction()
    {
        return $this->asJson([
            'result' => true
        ]);
    }
}
