<?php

namespace App\Service;

use App\Core\DataManager;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ProductService
{
    /**
     * @var DataManager
     */
    private $dataManager;

    public function __construct(DataManager $dataManager)
    {
        $this->dataManager = $dataManager;
    }

    /**
     * Генерирует набор продуктов, если в БД пусто
     *
     * @return bool
     */
    public function generateProducts(): bool
    {
        $fixtures = require_once __DIR__.'/../../config/product_fixtures.php';
        /** @var EntityManagerInterface $em */
        $em = $this->dataManager->getEntityManager();
        /** @var EntityRepository $repository */
        $repository = $em->getRepository(Product::class);
        $productsCount = $repository->count([]);
        $wasGenerated = false;

        if ($productsCount === 0) {
            foreach ($fixtures as $fixture) {
                $product = new Product($fixture['name'], $fixture['price']);
                $em->persist($product);
            }

            $wasGenerated = true;
        }

        $em->flush();

        return $wasGenerated;
    }
}