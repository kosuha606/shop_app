<?php

namespace App\Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Setup;

class DataManager
{
    /**
     * @var array
     */
    private $entityPaths;

    /**
     * @var array
     */
    private $credentials;

    /**
     * @var EntityManagerInterface
     */
    private $entityManger;

    public function __construct(array $entityPaths, array $credentials)
    {
        $this->entityPaths = $entityPaths;
        $this->credentials = $credentials;
    }

    /**
     * @return EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function getEntityManager(): EntityManagerInterface
    {
        if (!$this->entityManger) {
            $config = Setup::createAnnotationMetadataConfiguration($this->entityPaths, false, null, null, false);
            $this->entityManger = EntityManager::create($this->credentials, $config);
        }

        return $this->entityManger;
    }
}