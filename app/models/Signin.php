<?
namespace app\models;

use app\core\Model;

class Signin extends Model
{
  private $table = 'users';
  public function check_is_user($login)
  {
    return $this->db->fetchOne($login, $this->table, 'login');
  }

  public function check_user_password($id, $password)
  {
    //login password
    // asd7J asd7J
    //jkjk6Kl jkjk6Kl
    $password_hash = $this->db->custom_query("SELECT password FROM {$this->table} WHERE id={$id}");
    if ($password_hash[0]->password) {
      return password_verify($password, $password_hash[0]->password);
    } else {
      return false;
    }
  }

}