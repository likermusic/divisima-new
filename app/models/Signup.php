<?
namespace app\models;

use app\core\Model;

class Signup extends Model
{
  private $table = 'users';
  public function check_is_user($login)
  {
    return $this->db->fetchOne($login, $this->table, 'login');
  }

  public function add_user($login, $password)
  {
    return $this->db->custom_query("INSERT INTO {$this->table} (login, password) VALUES (?,?)", [$login, $password]);
  }
  // public function search_products($search)
  // {
  //   $search = "%" . $search . "%";
  //   return $this->db->custom_query("SELECT * FROM products WHERE name LIKE ?", [$search]);
  // }
}