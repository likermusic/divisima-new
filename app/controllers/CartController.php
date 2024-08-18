<?
namespace app\controllers;

use app\core\Controller;

class CartController extends Controller
{
  public function indexAction()
  {
    // $banners_urls = $this->model->get_banners();
    $banners = 23;
    if (empty($_SESSION['user'])) {

    } else {
      $cart = $this->model->get_cart($_SESSION['user']);
    }
    $data = compact('cart');
    $this->view->render((object) $data);
  }

}