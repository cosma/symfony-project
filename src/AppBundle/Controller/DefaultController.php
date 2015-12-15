<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Url;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ]);
    }

    /**
     * @Route("/make-short", name="shorten_url")
     */
    public function shortenAction(Request $request)
    {
        $url = new Url();

        $form = $this->createFormBuilder($url)
                     ->add('original_url', TextType::class)
                     ->add('save', SubmitType::class, ['label' => 'Shorten'])
                     ->getForm()
        ;

        $form->handleRequest($request);

        $latestShortenUrl = [];

        if ($form->isSubmitted() && $form->isValid()) {

            $url->setShortenUrl('ssnth');

            $form = $this->createFormBuilder($url)
                         ->add('shorten_url', TextType::class)
                         ->add('save', SubmitType::class, ['label' => 'Copy'])
                         ->getForm()
            ;

            $entityManager = $this->get('doctrine')->getManager();

            $entityManager->persist($url);

            $entityManager->flush();

            $URLRepository = $entityManager->getRepository('AppBundle:Url');

            $latestShortenUrl = $URLRepository->findAll();
        }

        return $this->render(
            'default/index.html.twig',
            [
                'form'              => $form->createView(),
                'latestShortenURLs' => $latestShortenUrl
            ]
        );
    }

    /**
     * @Route("/r/{url}")
     * @ParamConverter("user", class="AppBundle:Url", options={
     *    "repository_method" = "findByShortenUrl",
     *    "mapping": {"url": "shortenUrl"},
     *    "map_method_signature" = true
     * })
     */
    public function redirectUrl(Url $url)
    {

        print_r($url->getId());


    }

}
