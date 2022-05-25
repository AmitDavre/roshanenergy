<?php 

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model

{
  // combile biller and user table check login type
  protected $table = 'billers';

  protected $allowedFields = [
                                'id',

                                'login_type',

                                'first_name',

                                'lastname',

                                'username',

                                'password'

                            ];

// get datafrom database=====>

  public function getUsers($data)
  {
    return $this->where($data)->first();
  }
 
// get datafrom database=====>
}
?>