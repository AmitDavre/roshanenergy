<?php 

namespace App\Models;
use CodeIgniter\Model;

class SettingsModel extends Model

{
  protected $table = 'settings';

  protected $allowedFields = [
                                'id',

                                'bill_number'

                              ];
}

?>