<?
namespace app\controllers;

class MainController
{
  public function __construct($params)
  {
    debug($params);
  }

  public function indexAction()
  {
    echo __METHOD__;
  }
}
