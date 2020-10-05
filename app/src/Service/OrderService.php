<?php

namespace App\Service;

use App\Core\DataManager;
use App\Entity\Product;
use App\Entity\ProductOrder;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;

class OrderService
{
    const PAYMENT_URL = 'https://ya.ru';

    const SUCCESS_PAYMENT_CODE = 200;

    /**
     * @var DataManager
     */
    private $dataManager;

    public function __construct(DataManager $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    /**
     * @param User $user
     * @param array $data
     * @return array
     * @throws \Doctrine\ORM\ORMException
     */
    public function createOrder(User $user, array $data): array
    {
        $em = $this->dataManager->getEntityManager();
        /** @var Product[] $products */
        $products = $em->getRepository(Product::class)->findById($data['productIds']);
        $total = 0;

        foreach ($products as $product) {
            $total += $product->getPrice();
        }

        $order = new ProductOrder();
        $order->setTotal($total);
        $order->setUserId($user->getId());
        $order->setOrderData(json_encode($data['productIds'], JSON_UNESCAPED_UNICODE));
        $order->setStatus(ProductOrder::STATUS_NEW);
        $em->persist($order);
        $em->flush();

        return [
            'id' => $order->getId(),
            'total' => $order->getTotal(),
        ];
    }

    /**
     * @param array $data
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function completeOrder(array $data): bool
    {
        $em = $this->dataManager->getEntityManager();
        /** @var ProductOrder $order */
        $order = $em->getRepository(ProductOrder::class)->findOneById($data['order']['id']);

        $result = false;
        if (
            $order &&
            $order->getTotal() === (int)$data['order']['total'] &&
            $order->getStatus() === ProductOrder::STATUS_NEW
        ) {
            $client = new Client(['base_uri' => self::PAYMENT_URL]);
            $response = $client->request('GET', '/');

            if ($response->getStatusCode() === self::SUCCESS_PAYMENT_CODE) {
                $result = true;
                $order->setStatus(ProductOrder::STATUS_PAYED);
                $em->persist($order);
                $em->flush();
            }
        }

        return $result;
    }
}