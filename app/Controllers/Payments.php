<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\CustomersModel;
use App\Models\ImportCustomersModel;
use App\Models\BillersModel;
use App\Models\WaterAndElectricityModel;
use App\Models\GenerateStatementModel;
use App\Models\MonthlyUtilityStatementsModel;
use App\Models\AllUsersModel;
use App\Models\PaymentsModel;
use vendor_api;

require APPPATH.'ThirdParty/vendor_api/autoload.php';

class Payments extends BaseController
{   
    // add function unique id++++++++++++++++++++++++++++++>
    public function generate_uuid() 
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );
    }
    // end add function unique id++++++++++++++++++++++++++++++> 

    // payments section=========================>
    public function payments()
    {
        $session = session();
        $sessionLoginId = $session->get('id');
        // if sessions exists then only open this page otherwise redirect to login page
        if(isset($sessionLoginId))
        {
            // get customer data from the customers table------------->
            $customer_model = new CustomersModel();
            $customer_model_data = $customer_model->findAll();

            // fetch data in the select user dropdown
            $data['customer_model_data'] = $customer_model_data;
            // get customer data from the customers table------------->

            // get all months array in the helper====>
            $allMonthsArray = all_months();
            foreach ($allMonthsArray as $months => $months_value) 
            {
                $allMonths[] = array(
                                        'month_numeric' => (int)$months,
                                        'month_name'    => $months_value,
                                    );
            }
            // fetch data------->
            $data['allMonths'] = $allMonths;
            // end fetch data----->

            // end get all months array in the helper====>

            // get the years using for loop==================>
            for($year=2022; $year<=2050; $year++)
            {
               $year_array[] = $year; 
            }

            // fetch data in the dropdown=====>
            $data['year_array'] = $year_array;
            //end fetch data in the dropdown=====>

            //end get the years using for loop==================>

            // fetch data in the payment history table ++++++++++++++++++++++++>
            $payment_model = new PaymentsModel();
            $combine_payment_data = $payment_model->select('*')->findAll();
            $data['combine_payment_data'] = $combine_payment_data;

            // echo '<pre>';
            // print_r($combine_payment_data);
            // echo '</pre>';
            // die();

            // end fetch data in the payment history table +++++++++++++++++++++++>

            $data['content']  = 'Payments/payments';
            return view('template_with_header/template' , $data);
        }
        else
        {
            $path  = site_url();
            return redirect()->to($path); 
        }
    }
    //end payments section=========================>

    
    // payment detail section==========>
    public function get_payment_details()
    {
        if ($this->request->isAJAX())
        {
            $select_cus_name  =  $_REQUEST['get_cus_val'];
            $select_month     =  $_REQUEST['get_month_val'];
            $select_years     =  $_REQUEST['get_year_val'];
            
            // get (data)->total amount,from the w/e table+++++++++++++++++++++> 
            $this->db = \Config\Database::connect();

            $sql = "SELECT * FROM `water_and_electricity_calculation` WHERE `account_number` = '".$select_cus_name."' AND `statement_start_date` LIKE '%".$select_years."%' AND `month_name_numeric` = '".$select_month."'";

            $query = $this->db->query($sql);
            $water_electricity_Alldata = $query->getResultArray();

            $total_amount = $water_electricity_Alldata[0]['total_amount_due'];
            $payment_id =   $water_electricity_Alldata[0]['payment_id'];
            //end get (data)->total amount from the w/e table+++++++++++++++++++++>

           // get data from the customer table++++++++++++++++++++++++++++=>
            $cus_data = "SELECT * FROM `customers` WHERE account_number = '".$select_cus_name."'";
            $query = $this->db->query($cus_data);
            $customer_Alldata = $query->getResultArray();

            $account_number = $customer_Alldata[0]['account_number'];
            $tenant_name    = $customer_Alldata[0]['resident_name'];
           // end get data from the customer table++++++++++++++++++++++++++++=>

            // get data from the generate statement table+++++++++++++++++++>
            $gen_data = "SELECT * FROM `generate_statement_datatable` WHERE account_number = '".$select_cus_name."'";
            $query = $this->db->query($gen_data);
            $gen_all_data = $query->getResultArray();

            $bill_number = $gen_all_data[0]['bill_number'];
           // end get data from the generate statement table+++++++++++++++++++>

            // combine array++++++++++++++++++++++>
            $combine_payment_data = [  
                                       $account_number = $customer_Alldata[0]['account_number'],
                                       $tenant_name    = $customer_Alldata[0]['resident_name'],
                                       $total_amount   = $water_electricity_Alldata[0]['total_amount_due'],
                                       $select_month   = $_REQUEST['get_month_val'],
                                       $select_years   = $_REQUEST['get_year_val'],
                                       $bill_number    = $gen_all_data[0]['bill_number'],
                                       $payment_id     = $water_electricity_Alldata[0]['payment_id'],
                                   ];
            echo json_encode($combine_payment_data);

            // echo '<pre>';
            // print_r($combine_payment_data);
            // echo '<pre>';


         // end combine array++++++++++++++++++++++>
        }
    }
     // payment detail section==========>

    // insert payment details==============================>
    public function insert_payment_data()
    {
        if ($this->request->isAJAX())
        {
            $select_cus_name  =  $_REQUEST['get_cus_val'];
            $select_month     =  $_REQUEST['get_month_val'];
            $select_years     =  $_REQUEST['get_year_val'];
            $select_date      =  $_REQUEST['get_date_billed_val'];
            $newDate          =  date("Y-m-d", strtotime($select_date));  

            // get (data)->total amount,from the w/e table+++++++++++++++++++++> 
            $this->db = \Config\Database::connect();

            $sql = "SELECT * FROM `water_and_electricity_calculation` WHERE `account_number` = '".$select_cus_name."' AND `statement_start_date` LIKE '%".$select_years."%' AND `month_name_numeric` = '".$select_month."'";

            $query = $this->db->query($sql);
            $water_electricity_Alldata = $query->getResultArray();


            $total_amount = $water_electricity_Alldata[0]['total_amount_due'];

            //end get (data)->total amount from the w/e table+++++++++++++++++++++>

           // get data from the customer table++++++++++++++++++++++++++++=>
            $cus_data = "SELECT * FROM `customers` WHERE account_number = '".$select_cus_name."'";
            $query = $this->db->query($cus_data);
            $customer_Alldata = $query->getResultArray();

            $account_number = $customer_Alldata[0]['account_number'];
            $tenant_name    = $customer_Alldata[0]['resident_name'];

            $customer_Alldata_login_id = $customer_Alldata[0]['id'];
           // end get data from the customer table++++++++++++++++++++++++++++=>

            // get data from the generate statement table+++++++++++++++++++>
            $gen_data = "SELECT * FROM `generate_statement_datatable` WHERE account_number = '".$select_cus_name."'";
            $query = $this->db->query($gen_data);
            $gen_all_data = $query->getResultArray();

            $bill_number = $gen_all_data[0]['bill_number'];
           // end get data from the generate statement table+++++++++++++++++++>

            //insert data in the payment table ++++++++++++++++++++++>

            $payment_model = new PaymentsModel();
            $combine_payment_data = [  
                                       'account_number' => $customer_Alldata[0]['account_number'],
                                       'tenant_name'    => $customer_Alldata[0]['resident_name'],
                                       'total_amount'   => $water_electricity_Alldata[0]['total_amount_due'],
                                       'select_month'   => $_REQUEST['get_month_val'],
                                       'select_year'    => $_REQUEST['get_year_val'],
                                       'bill_number'    => $gen_all_data[0]['bill_number'],
                                       'date_billed'    => $newDate,
                                    ];
            //echo json_encode($combine_payment_data);
            $payment_model->insert($combine_payment_data);

            // end insert payment table+++++++++++++++++++++++++>

            // remove comma from the total amt------->
            $var = floatval(preg_replace('/[^\d.]/', '', $combine_payment_data['total_amount']));
            // remove decimal to the total amt---->
            $total_amount = str_replace('.', '', $var); 

            
            //combine_all_data store in the data base======================>
            $combine_payment_Alldata = [ 
                                            'account_number' =>  $customer_Alldata[0]['account_number'],
                                            'tenant_name'    =>  $customer_Alldata[0]['resident_name'],
                                            'total_amount'   =>  $total_amount,
                                            'select_month'   =>  $_REQUEST['get_month_val'],
                                            'select_year'    =>  $_REQUEST['get_year_val'],
                                            'bill_number'    =>  $gen_all_data[0]['bill_number'],
                                            'date_billed'    =>  $newDate,
                                       ];

            // end combine_all_data store in the data base======================>

             // set to session

            //serialize  ++++++++++++++++++====>
            $combine_payment_Alldata_searlize_array = serialize($combine_payment_Alldata);

            // end serialization
            
            // // set serialization data in the session+++++++++++++++=>
            $_SESSION['combine_payment_Alldata'] = $combine_payment_Alldata;
            //end set serialization data in the session+++++++++++++++=>

            echo 'success';
        
        }
    }
    // end insert payment details==============================>

    // edit payments status=================================>
    public function edit_payments_status()
    {   
        $uri = service('uri');
        $urlId = $uri->getSegment(2); 
        $decryprtedID = encrypt_decrypt($urlId, 'decrypt');

        $payment_model = new PaymentsModel();
        $payment_model_data = $payment_model->findAll();
        $result_data = $payment_model->where('id',$decryprtedID)->first();
        $data['result_data'] = $result_data;

        if(isset($_POST['update']))
        {   
            if($this->request->getVar('status') != '')
            {

                $payment_model = new PaymentsModel();
                $data = [
                            'status'  => $this->request->getVar('status'),
                        ];

                $update_cus_data = $payment_model->update($decryprtedID, $data);

                // session start--->
                $session = session();

                // update message ehen we update the data--->
                $session->setFlashdata('success', 'success');

                // encrypt the id 
                $encryprtIDValue = encrypt_decrypt($decryprtedID, 'encrypt');
                $paths  = base_url().'/edit-payments-status/'.$encryprtIDValue;
                return redirect()->to($paths); 
            }
            else
            {
                $session = session();
                $session->setFlashdata('error', 'error');
            }
        }
       

        $data['encryptID'] = $urlId ;

        $data['content']  = 'Payments/edit_payments_status';
        return view('template_with_header/template' , $data);
    }
   // end sec edit payments status=========================>

    // card-details section==============================>
    public function card_details()
    {   

        $session = session();
        $sessionLoginId = $session->get('id');
        // if sessions exists then only open this page otherwise redirect to login page
        if(isset($sessionLoginId))
        {  
            $data['content']  = 'Payments/card_details';
            return view('template_with_header/template' , $data);
        }
        else
        {
            $path  = site_url();
            return redirect()->to($path); 
        }
    }
     // end card-details section==============================>


    //create payment by card/+++++++++++++++++++++++++++++++++++++++++++>
    public function create_payment()
    {   
        if ($this->request->isAJAX())
        {   
            $token = $_REQUEST['token'];

            // get data from the session++++++++===>
             $session_data =  $_SESSION['combine_payment_Alldata'];
            // end+++++++++++++++++++++++++++++++++++++>

            // create payment card using API+++++++++++++++++++++++++++++++++++++++++++>
            $uniqueId = $this->generate_uuid(); 
  
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://connect.squareupsandbox.com/v2/payments');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);

            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"amount_money\": {\n      \"amount\": ".$session_data['total_amount'].",\n      \"currency\": \"USD\"\n    },\n    \"idempotency_key\": \"".$uniqueId."\",\n    \"source_id\": \"".$token."\",\n    \"accept_partial_authorization\": false,\n    \"autocomplete\": true,\n    \"customer_id\": \"".$session_data['customer_id']."\",\n    \"location_id\": \"LKNYD0HWCBEZV\",\n    \"reference_id\": \"11\"\n  }");

            $headers = array();
            $headers[] = 'Square-Version: 2022-02-16';
            $headers[] = 'Authorization: Bearer ';
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) 
            {
                 echo 'Error:' . curl_error($ch);
            }

            // echo '<pre>';
            // print_r($result);
            // echo '</pre>';

            curl_close($ch);
        }
    }
     //end create payment by card using API+++++++++++++++++++++++++++++++++++++++++++>


    // paymebt process++++++++++++++++++++++++++++++++++++++++++>
    public function payment_process()
    {
        $access_token = '';
        # setup authorization
        \SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);
        # create an instance of the Transaction API class
        $transactions_api = new \SquareConnect\Api\TransactionsApi();
        $location_id = '';
        $nonce = $_POST['nonce'];

        $request_body = array 
        (
            "card_nonce" => $nonce,
            # Monetary amounts are specified in the smallest unit of the applicable currency.
            # This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
            "amount_money" => array 
            (
                // "amount"   => (int) $_POST['amount'],
                "amount"   => (int) $_POST['amount'],
                "currency" => "USD"
            ),
            # Every payment you process with the SDK must have a unique idempotency key.
            # If you're unsure whether a particular payment succeeded, you can reattempt
            # it with the same idempotency key without worrying about double charging
            # the buyer.
            "idempotency_key" => uniqid()
        );

        try 
        {
            $result = $transactions_api->charge($location_id,  $request_body);

            // echo '<pre>';
            // print_r($result);
            // echo '</pre>';
            // die();
            
            
            // echo '';
            if($result['transaction']['id'])
            {
                // update customer table 

                // get data from the session++++++++===>
                $session_data =  $_SESSION['combine_payment_Alldata'];
                // end+++++++++++++++++++++++++++++++++++++>

                // echo '<pre>';
                // print_r($session_data);
                // echo '</pre>';
                // die();


                // insert payment_id+++++++++++++++=>

                $water_electricity_model = new WaterAndElectricityModel();

                $array_payment_id = [ 
                                       'payment_id' => $result['transaction']['id'],
                                    ];
                // end insert payment_id+++++++++++++++=>

                // check account number, month, year in the session then update+++++++>
                $water_electricity_model = new WaterAndElectricityModel();
                $water_electricity_array = array(
                                                   'account_number'       => $session_data['account_number'],
                                                   'month_name_numeric'   => $session_data['select_month'],
                                                );

                $water_electricity_model = new WaterAndElectricityModel();
                $check_year = [
                                'statement_start_date' => $session_data['select_year'],
                              ];

                 $water_electricity_model->set($array_payment_id);
                 $getinfo = $water_electricity_model->where($water_electricity_array);
                 $getinfo = $water_electricity_model->like($check_year);
                 $getinfo = $getinfo->first();



                if($getinfo['payment_id'] == '')
                {
                    $water_electricity_model->set($array_payment_id);
                    $water_electricity_model->where($water_electricity_array);
                    $water_electricity_model->like($check_year);
                    $result = $water_electricity_model->update();

                    // update payment id in the payments table+++++++++++++++>
                     $payment_model = new PaymentsModel();
                     $payment_model_array = array(
                                                   'account_number'  => $session_data['account_number'],
                                                   'select_month'    => $session_data['select_month'],
                                                   'select_year'     => $session_data['select_year'],
                                                  );

                    $payment_model->set($array_payment_id);
                    $getinfo = $payment_model->where($payment_model_array);
                    $getinfo = $getinfo->first();

                    if($getinfo['payment_id'] == '')
                    {   
                        $payment_model->set($array_payment_id);
                        $getinfo = $payment_model->where($payment_model_array);
                        $result = $payment_model->update();
                    }
                   // end update payment id in the payments table+++++++++++++++>



                    // set payment id in the  in the sucess page ++++++++>
                    $data['payment_message'] = $array_payment_id;
                   //end set payment id in the  in the sucess page ++++++++>

                    $data['session_data'] = $session_data;

                    unset($_SESSION['combine_payment_Alldata']);



                    // redirect to the success page++++++++++++++++>
                    $data['content']  = 'Payments/payment_success';
                    return view('template_with_header/template' , $data);
                 }
                 else
                 {
                    // redirect to the success page++++++++++++++++>
                    $data['content']  = 'Payments/payment_success';
                    return view('template_with_header/template' , $data);
                 }
            }
        } 
        catch (\SquareConnect\ApiException $e) 
        {
            echo "Exception when calling TransactionApi->charge:";
            var_dump($e->getResponseBody());
        }
    }
    // end paymebt process sec++++++++++++++++++++++++++++++++++++++++++>

    // payment-success page++++++++++++++++++++++++++++=>
    public function payment_success()
    {
        $session = session();
        $sessionLoginId = $session->get('id');
        // if sessions exists then only open this page otherwise redirect to login page
        if(isset($sessionLoginId))
        {  
            $data['content']  = 'Payments/payment_success';
            return view('template_with_header/template' , $data);
        }
        else
        {
            $path  = site_url();
            return redirect()->to($path); 
        }
    }
    // end payment-success page++++++++++++++++++++++++++++=>
}
// end basecontroller brakets+++++++++++++++>




