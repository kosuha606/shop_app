<?php

namespace App\Controller\Api;

use App\Core\AbstractController;
use App\Entity\User;
use App\Service\OrderService;

class OrderController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        $data = json_decode($this->app()->request()->getContent(), true);
        $user = new User();

        return $this->asJson([
            'result' => true,
            'order' => $this
                ->app()
                ->getContainer()
                ->get(OrderService::class)
                ->createOrder($user, $data),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function completeAction()
    {
        $data = json_decode($this->app()->request()->getContent(), true);

        return $this->asJson([
            'result' => $this
                ->app()
                ->getContainer()
                ->get(OrderService::class)
                ->completeOrder($data),
        ]);
    }
}
