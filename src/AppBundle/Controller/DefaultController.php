<?php

namespace AppBundle\Controller;

use AppBundle\Entity\World;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

    /**
     * @Route("/hello/{id}", name="homepage_hello")
     *
     * @ParamConverter("world", class="AppBundle:World")
     */
    public function helloAction(World $world)
    {
        $worldGreeterService = $this->get('app_bundle.world_greeter');

        return $this->render('default/default.html.twig', [
            't' => $worldGreeterService->sayHelloToWorld($world)
        ]);
    }

    /**
     * @Route("/helloback/{id}", name="homepage_hello_backwards")
     *
     * @ParamConverter("world", class="AppBundle:World")
     */
    public function helloBackwardsAction(World $world)
    {
        $worldGreeterService = $this->get('app_bundle.world_greeter');

        $tmp =  $worldGreeterService->sayHelloToWorld($world);
        $tmp2 = '';
        for ($x = strlen($tmp); $x > 0; $x--) {
            $tmp2 += $x;
        }
        return $this->render('default/default.html.twig', [
            't' => $tmp2
        ]);
    }

    /**
     * @Route("/remove/{id}", name="homepage_remove_world")
     *
     * @ParamConverter("world", class="AppBundle:World")
     *
     */
    public function removeWorldAction(World $world)
    {
        $worldGreeterService = $this->get('app_bundle.world_greeter');

        return $this->render('default/default.html.twig', [
            't' => $worldGreeterService->removeWorld($world)
        ]);
    }

    /**
     * @Route("/buildWorld", name="homepage_create_world")
     */
    public function createNewWorldAction(Request $request)
    {
        $manager = $this->get('doctrine')->getManager();
        $count   = $request->get('c');
        $id      = [];
        for ($x = 0; $x < $count; $x++) {
            $world       = new World();
            $world->name = $request->get('name');
            $manager->persist($world);
            $manager->flush();
            $id[] = $world->id;
        }
        $tmpStr = '';
        foreach ($id as $tmp)
            $tmpStr = $tmpStr . $tmp;

        return $this->render('default/default.html.twig', [
            't' => 'id: ' . $tmpStr
        ]);
    }
}
