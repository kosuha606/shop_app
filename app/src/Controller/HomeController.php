<?php

namespace App\Controller;

use App\Core\AbstractController;
use App\Core\DataManager;

class HomeController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function homeAction()
    {
        $em = $this->app()->getContainer()->get(DataManager::class)->getEntityManager();

        return $this->renderView('home.php', []);
    }
}
