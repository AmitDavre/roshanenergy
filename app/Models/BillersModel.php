<?php 
namespace App\Models;

use CodeIgniter\Model;

class BillersModel extends Model
{
    protected $table = 'billers';

    protected $allowedFields = [
                                    'id',
                                    'first_name',
                                    'middle_name',
                                    'last_name',
                                    'username',
                                    'password',
                                    'phone_number',
                                    'address',
                                    'date_of_birth',
                                    'gender',
                                    'login_type'
                                ];

}
?>