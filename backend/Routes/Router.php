<?php

namespace Backend\Routes;

use Backend\Http\HttpRequest;
use Backend\Http\HttpResponse;
use Backend\Database;

class Router
{
  private array $routes;

  public function __construct()
  {
    $this->routes = require 'Routes.php';
  }

  public function handle(HttpRequest $request)
  {
    $method = $request->get_method();
    $path = $request->get_path();

    if ($method === 'OPTIONS') {
      HttpResponse::send_json_response(null);
    }

    if (!isset($this->routes[$method][$path])) {
      HttpResponse::send_json_response(['error' => 'Not Found'], 404);
    }

    [$controller_class, $method_name] = $this->routes[$method][$path];

    $pdo = Database::connect_db();
    $controller = new $controller_class($pdo);

    if ($method === 'POST') {
      $body = $request->parse_body();
      $result = $controller->$method_name($body);
    } else {
      $result = $controller->$method_name();
    }

    HttpResponse::send_json_response($result);
  }
}
