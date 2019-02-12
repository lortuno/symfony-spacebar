<?php

namespace App\Controller;

// Sale como en desuso pero el PHPDoc lo usa
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Michelf\MarkdownInterface;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{articleName}", name="article_show")
     */
    public function show($articleName, MarkdownInterface $markdown)
    {
        $comments = [
            'This is gonna be my first comment',
            'Part2',
            'It will be awesome when this has css',
        ];

        $articleContent = "Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
            lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
            labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
            turkey shank eu pork belly meatball non cupim.<br>
            Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
            laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
            capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
            picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
            occaecat lorem meatball prosciutto quis strip steak.
            Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
            mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
            strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
            cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
            fugiat.";

        $articleContent = $markdown->transform($articleContent);

        return $this->render(
            'article/show.html.twig',
            [
                'title'          => ucwords(str_replace('-', ' ', $articleName)),
                'comments'       => $comments,
                'articleName'    => $articleName,
                'articleContent' => $articleContent,
            ]
        );
    }

    /**
     * @Route("/feed/does-a-regular-feed-work")
     */
    public function showFeed()
    {
        return new Response('This is gonna be my feed whatever. Example number two with a fixed article name');
    }

    /**
     * Modifica el número de likes de la página, identificando de qué article procede el like o dislike.
     * Lo envía por POST. ES un API endpoint.
     * @Route("/news/{articleName}/like", name="article_change_like", methods={"POST"})
     */
    public function updateArticleLikes($articleName)
    {
        // TODO -  Connect to real database
        return new JsonResponse(['likes' => rand(5, 100)]);
    }
}
