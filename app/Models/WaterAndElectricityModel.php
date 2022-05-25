<?php 
namespace App\Models;

use CodeIgniter\Model;

class WaterAndElectricityModel extends Model
{
    protected $table = 'water_and_electricity_calculation';

    protected $allowedFields = [
                                    'id',
                                    'account_number',
                                    'this_period_off_peak_kwh_reading',
                                    'this_period_on_peak_kwh_reading',
                                    'this_period_kgall_reading',
                                    'total_amount_due',
                                    'statement_start_date',
                                    'statement_end_date',
                                    'month_name_numeric',
                                    'past_due_amount',
                                    'payment_id',
                               ];

    public function getCustomerMonthlyData($data)
    {

        return $this->where($data)->findAll();
    }

}
?>


