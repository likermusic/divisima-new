<?
namespace app\controllers;

use app\core\Controller;

class SignupController extends Controller
{
  public function indexAction()
  {
    $search = '123';
    // $searched = $this->model->search_products($search);
    $data = compact('search');
    $this->view->layout = 'account';
    $this->view->render((object) $data);
  }


}