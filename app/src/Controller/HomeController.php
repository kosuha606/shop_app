<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Core\DataManager;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        /** @var EntityManagerInterface $em */
        $em = $this->app()->getContainer()->get(DataManager::class)->getEntityManager();
        $products = $em->getRepository(Product::class)->findAll();
        $this->jsVars['_products'] = $products;
        $this->jsVars['_order'] = new \stdClass();

        return $this->renderView('home.php', [
            'products' => $products
        ]);
    }
}
