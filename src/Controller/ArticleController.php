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
		$comments = [
			'This is gonna be my first comment',
			'Part2',
			'It will be awesome when this has css'
		];

		// Let's dump some things with the dumper library
		dump($articleName, $this);

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
