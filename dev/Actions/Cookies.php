<?php

namespace App\Actions;


use Dflydev\FigCookies\Cookie;
use Dflydev\FigCookies\FigRequestCookies;
use Dflydev\FigCookies\FigResponseCookies;
use Dflydev\FigCookies\SetCookie;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use DI\Container;
use Slim\Psr7\Response;
use App\Actions\Response as ResponseAction;

class Cookies extends Action
{
	/**@var ResponseAction $resp*/
	protected $resp;

	public function __construct(Container $container)
	{
		parent::__construct($container);
		$this->resp = $container->get(ResponseAction::class);
	}

	protected function upgrade(ResponseInterface $res): Response
	{
		return $this->resp->upgrade($res);
	}

	public function builder(string $name): SetCookie
	{
		return SetCookie::create($name);
	}

	public function set(Response $res, SetCookie $cookie): Response
	{
		return $this->upgrade(FigResponseCookies::set($res, $cookie));
	}

	public function get(ServerRequestInterface $rq, string $name, ?string $default = null): Cookie
	{
		return FigRequestCookies::get($rq, $name, $default);
	}

	public function has(ServerRequestInterface $rq, string $name): bool
	{
		return $this->get($rq, $name)->getValue() !== null;
	}

	public function expire(Response $res, string $name): Response
	{
		return $this->upgrade(FigResponseCookies::expire($res, $name));
	}

	public function remove(Response $res, string $name): Response
	{
		return $this->upgrade(FigResponseCookies::remove($res, $name));
	}
}
