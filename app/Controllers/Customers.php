<?php
namespace App\Libraries;
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AllUsersModel;
use App\Models\CustomersModel;
use App\Models\ImportCustomersModel;
use App\Models\BillersModel;
use App\Models\WaterAndElectricityModel;
use App\Models\GenerateStatementModel;
use CodeIgniter\Controller;
use TCPDF;

class Customers extends BaseController
{
   public function customer_statements()
   { 
      $session = session();
      $sessionIdd = $session->get('id');
      $sessionLogin_id = $session->get('login_id');
      // if sessions exists then only open this page otherwise redirect to login page 
      if(isset($sessionIdd))
      { 
         // if login-type is customer then show only one customer record=====>
         if(session()->get('login_type') == "customer")
         { 
            $model = new CustomersModel();

            $customer_data = $model->where('id' , $sessionLogin_id);
            $customer_data1 = $model->first();
            $customerAccountNO =  $customer_data1['account_number'];

            
            $model_gen_statement = new GenerateStatementModel();

            // get account number from customer id=====>
            $statement_record_cus = $model_gen_statement->where('account_number', $customerAccountNO);
            $statement_record_cus1 = $model_gen_statement->findAll();

            // fetch data in to the table========>
            $data['statement_record_cus'] = $statement_record_cus1;
            
            // view customer-satement page=======>
            $data['content']  = 'Customers/customer_statements';
            return view('template_with_header/template' , $data);
         }
         //if login-type is admin and biller then show all customer record=====>
         else if(session()->get('login_type') == "admin" || session()->get('login_type') == "biller")
         {
            $model_gen_statement = new GenerateStatementModel();
            $statement_record_cus1 = $model_gen_statement->findAll();

            $data['statement_record_cus'] = $statement_record_cus1;
            
            $data['content']  = 'Customers/customer_statements';
            return view('template_with_header/template' , $data);
         }
      }
      else
      {
         $path  = site_url();
         return redirect()->to($path); 
      }
   }

}
