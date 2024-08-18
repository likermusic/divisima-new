<?
namespace app\models;

use app\core\Model;

class Cart extends Model
{
  public function get_cart($login)
  {
    $user = $this->db->fetchOne($login, 'users', 'login');

    return $this->db->custom_query("SELECT p.id, p.name, p.image, p.price, c.qty
        FROM carts c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = {$user->id}");
  }

}