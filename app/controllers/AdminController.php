<?
namespace app\controllers;

use app\core\Controller;

class AdminController extends Controller
{
  public function indexAction()
  {
    $cart = 123;
    $data = compact('cart');
    $this->view->layout = 'admin';
    $this->view->render((object) $data);
  }
  public function usersAction()
  {
    //Доступ возможен только при авторизованном админе, в противном случае - 404
    $cart = 123;
    $data = compact('cart');
    $this->view->view = 'app/views/admin/users.php';
    $this->view->layout = 'admin_pages';
    $this->view->render((object) $data);
  }

  public function productsAction()
  {
    //Доступ возможен только при авторизованном админе, в противном случае - 404
    $cart = 123;
    $data = compact('cart');
    $this->view->layout = 'admin_pages';
    $this->view->render((object) $data);
  }

  // public function indexAction()
  // {
  //   // $banners_urls = $this->model->get_banners();
  //   $banners = 23;
  //   if (empty($_SESSION['user'])) {

  //   } else {
  //     $cart = $this->model->get_cart($_SESSION['user']);
  //   }
  //   $data = compact('cart');
  //   $this->view->render((object) $data);
  // }

}