<?
namespace app\controllers;

use app\core\Controller;

class SigninController extends Controller
{
  public function indexAction()
  {
    if (isset($_POST['login']) and isset($_POST['password'])) {
      $is_valid_login = $this->validate_form($_POST['login'], "/^[a-zA-Z][a-zA-Z0-9-_.]{4,20}$/");
      $is_valid_password = $this->validate_form($_POST['password'], "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/");

      if ($is_valid_login and $is_valid_password) {
        $is_user = $this->model->check_is_user($_POST['login']); // null, {user=>max}

        if ($is_user->error) {
          $this->print_error("Произошла ошибка. Попробуйте позже", $is_user->error_msg);
        } elseif (empty($is_user)) {
          $signin_fail = "Пользователь с логином {$_POST['login']} не найден";
        } else {
          $is_password_valid = $this->model->check_user_password($is_user->id, $_POST['password']);
          if ($is_password_valid) {
            $_SESSION['user'] = $_POST['login'];
            // Редирект пользователя на ту страницу с которой он пришел
            header("location: /");
          } else {
            $signin_fail = "Пароль неверный";
          }

        }
      }
    }

    // debug($signup_fail);
    $data = compact('signin_fail');
    $this->view->layout = 'account';
    $this->view->render((object) $data);
  }

  private function validate_form($value, $regex)
  {
    return preg_match($regex, $value);
  }



}