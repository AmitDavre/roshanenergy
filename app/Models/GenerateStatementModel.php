<?php 
namespace App\Models;

use CodeIgniter\Model;

class GenerateStatementModel extends Model
{
    protected $table = 'generate_statement_datatable';

    protected $allowedFields = [
                                    'id',
                                    'account_number',
                                    'current_date_statement',
                                    'total_amount_due',
                                    'statement_pdf_download',
                                    'statement_start_date',
                                    'statement_end_date',
                                    'month_name_numeric',
                                    'resident_name',
                                    'unit',
                                    'street_address',
                                    'city',
                                    'zip_code',
                                    'landlord_name',
                                    'bill_number'
                               ];

}


?>