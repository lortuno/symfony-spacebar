<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
	 * @Route("/news/{articleName}, name="article_show")
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
		]);
	}

	/**
	 * @Route("/article/{articleName}")
	 */
	public function publish($articleName)
	{
		return new Response(
			'This is gonna be my article named:' . $articleName
		);
	}

	/**
	 * @Route("/feed/does-a-regular-feed-work")
	 */
	public function showFeed()
	{
		return new Response('This is gonna be my feed whatever. ');
	}
}
