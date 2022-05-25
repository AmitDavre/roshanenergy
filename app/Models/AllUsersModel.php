<?php 
namespace App\Models;

use CodeIgniter\Model;

class AllUsersModel extends Model
{
    protected $table = 'users';

    protected $allowedFields = [
                                    'id',
                                    'login_type',
                                    'first_name',
                                    'last_name',
                                    'username',
                                    'password',
                                    'login_id',
                                    'customer_id',
                                    'upload_img',
                                ];


// get datafrom database=====>

  public function getAllUsers($data)
  {
    return $this->where($data)->first();
  }
 
// get datafrom database=====>
}
?>
