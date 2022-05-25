<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AllUsersModel;
use CodeIgniter\Controller;

// use Config\Database;

class Authentication extends BaseController

{
  private $login = '' ;

  public function __construct()
  {
    $this->login = new AllUsersModel();    
  }

// session set for login form===>

  public function index()    
  {  
    $session = session();

    // if user login then redirect to dashboard else redirect to login page
    $sessionLoginId = $session->get('id');

    if($sessionLoginId)
    {
        $path  = site_url('dashboard');
        return redirect()->to($path); 
    }
    else
    {
      return view('Authentication/login');
    }
  } 
  // end index section=====================>

 // login controller===> 

  public function login_form()
  {
    $data = array('username'=>$this->request->getVar('username'),
                  'password'=>md5($this->request->getVar('password')));


    $user =  $this->login->where($data);

    $rows =  $this->login->countAllResults();

    $session = session();

    if($rows == 1)
    {
      // run query here and get details from datbase 
      $model_test = new AllUsersModel();
      $data2_test['allUsers'] = $model_test->getAllUsers($data);

      $ses_data = [

                    'username'           => $data2_test['allUsers']['username'],
                    
                    'firstname'          => $data2_test['allUsers']['first_name'],

                    'id'                 => $data2_test['allUsers']['id'],

                    'login_type'         => $data2_test['allUsers']['login_type'],

                    'login_id'           => $data2_test['allUsers']['login_id'],

                    //'upload_img'         => $data2_test['allUsers']['upload_img'],
                   ];

      $session->set($ses_data);

      // echo '<pre>';
      // print_r($ses_data);
      // echo '</pre>';
      // die();


      $path  = site_url('dashboard');

      return redirect()->to($path); 
    }

    else
    {
      $session->setFlashdata('message', 'Username Or Password Incorrect');
      // return view('Authentication');

      $path  = site_url('Authentication');

      return redirect()->to($path); 
    } 

  }
// end login users====>


// dashboard controller======>

  public function dashboard()
  {
     $session = session();

     $sessionLoginId = $session->get('id');
     $sessionfirst_name = $session->get('firstname');

    // if sessions exists then only open this page otherwise redirect to login page 
    if(isset($sessionLoginId))
    {

      $data['sessionfirst_name']= $sessionfirst_name;

      $data['content']  = 'Authentication/dashboard';

       return view('template/template' , $data);
    }
    else
    {
      $path  = site_url();

      return redirect()->to($path); 
    }
  }

// end dashboard controller===>


// logout session===>
  public function logout()
  {
    $session = session();

    $session->destroy();

    return redirect()->to(site_url());
  }
//end logout session===>
}