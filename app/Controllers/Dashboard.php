<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\CustomersModel;
use App\Models\ImportCustomersModel;
use App\Models\BillersModel;
use App\Models\WaterAndElectricityModel;
use App\Models\AllUsersModel;
use App\Models\GenerateStatementModel;
use App\Models\MonthlyUtilityStatementsModel;
use CodeIgniter\Controller;


class Dashboard extends BaseController
{

public function account_control()
{
  $session = session();
  $sessionLoginId = $session->get('id');

  // end test graph=====>
  // echo '<pre>';
  // print_r($_SESSION);
  // echo '</pre>';
  // die();

  // if sessions exists then only open this page otherwise redirect to login page

  if(isset($sessionLoginId))
  {

     $data['content']  = 'Dashboard/account_control';
     return view('template/template' , $data);
  }
  else
  {
    $path  = site_url();
    return redirect()->to($path); 
  }
}
//end account-lookup section------>

// create customer-------->
public function create_customer()
{
  $session = session();
  $sessionId = $session->get('id');

  // if sessions exists then only open this page otherwise redirect to login page 

  if(isset($sessionId))
  {

    $data['content'] = 'Dashboard/create_customer';
    return view('template_with_header/template', $data);
  }
  else
  {
    $path  = site_url();
    return redirect()->to($path); 
  }
}

// insert customer data in database--->
public function insert()
{
  $data = [];
  helper(['form']);
  $validation = \Config\Services::validation();
  $rules = [
            "account_number"           => [            
                                            "label" => "Account Number", 
                                            "rules" => "required|numeric|max_length[255]"
                                          ],

            "landlord_or_company_name" => [            
                                            "label" => "Landlord Name", 
                                            "rules" => "required|max_length[255]"
                                          ],

            "fname"                    => [            
                                            "label" => "First Name", 
                                            "rules" => "required|max_length[255]"
                                          ],

            "lname"                    => [            
                                            "label" => "Last Name", 
                                            "rules" => "required|max_length[255]"
                                          ],

            "unit"                     => [            
                                            "label" => "Unit", 
                                            "rules" => "required"
                                          ],

            "street_address"           => [            
                                            "label" => "Street Address", 
                                            "rules" => "required|max_length[255]"
                                          ],

            "city"                     => [            
                                            "label" => "City", 
                                            "rules" => "required|max_length[255]"
                                         ],

            "zip_code"                 => [            
                                            "label" => "Zip Code", 
                                            "rules" => "required|numeric"
                                          ],

            "country"                  => [            
                                              "label" => "Country", 
                                              "rules" => "required|max_length[255]"
                                           ],

            "email"                    => [            
                                              "label" => "Email", 
                                              "rules" => "required"
                                          ],

            "phone"                    => [            
                                              "label" => "Phone", 
                                              "rules" => "required|numeric"
                                           ],

            "password"                 => [
                                             "label" => "Password",
                                             "rules" => "required"
                                          ]
          ];


  // session start--->
  $session = session();
  if($this->validate($rules)) 
  {
    $model = new CustomersModel();
    $data = [
              'account_number'              =>  $this->request->getVar('account_number'),
              'landlord_or_company_name'    =>  $this->request->getVar('landlord_or_company_name'),
              'account_type'                =>  $this->request->getVar('Water').','.$this->request->getVar('Electricity'),
              'first_name'                  =>  $this->request->getVar('fname'),
              'last_name'                   =>  $this->request->getVar('lname'),
              'unit'                        =>  $this->request->getVar('unit'),
              'street_address'              =>  $this->request->getVar('street_address'),
              'city'                        =>  $this->request->getVar('city'),
              'zip_code'                    =>  $this->request->getVar('zip_code'),
              'country'                     =>  $this->request->getVar('country'),
              'email'                       =>  $this->request->getVar('email'),
              'phone'                       =>  $this->request->getVar('phone'),
              'login_type'                  =>  'customer',
              'password'                    =>  md5($this->request->getVar('password')),
              'resident_name'               =>  $this->request->getVar('fname'). ' '.$this->request->getVar('lname'),
              'resident_email'              =>  $this->request->getVar('email'),
              'unit_number'                 =>  $this->request->getVar('unit'),
              'login_type'                  =>  'customer'

            ];
    
    // before inserting the row check each account number already exists or not 
    // if yes then do not insert 
    // in no then insert the row 
    // get data from database to check 

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // die();

    $customer_data_test =  $model->where('account_number' , $this->request->getVar('account_number'));
    $customer_data1_test = $model->first();


    if(!isset($customer_data1_test))
    {
      $result = $model->insert($data);

      // get last insert customer id===============>

      $customer_id = $model->getInsertID();

  
      // end get last insert customer id===============>
      

      //insert data to the users table using customers model=======>
          $model_all_users = new AllUsersModel();

          $data_customers = [
                               'first_name'   =>  $this->request->getVar('fname'),
                               'last_name'    =>  $this->request->getVar('lname'),
                               'username'     =>  $this->request->getVar('email'),
                               'login_type'   =>  'customer',
                               'password'     =>  md5($this->request->getVar('password')),
                               'login_id'     =>  $customer_id
                            ];

          $model_all_users->insert($data_customers);

          // echo '<pre>';
          // print_r($data_customers);
          // echo '</pre>';
          // die();

      //end insert data to the users table using customers model=======>
       
      // success message when we insert the data--->
      $session->setFlashdata('success', 'success');
      $path  = base_url().'/create-customer';
      return redirect()->to($path); 
    }
    else
    {
      // error message when we insert the data--->
      $session->setFlashdata('error', 'error');
      $path  = base_url().'/create-customer';
      return redirect()->to($path); 
    }
  } 
  else 
  {
    // validation error message ====>
    $data["validation"] = $validation->getErrors();
    $data['content']  = 'Dashboard/create_customer';
    return view('template_with_header/template' , $data);
  }
  // return redirect()->route('create-customer');


}

// edit customer------>
public function edit_customer()
{
  $uri = service('uri');
  $urlId = $uri->getSegment(2); // encrypted
  $model = new CustomersModel();

  // validation when we update the customer
  $data = [];
  helper(['form']);
  $validation = \Config\Services::validation();
  $rules = [
              "account_number"            => [            
                                                "label" => "Account Number", 
                                                "rules" => "required|numeric|max_length[255]"
                                             ],

              "landlord_or_company_name" =>  [            
                                               "label" => "Landlord Name", 
                                               "rules" => "required|max_length[255]"
                                             ],

              "fname"                     =>  [            
                                                "label" => "First Name", 
                                                "rules" => "required|max_length[255]"
                                             ],

              "lname"                     => [            
                                                "label" => "Last Name", 
                                                "rules" => "required|max_length[255]"
                                             ],

              "unit"                      => [            
                                                "label" => "Unit", 
                                                "rules" => "required"
                                             ],

              "street_address"            => [            
                                                "label" => "Street Address", 
                                                "rules" => "required|max_length[255]"
                                             ],

              "city"                     =>  [            
                                                "label" => "City", 
                                                "rules" => "required|max_length[255]"
                                             ],

              "zip_code"                  => [            
                                                "label" => "Zip Code", 
                                                "rules" => "required|numeric"
                                             ],

              "country"                   => [            
                                                "label" => "Country", 
                                                "rules" => "required|max_length[255]"
                                             ],

              "email"                      => [            
                                                "label" => "Email", 
                                                "rules" => "required"
                                              ],

              "phone"                      => [            
                                                "label" => "Phone", 
                                                "rules" => "required|numeric"
                                              ]
            ];

  // if update 
  if(isset($_POST['update']))
  {  
    $customer_id = $this->request->getVar('id');
    $encryprtIDValue = encrypt_decrypt($customer_id, 'encrypt');

    // if wrong data 
    if($this->validate($rules))
    {
      // if correct data 
      $data = [
                'account_number'               =>  $this->request->getVar('account_number'),
                'landlord_or_company_name'     =>  $this->request->getVar('landlord_or_company_name'),
                'account_type'                 =>  $this->request->getVar('Water').','.$this->request->getVar('Electricity'),
                'first_name'                   =>  $this->request->getVar('fname'),
                'last_name'                    =>  $this->request->getVar('lname'),
                'unit'                         =>  $this->request->getVar('unit'),
                'street_address'               =>  $this->request->getVar('street_address'),
                'city'                         =>  $this->request->getVar('city'),
                'zip_code'                     =>  $this->request->getVar('zip_code'),
                'country'                      =>  $this->request->getVar('country'),
                'email'                        =>  $this->request->getVar('email'),
                'phone'                        =>  $this->request->getVar('phone'),
                'resident_name'                =>  $this->request->getVar('fname'). ' ' .$this->request->getVar('lname'),
                'resident_email'               =>  $this->request->getVar('email'),
                'unit_number'                  =>  $this->request->getVar('unit'),

              ];

      // session start--->
      $session = session();
      $update_customer = $model->update($customer_id, $data);
     

      // update cus data in the user table==========>

      $customer_idd = $this->request->getVar('id');

      $model_all_users_update = new AllUsersModel();
      $array = [
                  'first_name' =>  $this->request->getVar('fname'),
                  'last_name'  =>  $this->request->getVar('lname'),
                  'username'   =>  $this->request->getVar('email')
               ];
      $model_all_users_update->set($array);
      $model_all_users_update->where('login_id', $customer_idd);
      $model_all_users_update->update();

     // end update data cus in the user table==========>

       // after update get the data again from database 
      // update message ehen we insert the data--->
      $session->setFlashdata('success', 'success');

      // encrypt the id 
      $paths  = base_url().'/edit-customer/'.$encryprtIDValue;
      return redirect()->to($paths); 
    }
    else
    {
      $decryprtedID = encrypt_decrypt($urlId, 'decrypt');
      $data['row'] = $model->where('id',$decryprtedID)->first();
      $data['encryptID'] = $urlId ;
      $data["validation"] = $validation->getErrors();
      $data['content']  = 'Dashboard/edit_customer';
      return view('template_with_header/template' , $data);
    }
  }
  // end=====================================================>

      // decrypt the id first
      $decryprtedID = encrypt_decrypt($urlId, 'decrypt');
      $data['row'] = $model->where('id',$decryprtedID)->first();
      $data['encryptID'] = $urlId ;
      $data['content']  = 'Dashboard/edit_customer';
      return view('template_with_header/template' , $data);
}
// end create customer section==========>

// ====create biller=======>

public function create_biller()
{
  // if biller login then biller doesn't create billers in tab (yourself)=====>
  if (session()->get('login_type') == "biller") {
        return redirect()->to(base_url());
      }
  //end if biller login then biller doesn't create billers in tab (yourself)=====> 

  $session = session();
  $session_id = $session->get('id');
  // if sessions exists then only open this page otherwise redirect to login page 
  if(isset($session_id))
  {
      $data['content']  = 'Dashboard/create_biller';
      return view('template_with_header/template' , $data);
  }
  else
  {
    $path  = site_url();
    return redirect()->to($path); 
  }
}

// insert biller data in database----->

public function biller_insert()
{
  $data = [];
  helper(['form']);
  $validation = \Config\Services::validation();
  $rules = [
              "fname"    =>       [            
                                    "label" => "First Name", 
                                    "rules" => "required"
                                  ],

              "m_name"    =>      [            
                                    "label" => "Middle Name", 
                                    "rules" => "required"
                                  ],

              "lname"      =>     [            
                                    "label" => "Last Name", 
                                    "rules" => "required"
                                  ],

              "uname"      =>     [            
                                    "label" => "Username", 
                                    "rules" => "required"
                                  ],

              "psw"      =>       [            
                                    "label" => "Password", 
                                    "rules" => "required"
                                  ],

              "phone"     =>      [            
                                    "label" => "Phone Number", 
                                    "rules" => "required|numeric"
                                  ],

              "address"   =>      [            
                                    "label" => "Address", 
                                    "rules" => "required"
                                  ],

              "dob"        =>     [            
                                    "label" => "Date Of Birth", 
                                    "rules" => "required"
                                  ],

              "gender"     =>     [            
                                    "label" => "Gender", 
                                    "rules" => "required"
                                  ]
            ];
  // session start--->
  $session = session();
  if($this->validate($rules)) 
  {
    $model = new BillersModel();
    // format date to Y-m-d 
    $date_format = $this->request->getVar('dob');
    $newdate     = date("Y-m-d", strtotime($date_format));
    $data = [
              'first_name'         => $this->request->getVar('fname'),
              'middle_name'        => $this->request->getVar('m_name'),
              'last_name'          => $this->request->getVar('lname'),
              'username'           => $this->request->getVar('uname'),
              'password'           => md5($this->request->getVar('psw')),
              'phone_number'       => $this->request->getVar('phone'),
              'address'            => $this->request->getVar('address'),
              'date_of_birth'      => $newdate,
              'gender'             => $this->request->getVar('gender')
            ];



    $model->insert($data);
     // inser biller last id============>
     $biller_id = $model->getInsertID();

      //insert data to the users table using all user model=======>
          $model_all_users = new AllUsersModel();
  
          $data_billers = [
                             'login_type' =>  'biller',
                             'first_name' =>  $this->request->getVar('fname'),
                             'last_name'  =>  $this->request->getVar('lname'),
                             'username'   =>  $this->request->getVar('uname'),
                             'password'   =>  md5($this->request->getVar('psw')),
                             'login_id'   =>  $biller_id

                          ];
          $model_all_users->insert($data_billers);

          // echo '<pre>';
          // print_r($data_billers);
          // echo '</pre>';
          // die();
      //end insert data to the users table using all user model=======>

   

      //end insert data to the users table using customers model=======>

    // success message ehen we insert the data--->
    $session->setFlashdata('success', 'success');

    $path  = base_url().'/create-biller';
    return redirect()->to($path); 
  }

  else 
  {
    $data["validation"] = $validation->getErrors();
    $data['content']  = 'Dashboard/create_biller';
    return view('template_with_header/template' , $data);
  }
  // return redirect()->route('create-biller');
}
// ====end create biller section=======>

// manage customer/biller======>

public function manage_customer_biller()
{
  $session = session();
  $session_Id = $session->get('id');
  // if sessions exists then only open this page otherwise redirect to login page 
  if(isset($session_Id))
  {
      $data['content']  = 'Dashboard/manage_customer_biller';
      return view('template/template' , $data);
  }
  else
  {
      $path  = site_url();
      return redirect()->to($path); 
  }   
}
// end manage customer/biller======>

// manage customer section==========>

public function manage_customer()
{
  $session = session();
  $session_Idd = $session->get('id');
  
  // if sessions exists then only open this page otherwise redirect to login page 
  if(isset($session_Idd))
  {
    // fetch data from the database--->
    $model = new CustomersModel();
    $data['table'] = $model->findAll();
    $data['content']  = 'Dashboard/manage_customer';
    return view('template_with_header/template' , $data);
  }
  else
  {
    $path  = site_url();
    return redirect()->to($path); 
  }   
}
// end manage customer section========>

// manage billers===>

public function manage_biller()
{
   // if biller login then doesn't open manage biller tab  yourself===>
  if (session()->get('login_type') == "biller") 
  {
      return redirect()->to(base_url());
  }
  //end if biller login then doesn't open manage biller tab  yourself====> 

  $session = session();
  $session_Id = $session->get('id');
  
// if sessions exists then only open this page otherwise redirect to login page 
  if(isset($session_Id))
  {
    // fetch data from the database--->
    $model = new BillersModel();

    // check where login type eqlto billers then show biller data in the table--->
    $data['table'] = $model->where('login_type' , 'Biller');
    // end check where login type eqlto billers then show biller data in the table--->

    $data['table'] = $model->findAll();
    $data['content']  = 'Dashboard/manage_biller';
    return view('template_with_header/template' , $data);
   }
  else
  {
    $path  = site_url();
    return redirect()->to($path); 
  }   
}
//end  manage billers===>
 
//============= edit-biller===>

public function edit_biller()
{
  $uri = service('uri');
  $urlId = $uri->getSegment(2); // encrypted
  $model = new BillersModel();

  // when we update the biller show error message======>

  $data = [];
  helper(['form']);
  $validation = \Config\Services::validation();
  $ruless = [
              "fname"    =>       [            
                                    "label" => "First Name", 
                                    "rules" => "required"
                                  ],

              "m_name"    =>      [            
                                    "label" => "Middle Name", 
                                    "rules" => "required"
                                  ],

              "lname"      =>     [            
                                    "label" => "Last Name", 
                                    "rules" => "required"
                                  ],

              "uname"      =>     [            
                                    "label" => "Username", 
                                    "rules" => "required"
                                  ],


              "phone"     =>      [            
                                    "label" => "Phone Number", 
                                    "rules" => "required|numeric"
                                  ],

              "address"   =>      [            
                                    "label" => "Address", 
                                    "rules" => "required"
                                  ],

              "dob"        =>     [            
                                    "label" => "Date Of Birth", 
                                    "rules" => "required"
                                  ],

              
            ];

  // when we click on updata bnutton then edit the billers
  if(isset($_POST['update']))
  { 

    if($this->validate($ruless)) 
    {
      $model= new BillersModel();

      // format date to Y-m-d 
      $date_format = $this->request->getVar('dob');
      $newdate     = date("Y-m-d", strtotime($date_format));
      $biller_id   = $this->request->getVar('id');

      $data = [
                'first_name'         => $this->request->getVar('fname'),
                'middle_name'        => $this->request->getVar('m_name'),
                'last_name'          => $this->request->getVar('lname'),
                'username'           => $this->request->getVar('uname'),
                'password'           => md5($this->request->getVar('psw')),
                'phone_number'       => $this->request->getVar('phone'),
                'address'            => $this->request->getVar('address'),
                'date_of_birth'      => $newdate,
                'gender'             => $this->request->getVar('gender')
              ];

              // echo '<pre>';
              // print_r($data);
              // echo '</pre>';
              // die();

      // session start--->
      $session = session();
      $update_biller = $model->update($biller_id, $data);
     // after update get the data again from database

     // update biller data in the user table==========>

      $biller_idd = $this->request->getVar('id');

      $model_all_users_update = new AllUsersModel();
      $array = [
                  'first_name' =>  $this->request->getVar('fname'),
                  'last_name'  =>  $this->request->getVar('lname'),
                  'username'   =>  $this->request->getVar('uname')
               ];

      $model_all_users_update->set($array);
      $model_all_users_update->where('login_id', $biller_idd);
      $model_all_users_update->update();

     // end update data biller in the user table==========>


     // update message ehen we insert the data--->
      $session->setFlashdata('success', 'success');

     // encrypt the id 
      $encryprtIDValue = encrypt_decrypt($biller_id, 'encrypt');
      $paths  = base_url().'/edit-biller/'.$encryprtIDValue;
      return redirect()->to($paths); 
    }
    else
    {
      $decryprtedID = encrypt_decrypt($urlId, 'decrypt');
      $data['row'] = $model->where('id',$decryprtedID)->first();
      $data['encryptID'] = $urlId ;
      $data["validation"] = $validation->getErrors();
      $data['content']  = 'Dashboard/edit_biller';
      return view('template_with_header/template' , $data);
    }
  }
  // when we click on edit button icon then show edit-biller page==>
  // decrypt the id first
   $decryprtedID = encrypt_decrypt($urlId, 'decrypt');

   $data['row'] = $model->where('id',$decryprtedID)->first();

   $data['encryptID'] = $urlId ;

   
   $data['content']  = 'Dashboard/edit_biller';
   return view('template_with_header/template' , $data);
}


// delete customer======>

public function delete_customer()
{
  $this->db = \Config\Database::connect();

  if ($this->request->isAJAX())
  {
    $hiddenCustomerID = $this->request->getVar('hiddenCustomerID');
    // test for check error-->
    // $hiddenCustomerID = '55555';
    // end test--------------------->


      $sql = "SELECT * FROM customers WHERE id ='".$hiddenCustomerID."'";
      $query = $this->db->query($sql);
      $getCustomersData = $query->getResultArray();
      $customerAccountNumber = $getCustomersData[0]['account_number'];

      $model = new CustomersModel();
      $model->where('id', $hiddenCustomerID)->delete();

      // check condition
      $affected_rows = $model->db->affectedRows(); // this return
      if($affected_rows > 0)
      {
        // delete in statement table

        $model_gen_statement_table = new GenerateStatementModel();
        $model_gen_statement_table->where('account_number', $customerAccountNumber)->delete();


        $model_users = new AllUsersModel();
        $model_users->where('login_id', $hiddenCustomerID)->delete();


        $model_water = new WaterAndElectricityModel();
        $model_water->where('account_number', $customerAccountNumber)->delete();


        $model_mothlystate = new MonthlyUtilityStatementsModel();
        $model_mothlystate->where('account_number', $customerAccountNumber)->delete();

        echo 'success';

      }
      else
      {
        echo 'error';
      }
    }
  }
// end delete customer======>

// delete Biller ======>

public function delete_biller()
{
  if ($this->request->isAJAX())
  {
    $hiddenBillerID = $this->request->getVar('hiddenBillerID');
      // test for check error-->
     // $hiddenBillerID = '55555';
    // end test--------------------->

    $model = new BillersModel();
    $model->where('id', $hiddenBillerID)->delete();

    // check condition
    $affected_rows = $model->db->affectedRows(); // this return
    if($affected_rows > 0)
    {
      echo 'success';
    }
    else
    {
       echo 'error';
    }
  }
}
// end deleteBiller ======>

//update customer water-modal-field-==========>

public function update_water_meter()
{
  if ($this->request->isAJAX())
  {
      $model = new CustomersModel();
      $update_customer_id = $this->request->getVar('customer_id');
      $data = [
                'water_reading_unit'                        => $_REQUEST['water_reading_unit'],
                'water_rate_per_unit'                       => $_REQUEST['water_unit'],
                'other_services_fee_or_credit'              => $_REQUEST['other_service'],
                'sewer_rate_per_unit'                       => $_REQUEST['sewer_unit'],
                'water_meter_end_point_sn'                  => $_REQUEST['water_point'],
                'water_service_fee'                         => $_REQUEST['water_service'],
                'state_discount_in'                         => $_REQUEST['state_discount'],
                'trash_and_recycling_fee'                   => $_REQUEST['trash_fee'],
              ];

              // echo '<pre>';
              // print_r($data);
              // echo '</pre>';
              // die();

      // update the customers====>
      $model->update($update_customer_id, $data);

      // check condition
      $affected_rows = $model->db->affectedRows(); // this return

      if($affected_rows >= 0)
      {
          echo "success";
      }
      else
      {
        echo "error";
      }
  }
}
//end update customer water-modal-field-==========>

// update customer electricity model=========>

public function update_electric_meter()
{
  if ($this->request->isAJAX())
  {
    $model = new CustomersModel();
    $update_customer_id = $this->request->getVar('customer_id');
    $data = [
              'electric_rate_off_peak_per_kwh'             => $_REQUEST['electric_rate_off'],
              'state_discount_in_electricity'              => $_REQUEST['state_discount_electicity'],
              'electric_rate_on_peak_per_kwh'              => $_REQUEST['electric_rate_on'],
              'other_service_fee_or_credits_electricity'   => $_REQUEST['other_service_fee_electricity'],
              'state_sucharge_tax'                         => $_REQUEST['state_tax'],
              'electric_meter_end_point_sn'                => $_REQUEST['electric_meter_sn'],
              'state_regulatory_fee'                       => $_REQUEST['state_reg_fee'],
              'sensors'                                    => $_REQUEST['sensors'],
              'electric_service_establishment_charge'      => $_REQUEST['electric_service_charge'],
            ];

              // echo '<pre>';
              // print_r($data);
              // echo '</pre>';
              // die();

    // update the customers====>
    $model->update($update_customer_id, $data);
    // check condition
    $affected_rows = $model->db->affectedRows(); // this return
    if($affected_rows >= 0)
    {
      echo "success";
    }
    else
    {
      echo "error";
    }
  }
}
// end update customer electricity model=========>

// import customer======================================>
public function import_customer()
{
  // fetch data from the database--->
  $model = new ImportCustomersModel();
  $data['table'] = $model->findAll();

  $data['content']  = 'Dashboard/import_customer';
  return view('template_with_header/template', $data);
}

// import csv file for customer==========>

public function importCsvToDb()
{
  $dataArray = array();
  if(isset($dataArray))
  {
    $session = session();
    if($_FILES['file2']['tmp_name']!= '')
    {
      $fileName = $_FILES["file2"]["tmp_name"];
      $file = fopen($fileName, "r");
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE)
      {
        $dataArray[] = $column;
      }
      // remvoe the zeroth key 
      unset($dataArray[0]);

      // data get from water and electricity calculation======>

      // csv file data insert in the database (electric and water calculation table)===>
      // before inserting the row check each account number already exists or not 
      // if yes then do not insert 
      // in no then insert the row 
      // get data from database to check
      foreach ($dataArray as $key => $value1)
      {
        // convert date y-m-d format=====>
        $start_date1 = date("Y-m-d", strtotime($value1['33']));
        $end_date1 = date("Y-m-d", strtotime($value1['34']));
       
        $model3 = new WaterAndElectricityModel();
        $data1 = [
                      'account_number'                       => $value1['0'],
                      'this_period_off_peak_kwh_reading'     => $value1['22'],
                      'this_period_on_peak_kwh_reading'      => $value1['23'],
                      'this_period_kgall_reading'            => $value1['32'],
                      'statement_start_date'                 => $start_date1,
                      'statement_end_date'                   => $end_date1,
                      'month_name_numeric'                   => $value1['35']
                  ];
        $customer_data2 = $model3->where('account_number' , $value1['0']);
        $customer_data2 = $model3->first();
           
        if(!isset($customer_data2))
        {
           $result_water_and_electricity = $model3->insert($data1);
        }       
      } 
    
      // data get from water and electricity calculation======>

      foreach ($dataArray as $key => $value) 
      {
        // insert data in the customer table
        $model = new CustomersModel();
        $data23 = [
                      'account_number'                              => $value['0'],
                      'account_type'                                => $value['1'],
                      'street_address'                              => $value['2'],
                      'unit'                                        => $value['3'],
                      'unit_id'                                     => $value['4'],
                      'city'                                        => $value['5'],
                      'state'                                       => $value['6'],
                      'zip_code'                                    => $value['7'],
                      'resident_name'                               => $value['8'],
                      'landlord_or_company_name'                    => $value['9'],
                      'email'                                       => $value['10'],
                      'this_period_due_amount'                      => $value1['11'],
                      'past_due_amount'                             => $value1['12'],
                      'electric_meter_end_point_sn'                 => $value['13'],
                      'sensors'                                     => $value['14'],
                      'electric_rate_off_peak_per_kwh'              => $value['15'],
                      'electric_rate_on_peak_per_kwh'               => $value['16'],
                      'state_sucharge_tax'                          => $value['17'],
                      'state_regulatory_fee'                        => $value['18'],
                      'state_discount_in_electricity'               => $value['19'],
                      'electric_service_establishment_charge'       => $value['20'],
                      'other_service_fee_or_credits_electricity'    => $value['21'],
                      'this_period_off_peak_kwh_reading'            => $value1['22'],
                      'this_period_on_peak_kwh_reading'             => $value1['23'], 
                      'water_meter_end_point_sn'                    => $value['24'],
                      'water_reading_unit'                          => $value['25'],
                      'water_rate_per_unit'                         => $value['26'],
                      'sewer_rate_per_unit'                         => $value['27'],
                      'water_service_fee'                           => $value['28'],
                      'trash_and_recycling_fee'                     => $value['29'],
                      'state_discount_in'                           => $value['30'],
                      'other_services_fee_or_credit'                => $value['31'],
                      'this_period_kgall_reading'                   => $value1['32'],
                      'statement_start_date'                        => $start_date1,
                      'statement_end_date'                          => $end_date1,
                      'month_numeric'                               => $value1['35'],
                ]; 




        // before inserting the row check each account number already exists or not 
        // if yes then do not insert 
        // in no then insert the row 
        // get data from database to check 

        $customer_data = $model->where('account_number' , $value['0']);
        $customer_data1 = $model->first();

          if(!isset($customer_data1))
          {
              $result = $model->insert($data23);
          }
          else
          {

          // update 
          $data22 = [
                        'account_number'                              => $value['0'],
                        'account_type'                                => $value['1'],
                        'street_address'                              => $value['2'],
                        'unit'                                        => $value['3'],
                        'unit_id'                                     => $value['4'],
                        'city'                                        => $value['5'],
                        'state'                                       => $value['6'],
                        'zip_code'                                    => $value['7'],
                        'resident_name'                               => $value['8'],
                        'landlord_or_company_name'                    => $value['9'],
                        'email'                                       => $value['10'],
                        'this_period_due_amount'                      => $value1['11'],
                        'past_due_amount'                             => $value1['12'],
                        'electric_meter_end_point_sn'                 => $value['13'],
                        'sensors'                                     => $value['14'],
                        'electric_rate_off_peak_per_kwh'              => $value['15'],
                        'electric_rate_on_peak_per_kwh'               => $value['16'],
                        'state_sucharge_tax'                          => $value['17'],
                        'state_regulatory_fee'                        => $value['18'],
                        'state_discount_in_electricity'               => $value['19'],
                        'electric_service_establishment_charge'       => $value['20'],
                        'other_service_fee_or_credits_electricity'    => $value['21'],
                        'this_period_off_peak_kwh_reading'            => $value1['22'],
                        'this_period_on_peak_kwh_reading'             => $value1['23'], 
                        'water_meter_end_point_sn'                    => $value['24'],
                        'water_reading_unit'                          => $value['25'],
                        'water_rate_per_unit'                         => $value['26'],
                        'sewer_rate_per_unit'                         => $value['27'],
                        'water_service_fee'                           => $value['28'],
                        'trash_and_recycling_fee'                     => $value['29'],
                        'state_discount_in'                           => $value['30'],
                        'other_services_fee_or_credit'                => $value['31'],
                        'this_period_kgall_reading'                   => $value1['32'],
                        'statement_start_date'                        => $start_date1,
                        'statement_end_date'                          => $end_date1,
                        'month_numeric'                               => $value1['35'],
                    ];

          

          $model->set($data22);
          $model->where('account_number', $value['0']);
          $result = $model->update();
        }
      }
      

      // end=============>
      
      // get (import_customer) data  using array and store in the database
      $model2 = new ImportCustomersModel();

      // get date using php function
      $current_date = date('Y-m-d');
      // get values
      $data2 = [
                'file_name'  => $_FILES['file2']['name'],
                'date'       => $current_date,
                ];

      // insert the (import_customer data)===>
      $import_cus_data_result = $model2->insert($data2);

      // end import customer data========================
    }
     // success message when we insert the data--->
     $session->setFlashdata('success', 'success');
     $path  = base_url().'/import-customer';
     return redirect()->to($path);
  }
    else
    {  
      $session->setFlashdata('error', 'error');
      $path  = base_url().'/import-customer';
      return redirect()->to($path); 
    }
}


// end import csv file for customer==========>


// export csv file for customer==========>
   public function exportData()
   { 
     // file name 
     $filename = 'users_'.date('Ymd').'.csv'; 
     header("Content-Description: File Transfer"); 
     header("Content-Disposition: attachment; filename=$filename"); 
     header("Content-Type: application/csv; ");

     // get data 
     $users = new CustomersModel();

     $usersData = $users->select('account_number, account_type, street_address, unit, unit_id, city, state, zip_code, resident_name, landlord_or_company_name, email, electric_meter_end_point_sn, sensors, electric_rate_off_peak_per_kwh, electric_rate_on_peak_per_kwh, state_sucharge_tax, state_regulatory_fee, state_discount_in_electricity, electric_service_establishment_charge, other_service_fee_or_credits_electricity, water_meter_end_point_sn, water_reading_unit, water_rate_per_unit, sewer_rate_per_unit, water_service_fee, trash_and_recycling_fee,  state_discount_in, other_services_fee_or_credit')->findAll();


     foreach ($usersData as $key_userdata => $value_userdata) 
     {
        $userDataCombine[$key_userdata]['account_number']                         = $value_userdata['account_number'];

        $userDataCombine[$key_userdata]['account_type']                            = $value_userdata['account_type'];

        $userDataCombine[$key_userdata]['street_address']                          = $value_userdata['street_address'];

        $userDataCombine[$key_userdata]['unit']                                    = $value_userdata['unit'];

        $userDataCombine[$key_userdata]['unit_id']                                 = $value_userdata['unit_id'];

        $userDataCombine[$key_userdata]['city']                                    = $value_userdata['city'];

        $userDataCombine[$key_userdata]['state']                                   = $value_userdata['state'];

        $userDataCombine[$key_userdata]['zip_code']                                = $value_userdata['zip_code'];

        $userDataCombine[$key_userdata]['resident_name']                           = $value_userdata['resident_name'];

        $userDataCombine[$key_userdata]['landlord_or_company_name']                 = $value_userdata['landlord_or_company_name'];

        $userDataCombine[$key_userdata]['email']                                    = $value_userdata['email'];

        $userDataCombine[$key_userdata]['this_period_due_amount']                   = '';

        $userDataCombine[$key_userdata]['past_due_amount']                          = '';

        $userDataCombine[$key_userdata]['electric_meter_end_point_sn']              = $value_userdata['electric_meter_end_point_sn'];

        $userDataCombine[$key_userdata]['sensors']                                  = $value_userdata['sensors'];

        $userDataCombine[$key_userdata]['electric_rate_off_peak_per_kwh']           = $value_userdata['electric_rate_off_peak_per_kwh'];

        $userDataCombine[$key_userdata]['electric_rate_on_peak_per_kwh']            = $value_userdata['electric_rate_on_peak_per_kwh'];

        $userDataCombine[$key_userdata]['state_sucharge_tax']                       = $value_userdata['state_sucharge_tax'];

        $userDataCombine[$key_userdata]['state_regulatory_fee']                     = $value_userdata['state_regulatory_fee'];

        $userDataCombine[$key_userdata]['state_discount_in_electricity']            = $value_userdata['state_discount_in_electricity'];

        $userDataCombine[$key_userdata]['electric_service_establishment_charge']    = $value_userdata['electric_service_establishment_charge'];

        $userDataCombine[$key_userdata]['other_service_fee_or_credits_electricity'] = $value_userdata['other_service_fee_or_credits_electricity'];

         $userDataCombine[$key_userdata]['this_period_off_peak_kwh_reading']         = '';

         $userDataCombine[$key_userdata]['this_period_on_peak_kwh_reading']          = '';

        $userDataCombine[$key_userdata]['water_meter_end_point_sn']                 = $value_userdata['water_meter_end_point_sn'];

         $userDataCombine[$key_userdata]['water_reading_unit']                       = $value_userdata['water_reading_unit'];

        $userDataCombine[$key_userdata]['water_rate_per_unit']                      = $value_userdata['water_rate_per_unit'];

        $userDataCombine[$key_userdata]['sewer_rate_per_unit']                      = $value_userdata['sewer_rate_per_unit'];

        $userDataCombine[$key_userdata]['water_service_fee']                        = $value_userdata['water_service_fee'];

        $userDataCombine[$key_userdata]['trash_and_recycling_fee']                  = $value_userdata['trash_and_recycling_fee'];

        $userDataCombine[$key_userdata]['state_discount_in']                        = $value_userdata['state_discount_in'];

        $userDataCombine[$key_userdata]['other_services_fee_or_credit']             = $value_userdata['other_services_fee_or_credit'];

        $userDataCombine[$key_userdata]['this_period_kgall_reading']                = '';

        $userDataCombine[$key_userdata]['statement_start_date']                     = '';

        $userDataCombine[$key_userdata]['statement_end_date']                       = '';

        $userDataCombine[$key_userdata]['month_name_numeric']                       = '';

     }

     // echo '<pre>';
     // print_r($usersData);
     // echo '</pre>';
     // die();

     // file creation 
     ob_clean();
     $file = fopen('php://output', 'w');
     $header = array("Account number","Account type","Property Street Address","Unit Number", "Unit ID", "City","State","Zip Code","Resident Name","Landlord or Company Name","Resident email","This period Due amount","Past Due Amount","Electric meter end point SN","Electric Sensor","Electric Rate off -Peak $","Electric Rate on-peak $","State Surcharge tax $","State Regular Fees","Electric Discount %","Electric Service Est. Charge $","Other Service Fee Or Credits $","This period off-peak kWh reading","This period on-peak kWh reading","Water endpoint SN","Water Reading Unit","Water rate $","Sewer rate $","Water Service fee $","Trash Recycle fee $","Water Discount %","Other Service fees or Credits $","This period kGall Reading","Start Date", "End Date", "Month"); 

     
     fputcsv($file, $header);
     foreach ($userDataCombine as $key=>$line)
     { 
        fputcsv($file,$line); 
     }
     fclose($file); 
     exit; 
   }
   // export csv file for customer==========>

   // export csv file for biller=================>
   public function exportData_biller()
   { 
      // file name 
      $filename = 'billers_'.date('Ymd').'.csv'; 
      header("Content-Description: File Transfer"); 
      header("Content-Disposition: attachment; filename=$filename"); 
      header("Content-Type: application/csv; ");

      // get data 
      $billers = new BillersModel();
      $billers->where('login_type' , 'Biller');
      $billersData = $billers->select('first_name, middle_name, last_name, username, phone_number, address, date_of_birth, gender')->findAll();

      // file creation 
      $file = fopen('php://output', 'w');

      $header = array("First Name", "Middle Name", "Last Name", "Username", "Phone Number", "Address", "Date of Birh", "gender"); 

      fputcsv($file, $header);
      foreach ($billersData as $key=>$line)
      { 
        fputcsv($file,$line); 
      }
      fclose($file); 
      exit; 
   }
   // end export csv file for biller=================>
 }







 

                              
                               
                                    
                               
