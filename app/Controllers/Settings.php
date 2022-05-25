<?php
namespace App\Libraries;
namespace App\Controllers;
use App\Models\AllUsersModel;
use CodeIgniter\Controller;


class Settings extends BaseController
{
   // edit profile section++++++++++++>

   public function edit_profile()
   { 
      $session = session();
      $sessionIdd = $session->get('id');
      // if sessions exists then only open this page otherwise redirect to login page 
      if(isset($sessionIdd))
      { 
         if(isset($_POST['btn_save']))
         {
            helper(['form', 'url']);

            $all_users_model = new AllUsersModel();

            $validated = $this->validate([
                                             'file2' => [
                                                         'uploaded[file2]',
                                                         'mime_in[file2,image/jpg,image/jpeg,image/gif,image/png]',
                                                         'max_size[file2,11563555555]',
                                                        ],
                                        ]);
            $msg = 'Please select a valid file';

            //$current_date_time = date('Y-m-d_H_i_s_a');
            // echo $_SERVER["DOCUMENT_ROOT"].'/roshan_energy/public/profile_img';
            // die();

            if($validated)
            {
               $avatar = $this->request->getFile('file2');
               $avtar_img = $avatar->move($_SERVER["DOCUMENT_ROOT"].'/roshan_energy/public/profile_img');



               // update the data in the users table

               $all_users_model = new AllUsersModel();
               $all_users_model_data = [
                                          'password'   => md5($this->request->getVar('confirm_password')),
                                          'upload_img' => $_FILES["file2"]["name"],
                                       ];

               $all_users_model_check = array(
                                                'login_type' => 'admin',
                                             );

               $all_users_model->set($all_users_model_data);
               $getinfo = $all_users_model->where($all_users_model_check);
               $getinfo = $getinfo->first();

                
               $all_users_model->set($all_users_model_data);
               $getinfo = $all_users_model->where($all_users_model_check);
               $result = $all_users_model->update();
               // end update the data in the users table

               $session->setFlashdata('success', 'success');
            }
         }

               $all_users_model = new AllUsersModel();
               $getinfo = $all_users_model->where(array('login_type' => 'admin'));
               $getinfo = $getinfo->first();

               // fetch the image===============>
               $data['user_info'] = $getinfo;
               // end fetch the image===============>


            $data['content']  = 'Settings/edit_profile';
            return view('template_with_header/template' , $data);
      }
      else
      {
         $path  = site_url();
         return redirect()->to($path); 
      }
   }
   //end edit profile section++++++++++++>
   

}
// end main public section+++++++++++++++>



  