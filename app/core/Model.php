<?
namespace app\core;

abstract class Model
{
  protected $db;
  public function __construct()
  {
    $this->db = new DB();
    debug($this->db);
  }
}