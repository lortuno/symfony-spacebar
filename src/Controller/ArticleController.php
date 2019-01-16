<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
	/**
	 * @Route("/")
	 */
	public function homepage()
	{
		return new Response('Epa!');
	}

	/**
	 * @Route("/news/{articleName}")
	 */
	public function show($articleName)
	{
		return $this->render('article/show.html.twig', [
			'title' => ucwords(str_replace('-', ' ', $articleName)),
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
