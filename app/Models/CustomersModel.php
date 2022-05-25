<?php 
namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table = 'customers';

    protected $allowedFields = [
                                    'id',
                                    'account_number',
                                    'account_type',
                                    'first_name',
                                    'last_name',
                                    'unit',
                                    'street_address',
                                    'city',
                                    'zip_code',
                                    'country',
                                    'email',
                                    'phone',
                                    'water_rate_per_unit',
                                    'other_services_fee_or_credit',
                                    'sewer_rate_per_unit',
                                    'water_meter_end_point_sn',
                                    'water_service_fee',
                                    'state_discount_in',
                                    'trash_and_recycling_fee',
                                    'electric_rate_off_peak_per_kwh',
                                    'state_discount_in_electricity',
                                    'electric_rate_on_peak_per_kwh',
                                    'other_service_fee_or_credits_electricity',
                                    'state_sucharge_tax',
                                    'electric_meter_end_point_sn',
                                    'state_regulatory_fee',
                                    'sensors',
                                    'electric_service_establishment_charge',
                                    'state',
                                    'resident_name',
                                    'resident_email',
                                    'this_period_due_amount',
                                    'past_due_amount',
                                    'water_reading_unit',
                                    'unit_number',
                                    'unit_id',
                                    'landlord_or_company_name',
                                    'password',
                                    'login_type'
                                   ];

}
?>


