<?php 

namespace App\Models;
use CodeIgniter\Model;

class MonthlyUtilityStatementsModel extends Model

{
  protected $table = 'monthly_utility_statements';

  protected $allowedFields = [
                                'id',

                                'month_name_numeric',

                                'excel_file_link',

                                'select_month',

                                'select_year',

                                'current_date',

                                'all_cus_total_amount',

                                'total_number_of_customer'

                              ];
}

?>