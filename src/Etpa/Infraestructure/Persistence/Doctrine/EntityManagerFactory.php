<?php

namespace Etpa\Infraestructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class EntityManagerFactory
{
    public function build()
    {
        $config = Setup::createYAMLMetadataConfiguration([__DIR__.'/config'], true);
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../../../../db.sqlite',
        );

        return EntityManager::create($conn, $config);
    }
}
