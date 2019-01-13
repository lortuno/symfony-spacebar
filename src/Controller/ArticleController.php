<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{
	/**
	 * @Route("/")
	 */
	public function homepage()
	{
		return new Response('Epa!');
	}

	/**
	 * @Route("/news/{$slug}")
	 */
	public function show($slug)
	{
		return new Response(sprintf(
			'This is gonna be my article named:  "%s"',
			$slug
		));
	}

	/**
	 * @Route("/feed/does-a-regular-feed-work")
	 */
	public function showFeed()
	{
		return new Response('This is gonna be my feed whatever. ');

	}
}
