<?php 

namespace App\Models;
use CodeIgniter\Model;

class PaymentsModel extends Model

{
  protected $table = 'payments';

  protected $allowedFields = [
                                'id',

                                'account_number',

                                'tenant_name',

                                'date_billed',

                                'bill_number',

                                'total_amount',

                                'select_month',

                                'select_year',

                                'status',

                                'payment_id',

                                'location_id',

                                'order_id',

                                'card_name',

                                'card_number',

                                'expired_date',

                                'card_cvv',

                                'customer_id'
                              ];
}

?>