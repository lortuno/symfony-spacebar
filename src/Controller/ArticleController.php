<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
	public function show($articleName)
	{
		$comments = [
			'This is gonna be my first comment',
			'Part2',
			'It will be awesome when this has css'
		];

		return $this->render('article/show.html.twig', [
			'title' => ucwords(str_replace('-', ' ', $articleName)),
			'comments' => $comments,
            'articleName' => $articleName,
		]);
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
        return new JsonResponse(['likes' => rand(5,100)]);
    }
}
