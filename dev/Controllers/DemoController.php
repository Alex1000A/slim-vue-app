<?php


namespace App\Controllers;


use App\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class DemoController extends Controller
{
	/**
	 * GET /
	 * @param Request $request
	 * @param Response $response
	 * @return Response
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function home(Response $response, Request $request){
		// thx to the PHP-DI bridge, we can inject arguments however we want
		return $this->view->render($response, "demo.twig", [
			"phpver" => phpversion()
		]);
	}

	/**
	 * GET /user/{user_}
	 * @param Request $request
	 * @param Response $response
	 * @param string $user_
	 * @return Response
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function user(Request $request, Response $response, string $user_){
		// $user is the {user} route parameter
		return $this->view->render($response, "demo2.twig", [
			"user" => $user_,
		]);
	}

	/**
	 * GET /vmb/{user}
	 * @param Request $request
	 * @param Response $response
	 * @param User $myUser
	 * @return Response
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	public function vmb(Request $request, Response  $response, User $myUser){
		return $this->view->render($response, "demo3.twig", [
			"user" => $myUser,
		]);
	}

}
