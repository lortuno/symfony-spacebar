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
	 * @Route("/news/{$articleName}")
	 */
	public function show($articleName)
	{
		return new Response(sprintf(
			'This is gonna be my article named:  "%s"',
			$articleName
		));
	}
}
