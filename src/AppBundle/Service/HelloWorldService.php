<?php
namespace AppBundle\Service;

use AppBundle\Entity\World;
use Doctrine\Common\Persistence\AbstractManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;

class HelloWorldService
{
    /**
     * @type ObjectManager
     */
    private $objectManager;

    /**
     * @type Logger
     */
    private $logger;

    /**
     * @type string
     */
    private $mainString = "Hello World ";

    /**
     * HelloWorldService constructor.
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $objectManager
     * @param \Symfony\Bridge\Monolog\Logger             $logger
     */
    public function __construct(ObjectManager $objectManager, Logger $logger)
    {
        $this->objectManager = $objectManager;
        $this->logger        = $logger;
    }

    /**
     * @param \AppBundle\Entity\World $world
     *
     * @return string
     */
    public function removeWorld(World $world)
    {
        $this->objectManager->remove($world);
        $this->objectManager->flush();

        return "removed";
    }

    /**
     * @return string
     */
    public function sayHello()
    {
        $this->logger->info("going to say hello");

        return $this->mainString;
    }

    public function sayHelloToWorld(World $world)
    {
        return $this->sayHello() . $world->getName();
    }
}

?>