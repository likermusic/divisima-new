<?
use app\core\Router;

spl_autoload_register(function ($class) {
  echo $class;
  $class = str_replace('\\', '/', $class);
  require_once "{$class}.php";
});


new Router();