<?
namespace app\controllers;

use app\core\Controller;

class CartController extends Controller
{
  public function indexAction()
  {
    // $banners_urls = $this->model->get_banners();
    $banners = 23;

    $data = compact('banners');
    $this->view->render((object) $data);
  }

}