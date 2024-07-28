<?
namespace app\controllers;

use app\core\Controller;

class SignupController extends Controller
{
  public function indexAction()
  {
    if (isset($_POST['login']) and isset($_POST['password'])) {
      $is_valid_login = $this->validate_form($_POST['login'], "/^[a-zA-Z][a-zA-Z0-9-_.]{4,20}$/");
      $is_valid_password = $this->validate_form($_POST['password'], "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/");

      if ($is_valid_login and $is_valid_password) {
        $is_user = $this->model->check_is_user($_POST['login']);
        if ($is_user->error) {
          $this->print_error("Произошла ошибка. Попробуйте позже", $is_user->error_msg);
        } elseif (empty($is_user)) {
          $res = $this->model->add_user($_POST['login'], $_POST['password']);
          if ($res->error) {
            $this->print_error("Не удалось зарегистрироваться. Попробуйте позже", $res->error_msg);
          } else {
            debug($res);
            // Редирект пользователя на ту страницу с которой он пришел
            $_SESSION['user'] = $_POST['login'];
            // header("location: /");
          }
        } else {
          // вернуть попап что юезр уже существует
          $signup_fail = "Ошибка! Пользователь с логином {$_POST['login']} уже существует";
        }
      }
    }

    // debug($signup_fail);
    $data = compact('signup_fail');
    $this->view->layout = 'account';
    $this->view->render((object) $data);
  }

  private function validate_form($value, $regex)
  {
    return preg_match($regex, $value);
  }



}