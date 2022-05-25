<?php 

namespace App\Models;

use CodeIgniter\Model;

class ImportCustomersModel extends Model
{
    protected $table = 'import_customer';

    protected $allowedFields = [
                                   'id',
                                   'file_name',
                                   'date'

    	                       ];
 }

?>