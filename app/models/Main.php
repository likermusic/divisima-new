<?
namespace app\models;

use app\core\Model;

class Main extends Model
{
  public function get_banners()
  {
    return $this->db->custom_query("SELECT * FROM assets WHERE type_id=1");
  }
}