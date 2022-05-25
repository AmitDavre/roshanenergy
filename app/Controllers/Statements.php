<?php
namespace App\Libraries;
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\CustomersModel;
use App\Models\ImportCustomersModel;
use App\Models\BillersModel;
use App\Models\WaterAndElectricityModel;
use App\Models\GenerateStatementModel;
use App\Models\MonthlyUtilityStatementsModel;
use App\Models\SettingsModel;
use CodeIgniter\Controller;
use TCPDF;

require APPPATH.'ThirdParty/vendor/autoload.php';
use \PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use \PhpOffice\PhpSpreadsheet\RichText\RichText;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class Statements extends BaseController
{   

    // create-upload-bills section===================================>
    public function create_upload_bills()
    {
      $session = session();
      $sessionId = $session->get('id');

      // if sessions exists then only open this page otherwise redirect to login page 
       if(isset($sessionId))
       {
          $data['content']  = 'Statements/create_upload_bills';
          return view('template/template' , $data);
       }
       else
       {
           $path  = site_url();
           return redirect()->to($path); 
       }
    }
    //end create-upload-bills section===================================>

    // generate-statement section======================================>
    public function generate_statements()
    {
        $session = session();
        $sessionId = $session->get('id');

        // if sessions exists then only open this page otherwise redirect to login page 
        if(isset($sessionId))
        {
            // when we click generate button then generate the pdf========>    
            if(isset($_POST['gen_statement']))
            {
                
                // generate pdf section----------------------------------------------->

                $model = new CustomersModel();
                $find_cus_id = $this->request->getVar('multiselect2');

                $date_range = $this->request->getVar('daterange');
                $dates = explode("-", $date_range);
                $start_date = date('Y-m-d', strtotime($dates[0]));
                $end_date = date('Y-m-d', strtotime($dates[1]));

                // get month from the date========>
                $select_month = date('m',strtotime($start_date));

                // REMOVE ZERO FROM THE MONTH NUMERIC
                $select_month_numeric = (int)$select_month;

               
                // get year from the date===>
                $get_year = date('Y',strtotime($start_date));

              

                 // if select cus id is zero then finds all  // for loop 
                // if select cus id is value then get specific value // no for loop
                if($find_cus_id != '0')
                {
                    $customer_data =  $model->where('id', $find_cus_id);
                    $customer_data1 = $model->first();

                 // if month and account no exists in the table then dont generate the statement 
                // run query with where customer id and date 
                    $modelCheckDataExists= new WaterAndElectricityModel();

                    $whereArray = array('account_number' => $customer_data1['account_number'], 'month_name_numeric' => (int)$select_month,);
                    
                    $generateStatementExists =  $modelCheckDataExists->where($whereArray);
                    $generateStatementExistsData = $modelCheckDataExists->first();

                    if(isset($generateStatementExistsData))
                    {
                        if($generateStatementExistsData['statement_start_date'] == '' && $generateStatementExistsData['statement_end_date'] == '')
                        {
                            // show error message that statement cannot be generated
                            $session->setFlashdata('error', 'error');
                        }
                        else 
                        {
                            // get date using php function====>
                            $current_date = date('Y-m-d');

                            $current_date_time = date('Y-m-d_H_i_s_a');

                            //echo $current_date_time;
                            // die();
                            // // echo '<pre>'; 
                            // // print_r($customer_data1);
                            // // echo '</pre>'; 
                            // // die();

                            //water and electricity table=======>
                            $model = new WaterAndElectricityModel();
                            // $customer_total_reading = $model->where('account_number', $customer_data1['account_number']);
                            //$customer_total_reading11 = $model->first();
                           
                            $customer_total_reading_11 = array(
                                                                'account_number'     => $customer_data1['account_number'],
                                                                'month_name_numeric' => (int)$select_month,
                                                                
                                                              );

                            $customer_total_reading = $model->where($customer_total_reading_11);
                            $customer_total_reading = $model->first();

                            // echo '<pre>';
                            // print_r($customer_total_reading_11);
                            // print_r($customer_total_reading);
                            // echo '</pre>';
                            // die();



                            // pdf section=============================================>

                            // testing dates for graph

                            // $textdt    = "01 january 2022";
                            // $dt        = strtotime($textdt);
                            // $currdt    = $dt;
                            // $nextmonth = strtotime($textdt."+1 month");
                            // $i = 0;

                            // do 
                            // {
                            //     $weekday      = date("w",$currdt);
                            //     $nextday      = 7-$weekday;
                            //     $endday       = abs($weekday-6);
                            //     $startarr[$i] = $currdt;
                            //     $endarr[$i]   = strtotime(date("Y-m-d",$currdt)."+$endday day");
                            //     $currdt       = strtotime(date("Y-m-d",$endarr[$i])."+1 day");

                            //     echo "Week ".($i+1). "-> start date = ". date("Y-m-d",$startarr[$i])." end date = ". date("Y-m-d",$endarr[$i])."<br>";
                            //     $i++;
                            // }
                            // while($endarr[$i-1]<$nextmonth);
                            
                            

                            //graph code=============================>

                            // $data = [
                            //             'Jan' => 103, 
                            //             'Feb' => 24,  
                            //             'Mar' => 44,
                            //             'Apr' => 14,
                            //             'May' => 89,
                            //             'Jun' => 147,
                            //             'Jul' => 181,
                            //             'Aug' => 172,
                            //             'Sep' => 52,
                            //             'Oct' => 106,
                            //             'Nov' => 121,
                            //             'Dec' => 76,
                            //         ];

                            // '1/7'   => 103,
                            //             '8/14'  => 24,
                            //             '15/21' => 44,
                            //             '22/28' => 14,
                            //             '29/31' => 10,

                             $data = [
                                        ''.$select_month_numeric.'/1'   => 0.9,
                                        ''.$select_month_numeric.'/8'  => 1,
                                        ''.$select_month_numeric.'/15' => 1.4,
                                        ''.$select_month_numeric.'/21' => 0.4,
                                        ''.$select_month_numeric.'/29' => 0.1,
                                    ];

                            // Image dimensions
                            $imageWidth  = 700;
                            $imageHeight = 400;

                            // Grid dimensions and placement within image
                            $gridTop     = 40;
                            $gridLeft    = 50;
                            $gridBottom  = 340;
                            $gridRight   = 650;
                            $gridHeight  = $gridBottom - $gridTop;
                            $gridWidth   = $gridRight - $gridLeft;

                            // Bar and line width
                            $lineWidth = 1;
                            $barWidth  = 20;

                            // Font settings
                            $font = 'graph_font/OpenSans-Regular.ttf';
                            $fontSize = 10;

                            // Margin between label and axis
                            $labelMargin = 8;

                            // Max value on y-axis
                            $yMaxValue = 1.6;

                            // Distance between grid lines on y-axis
                            $yLabelSpan = 0.2;

                            // Init image
                            $chart = imagecreate($imageWidth, $imageHeight);

                            // Setup colors
                            // $backgroundColor = imagecolorallocate($chart, 255, 255, 255);
                            // $axisColor = imagecolorallocate($chart, 85, 85, 85);
                            // $labelColor = $axisColor;
                            // $gridColor = imagecolorallocate($chart, 212, 212, 212);
                            // $barColor = imagecolorallocate($chart, 47, 133, 217);

                            $backgroundColor = imagecolorallocate($chart, 255, 255, 255);
                            $axisColor = imagecolorallocate($chart, 85, 85, 85);
                            $labelColor = $axisColor;
                            $gridColor = imagecolorallocate($chart, 212, 212, 212);
                            $barColor = imagecolorallocate($chart, 244, 154, 85);


                            imagefill($chart, 0, 0, $backgroundColor);

                            imagesetthickness($chart, $lineWidth);


                            for($i = 0; $i <= $yMaxValue; $i += $yLabelSpan) {
                            $y = $gridBottom - $i * $gridHeight / $yMaxValue;

                            // draw the line
                            imageline($chart, $gridLeft, $y, $gridRight, $y, $gridColor);

                            //draw right aligned label
                            $labelBox = imagettfbbox($fontSize, 0, $font, strval($i));
                            $labelWidth = $labelBox[4] - $labelBox[0];

                            $labelX = $gridLeft - $labelWidth - $labelMargin;
                            $labelY = $y + $fontSize / 2;

                            imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, strval($i));
                            }

                            imageline($chart, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColor);
                            imageline($chart, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColor);

                            $barSpacing = $gridWidth / count($data);
                            $itemX = $gridLeft + $barSpacing / 2;

                            foreach($data as $key => $value) {
                            // Draw the bar
                            $x1 = $itemX - $barWidth / 2;
                            $y1 = $gridBottom - $value / $yMaxValue * $gridHeight;
                            $x2 = $itemX + $barWidth / 2;
                            $y2 = $gridBottom - 1;

                            imagefilledrectangle($chart, $x1, $y1, $x2, $y2, $barColor);

                            //Draw the label
                            $labelBox = imagettfbbox($fontSize, 0, $font, $key);
                            $labelWidth = $labelBox[4] - $labelBox[0];

                            $labelX = $itemX - $labelWidth / 2;
                            $labelY = $gridBottom + $labelMargin + $fontSize;

                            imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, $key);

                            $itemX += $barSpacing;
                            }
                     
                            // header('Content-Type: image/png');
                           // save image to the folder-------------->
                            $save = "graph_img/";
                            $save_graph_img = $save.$customer_data1['account_number'].'_'.$current_date_time.'.png';

                            $nameOfFile = $customer_data1['account_number'].'_'.$current_date_time.'.png';



                           imagepng($chart, $save_graph_img);
                           // end graph code=============================>
                           

                           //pdf section
                           // if graph file name exist in the table then pdf generate===>
                           if($nameOfFile)
                           {
                            //start pdf section=============>
                            ob_start();
                            // date and account number combile in the attach file name====>
                            $baseurlValue = $_SERVER['DOCUMENT_ROOT'].'/roshan_energy/public/generate_statements/';
                            $attach_file_name = $baseurlValue.$customer_data1['account_number'].'_'.$current_date.'.pdf';
                            $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
                            $obj_pdf->SetCreator(PDF_CREATOR);  
                            $obj_pdf->SetTitle("Statement");  
                            $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
                            $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
                            $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
                            $obj_pdf->SetDefaultMonospacedFont('helvetica');  
                            $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
                            $obj_pdf->SetMargins('6', '8', '6');  
                            $obj_pdf->setPrintHeader(false);  
                            $obj_pdf->setPrintFooter(false);  
                            $obj_pdf->SetAutoPageBreak(TRUE, 10);  
                            $obj_pdf->SetFont('helvetica', '', 9);  
                            $obj_pdf->AddPage(); 
                            $content = ''; 
                           

                          
                            
                           // end graph code=============================> 
                            
                            

                           

                           // header section============================>
                            $content = '<style>

                            tr.asd td
                            {
                                border:1px solid black;
                                text-align:center;
                            }

                            tr td.add-border
                            {
                                border:1px solid black;
                            }

                            tr.add-border-graph td
                            {
                               border:2px solid orange;; 
                            }
                            

                            </style>';

                            $content .= '<table>
                                        <tr>
                                            <td style="width:150px;"><img src="'.base_url().'/assets/img/logos/logo.jpeg"></td>
                                            <td>
                                            <table>
                                            <tr>
                                               <td width="7%"></td>
                                               <td width="35%"><b>ACCOUNT NUMBER</b></td>
                                               <td width="5%"></td>
                                               <td width="20%"><b>'.$customer_data1['account_number'].'</b></td>
                                               <td width="5%"></td>
                                               <td width="5%"></td>
                                               <td width="40%"><b>DATE MAILED</b></td>
                                               <td width="35%"><b>'.$current_date.'</b></td>
                                            </tr>
                                            <tr>
                                                <td width="7%"></td>
                                                <td width="30%"><b>SERVICES FOR</b></td>
                                           </tr>
                                           <tr>
                                                <td width="7%"></td>
                                                <td width="70%"><b>'.$customer_data1['resident_name'].' , '.$customer_data1['unit'].'  ('.$customer_data1['unit_id'].')</b></td>
                                           </tr>
                                           <tr>
                                                <td width="7%"></td>
                                                <td width="100%"><b>'.$customer_data1['street_address'].' ,  '.$customer_data1['city'].'</b></td>
                                           </tr>
                                           </table></td>
                                        </tr>
                                        <hr style="height:3px; border-width:0; color:#6ba716;">
                                    </table>';


                            //end header section============================>

                            //start calculation of electricity bill==+++++++++++++++++++++=====>

                            // calculation of electric amount--------> 
                            $electric_amount = number_format(($customer_data1['electric_rate_off_peak_per_kwh'] * $customer_total_reading['this_period_off_peak_kwh_reading']) + ($customer_data1['electric_rate_on_peak_per_kwh'] * $customer_total_reading['this_period_on_peak_kwh_reading']),2);

                             // $test = number_format($electric_amount, 2);

                            //end  calculation of electric amount----->

                           //calculation of state surcharge tax amount------->
                            $state_surcharge_tax_amount = number_format(($customer_data1['state_sucharge_tax']) * ( $customer_total_reading['this_period_off_peak_kwh_reading'] +  $customer_total_reading['this_period_on_peak_kwh_reading']),2);
                           //end calculation of state surcharge tax amount------->
                            
                            // state regulatory fee amount-------->
                            $state_regulatrory_fee_amount = number_format(($customer_data1['state_regulatory_fee']) * ($customer_total_reading['this_period_off_peak_kwh_reading'] +  $customer_total_reading['this_period_on_peak_kwh_reading']),2);
                             //end state regulatory fee amount-------->

                            // elecrtic service est charge--->
                            $electric_service_est_charge_amount = number_format($customer_data1['electric_service_establishment_charge'],2);


                            // end elecrtic service est charge--->

                            // other acc charges and credits----->

                            // $other_acc_charges_and_credit = number_format($electric_amount - (($customer_data1['electric_discount_percentage'] / 100) * ($electric_amount) + $customer_data1['other_service_fee_or_credits_electricity']),2);

                           // echo $customer_data1['state_discount_in_electricity'].'-';
                           //  echo $electric_amount.'-';
                           // echo $customer_data1['other_service_fee_or_credits_electricity'].'-';


                           $electricvalueAmount =  floatval(preg_replace('/[^\d. ]/', '', $electric_amount));
             

                            $other_acc_charges_and_credit = number_format(-1*(($customer_data1['state_discount_in_electricity'] / 100) * ($electricvalueAmount)) + ($customer_data1['other_service_fee_or_credits_electricity']),2);



                            // end other acc charges and credits----->

                            // total electric charge this month------>

                            // remove comma from numeric value===>
                             // echo floatval(preg_replace('/[^\d. ]/', '', '111,2222.44'));

                             $total_electric_charge_this_month =  floatval(preg_replace('/[^\d. ]/', '', $electric_amount) + preg_replace('/[^\d. ]/', '', $state_surcharge_tax_amount) + preg_replace('/[^\d. ]/', '', $state_regulatrory_fee_amount) +  preg_replace('/[^\d. ]/', '', $electric_service_est_charge_amount) + preg_replace('/[^\d. ]/', '', $other_acc_charges_and_credit));

                             // $total_electric_charge_this_month = number_format($electric_amount + $state_surcharge_tax_amount +  $state_regulatrory_fee_amount + $electric_service_est_charge_amount +  $other_acc_charges_and_credit,2);

                            // total electric charge this month------>
                            //end calculation of electricity bill====+++++++++++++++++++++++++++++++++===>

                            //start water-meter calculation====++++++++++++++++++++++++++++++++++++++++++++++++++++++++++======>

                            //water usage amount=========>
                            $water_usage_amount = number_format((float)($customer_data1['water_rate_per_unit']) * ($customer_total_reading['this_period_kgall_reading']),2, '.' ,'');

                            // remove comma(string) into decimal
                            // $tessssst =number_format((float)$water_usage_amount, 2, '.', '');
                            // echo $tessssst ;

                            //end water usage amount=========>

                            // water-service-amount====>
                            $water_service_amount = number_format($customer_data1['water_service_fee'],2);
                            // end water-service-amount====>

                            // trash and recycling amount=====>
                            $trash_and_recycling_amount = number_format($customer_data1['trash_and_recycling_fee'],2);
                            // end trash and recycling amount=====>

                            // waste water sewer amount======>
                            $waste_water_sewer_amount = number_format((float)($customer_data1['sewer_rate_per_unit']) * ($customer_total_reading['this_period_kgall_reading']),2, '.', '');
                            // end waste water sewer amount======>

                            // other account charges and credits=====>
                            // $other_account_charges_and_credits = number_format((float)$water_usage_amount - (($customer_data1['water_discount']/ 100) * ($water_usage_amount)) + ($customer_data1['other_services_fee_or_credit']),2, '.', '');

                           


                            $other_account_charges_and_credits = number_format((float) -1 *(($customer_data1['state_discount_in']/ 100) * ($water_usage_amount)) + ($customer_data1['other_services_fee_or_credit']),2, '.', '');



                            // end other account charges and credits=====>

                            // total warer and sewage charges this month=====>
                            $total_water_and_sewage_charges_this_month = number_format((float)$water_usage_amount + $water_service_amount + $trash_and_recycling_amount + $waste_water_sewer_amount + $other_account_charges_and_credits, 2, '.' ,'');

                            // end total warer and sewage charges this month=====>

                            // end water-meter calculation+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++==>

                            // grand total electric + water (this month)=====+++++++++=>
                         
                           $amount_due = number_format($total_electric_charge_this_month + $total_water_and_sewage_charges_this_month ,2);
                           // grand total=======++++++++++++=======================>

                            //startwhen we click on generate button then generate statememt in the table==++++++++++++====>

                            // insert data in the database======>

                            // find total amount
                            // $model = new WaterAndElectricityModel();

                            // // find cus id------------->
                            // $model = new CustomersModel();
                            // $find_cus_id = $this->request->getVar('multiselect2');
                            // $customer_data =  $model->where('id', $find_cus_id);
                            // $customer_data1 = $model->first();

                            // end find cus id------------->
                            $account_number = $customer_data1['account_number'];
                            $current_date = date('Y-m-d');

                            $model = new GenerateStatementModel();
                             
                             // separate start date and end date========>
                             // $date_range = $this->request->getVar('daterange');
                             // $dates = explode("-", $date_range);
                             // $start_date = date('Y-m-d', strtotime($dates[0]));
                             // $end_date = date('Y-m-d', strtotime($dates[1]));
                             // $select_month = date('m',strtotime($start_date));

                             //end  separate start date and end date========>

                             $attach_file_name_db = base_url().'/generate_statements/'.$customer_data1['account_number'].'_'.$current_date.'.pdf';

                             // echo '<pre>';
                             // print_r($attach_file_name_db);
                             // echo '</pre>';
                             // die();

                            // generate bill number====================>
                            $setting_model = new SettingsModel();
                            $setting_model_data = $setting_model->findAll();

                            $bill_number_inc = $setting_model_data[0]['bill_number']+1;

                            $data1111 = [
                                            'bill_number' => $bill_number_inc
                                        ];


                            $setting_model->set($data1111);
                            $setting_model->where('id', '1');
                            $result = $setting_model->update();
                            //end update generate bill number====================>

                             $monthNumericIntValue = (int)$select_month;

                            $data = [
                                      'statement_start_date'        =>  $start_date,
                                      'statement_end_date'          =>  $end_date,
                                      'account_number'              =>  $account_number,
                                      'current_date_statement'      =>  $current_date,
                                      'total_amount_due'            =>  $amount_due,
                                      'statement_pdf_download'      =>  $attach_file_name_db,
                                      'resident_name'               =>  $customer_data1['first_name'].$customer_data1['last_name'],
                                      'unit'                        =>  $customer_data1['unit'],
                                      'street_address'              =>  $customer_data1['street_address'],
                                      'city'                        =>  $customer_data1['city'],
                                      'zip_code'                    =>  $customer_data1['zip_code'],
                                      'landlord_name'               =>  $customer_data1['landlord_or_company_name'],
                                      'month_name_numeric'          =>  $monthNumericIntValue,
                                      'bill_number'                 =>  $setting_model_data[0]['bill_number']
                                      ];

                                      // echo '<pre>';
                                      // print_r($data);
                                      // echo '</pre>';
                                      // die();


                            // to check we will use account number and month numeric 


                            $this->db = \Config\Database::connect();

                            $sql = "SELECT * FROM generate_statement_datatable WHERE account_number ='".$account_number."' AND month_name_numeric = '".$monthNumericIntValue."'";

                            $query = $this->db->query($sql);
                            $statementTableData = $query->getResultArray();

                            // echo '<pre>';
                            // print_r($statementTableData);
                            // echo '</pre>';
                            // die();

                            if(!empty($statementTableData))
                            {
                                
                                // update
                               $sqlUpdate = "UPDATE generate_statement_datatable SET total_amount_due = '".$amount_due."', statement_pdf_download = '".$attach_file_name_db."' WHERE account_number ='".$account_number."' AND month_name_numeric = '".$monthNumericIntValue."'";

                                $queryUpdate = $this->db->query($sqlUpdate);
    
                            }
                            else
                            {
                               // insert
                                $model->insert($data);
                            }


                    
                            // if already exists then update the balance and link 
                        
                             // end insert data in the database====>

                             // check here first if the account number and month value exists 
                             // get values in array 
                             // update total amount for that array 
                             // where account number = $account_number and month = month numeric value
                             
                             // find month numeric from gen statment table-===>
                             $model_cus = new GenerateStatementModel();
                             $where['account_number'] = $account_number;
                             $where['statement_start_date'] = $start_date; //1-1-22
                             $where['statement_end_date'] = $end_date;//31-1-22


                             $cus_record = $model_cus->where($where);
                             $cus_record = $model_cus->first();

                             $amount = $cus_record['total_amount_due'];
                             $month_numeric = date("m",strtotime($cus_record['statement_start_date']));

                             // remove zero for month===>
                             $numeric_month =(int) $month_numeric;

                             //find account number from w/e table=======>
                             $model11 = new WaterAndElectricityModel();
                             $find_total_month_record1 = $model11->findAll();
                             $find_account_number_cus = array('account_number' => $account_number);

                            foreach ($find_total_month_record1 as $key1 => $total_record) 
                            { 
                               if(($total_record['account_number'] == $account_number) && ($total_record['month_name_numeric'] == $numeric_month))
                               {
                                   $data44 = [
                                               'total_amount_due'        =>  $amount,
                                             ];

                                   $where['account_number'] = $account_number;
                                   $where['month_name_numeric'] = $numeric_month;

                                   $model11->where($where);
                                   $result = $model11->update($total_record['id'], $data44);
                                }
                            }
                             // update total amount using w/e model======>
                         
                            // find monthly data for customer=======================>
                            $model = new WaterAndElectricityModel();
                            $find_account_number = array('account_number'=> $account_number);
                            $cus_data = $model->getCustomerMonthlyData($find_account_number);

                            // echo '<pre>';
                            // print_r($cus_data);
                            // echo '</pre>';
                            // die();

                            $monthsArray = array();

                            // get all months array in the helper====>
                            $allMonthsArray = all_months();
                            // end get all months array in the helper====>

                            foreach ($cus_data as $key => $customerVal)
                            {
                                 if($customerVal['statement_start_date']!='')
                                 {
                                     $monthName = date("F",strtotime($customerVal['statement_start_date']));
                                     $monthNumeric = date("m",strtotime($customerVal['statement_start_date']));
                                     $monthsArray[] = array(

                                        'month_numeric' => $monthNumeric,
                                        'month_name'    => $monthName,
                                        'amount_due'    => $customerVal['total_amount_due'],
                                    );
                                  }
                                  // echo '<pre>';
                                  // print_r($customerVal);
                                  // echo '</pre>';
                                  // die();
                            }
                            // sorting  months
                            array_multisort(array_column($monthsArray, 'month_numeric'), SORT_ASC, $monthsArray);

                            // add new array to get months exists data (i.e shows all data in th array)
                            $MonthData= array();
                            foreach ($monthsArray as $key => $months_data_val) 
                            {
                                if(!in_array($months_data_val['month_numeric'], $allMonthsArray))
                                {
                                   $MonthData[$months_data_val['month_numeric']] = $months_data_val['month_numeric'];
                                }
                            }
                            $get_Unique_Array = array_unique($MonthData);

                            // echo '<pre>';
                            // print_r($monthsArray);
                            // echo '</pre>';
                            // die();

                            // add new array to get only months (i.e not exists data)=========>
                            foreach ($allMonthsArray as $months => $months_value) 
                            {
                                if(!in_array($months, $get_Unique_Array))
                                {
                                    $allMonths[] = array(
                                                            'month_numeric' => $months,
                                                            'month_name'    => $months_value,
                                                            'amount_due'    => '',
                                                         );
                                }
                            }
                            // echo '<pre>';
                            // print_r($monthsArray);
                            // print_r($allMonths);
                            // echo '</pre>';
                            // die();
                        
                            // Combile the two arrays=====>
                            $combine_array = array_merge($monthsArray,$allMonths);

                             // sorting  months
                            array_multisort(array_column($combine_array, 'month_numeric'), SORT_ASC, $combine_array);

                            // echo '<pre>';
                            // print_r($combine_array);
                            // echo '</pre>';
                            // die();

                           //end find monthly data for customer=======================>


                            // foreach ($monthsArray as $key => $valueMonth) {
                            // // echo $valueMonth['month_name'].'=>'.$valueMonth['amount_due'];
                            //      $test = ksort($valueMonth['month_name']);
                            // }
                            // ksort($monthsArray);

                            //end insert data in the water-electricity table=====>
                             

                           //end when we click on generate button then generate statememt in the table==++++++++++++++++====>

                           //start Account summary section=====================>

                            $content  .= '<tr><td></td></tr><tr><td></td></tr>
                            <table width="75%">
                            <tr>
                            <td width="100%">';

                            $content  .= '<table width="100%">
                                            <tr>
                                              <td style="color:#6ba716; font-size:14px;"><b>Account Summary</b></td>
                                              <td></td>
                                              <td></td>
                                            </tr>

                                            <tr><td></td></tr>
                                            <tr>
                                                <td style="font-size:11px;">Electric Charges</td>
                                                <td width="32%"></td>
                                                <td style="font-size:12px; text-align:right;"> $'.number_format($total_electric_charge_this_month,2).'</td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:11px;">Water Charges</td>
                                                <td width="32%"></td>
                                                <td style="font-size:12px; text-align:right;">$'.$total_water_and_sewage_charges_this_month.'</td>
                                            </tr><hr>

                                            <tr>
                                                <td style="font-size:11px;"><b>Total Amount Due</b></td>
                                                <td width="32%"></td>
                                                <td style="font-size:12px; text-align:right;"><b>$'.$amount_due.'</b></td>
                                            </tr>';

                            $content .= '</table>';

                            //end Account summary section====++++++++++++++++++++++============>

                            //start Electric section=====+++++++++=================>
                            $content  .= '<tr><td></td></tr>
                                          <table width="100%">
                                            <tr>
                                             <td width="100%" style="font-size:13px;"><b>Summary Of Current Charges</b></td>
                                            </tr>
                                          <tr><td></td></tr>

                                        <tr>
                                            <td width="30%" style="color:#6ba716; font-size:11px;">Electric</td>
                                            <td width="27%">Billing Period</td>
                                            <td width="20%">Usage</td>
                                            <td width="20%" style="text-align:right;">Amount($)</td>
                                         </tr><hr style="width:100%">

                                        <tr>
                                            <td width="30%" style="font-size:10px;">Electric</td>
                                            <td width="27%">'.$start_date.'  '.$end_date.' </td>
                                            <td width="20%">'.number_format($customer_total_reading['this_period_on_peak_kwh_reading'] + $customer_total_reading['this_period_off_peak_kwh_reading']).'KWH </td>
                                            <td width="20%" style="text-align:right;"> $'.$electric_amount.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="30%" style="font-size:10px;">State Surcharge Tax</td>
                                            <td width="27%"></td>
                                            <td width="20%">'.number_format($customer_total_reading['this_period_on_peak_kwh_reading'] + $customer_total_reading['this_period_off_peak_kwh_reading']).'KWH * '.$customer_data1['state_sucharge_tax'].'</td>
                                            <td width="20%" style="text-align:right;"> $'. $state_surcharge_tax_amount.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="30%" style="font-size:10px;">State Regulatory Fee</td>
                                            <td width="27%"></td>
                                            <td width="20%">'.number_format($customer_total_reading['this_period_on_peak_kwh_reading'] + $customer_total_reading['this_period_off_peak_kwh_reading']).'KWH  * '.$customer_data1['state_regulatory_fee'].'</td>
                                            <td width="20%" style="text-align:right;"> $'.$state_regulatrory_fee_amount.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="45%" style="font-size:10px;">Electric Service Establishment Charges</td>
                                            <td width="20%"></td>
                                            <td width="15%"></td>
                                            <td width="17%" style="text-align:right;">$'.$electric_service_est_charge_amount.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="38%" style="font-size:10px;">Other Account Charges And Credits</td>
                                            <td width="20%"></td>
                                            <td width="19%"></td>
                                            <td width="20%" style="text-align:right;"> $'.$other_acc_charges_and_credit.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="35%" style="color:#6ba716; font-size:10px;">Total Electric Charge This Month</td>
                                            <td></td>
                                            <td width="22%"></td>
                                            <td width="20%" style="text-align:right; color:#6ba716;"> $'.number_format($total_electric_charge_this_month,2).'</td>
                                        </tr>';

                            $content .= '</table>';
                            //End Electric section=======++++++++++++++==============>

                           //start water section======+++++++++++===========>
                            $content  .= '<tr><td></td></tr><tr><td></td></tr>
                                        <table width="100%">
                                        <tr>
                                            <td width="31%" style="color:#2189e1; font-size:11px;">Water</td>
                                            <td width="27%">Billing Period</td>
                                            <td width="20%">Usage</td>
                                            <td width="20%" style="text-align:right;">Amount($)</td>
                                         </tr><hr style="width:100%">

                                         <tr>
                                            <td width="31%" style="font-size:10px;">Water Usage</td>
                                            <td width="27%">'.$start_date.'  '.$end_date.' </td>
                                            <td width="20%">'.$customer_total_reading['this_period_kgall_reading'].' '.$customer_data1['water_reading_unit'].'</td>
                                            <td width="20%" style="text-align:right;">$'.$water_usage_amount.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="31%" style="font-size:10px;">Water Service</td>
                                            <td width="27%"></td>
                                            <td width="20%"></td>
                                            <td width="20%" style="text-align:right;">$'.$water_service_amount.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="31% style="font-size:10px;"">Trash/Recycling</td>
                                            <td width="27%"></td>
                                            <td width="20%"></td>
                                            <td width="20%" style="text-align:right;">$'.$trash_and_recycling_amount.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="31%" style="font-size:10px;">Wastewater/Sewer</td>
                                            <td width="27%"></td>

                                            <td width="20%">'.$customer_total_reading['this_period_kgall_reading']. ' '.$customer_data1['water_reading_unit'].'</td>

                                            <td width="20%" style="text-align:right;">$'.$waste_water_sewer_amount.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="39%" style="font-size:10px;">Other Account Charges And Credits</td>
                                            <td width="20%"></td>
                                            <td width="19%"></td>
                                            <td width="20%" style="text-align:right;">$'.$other_account_charges_and_credits.'</td>
                                        </tr><hr style="width:100%">

                                        <tr>
                                            <td width="50%" style="color:#2189e1;font-size:10px;">Total Water And Sewage Charges This Month</td>
                                            <td width="10%"></td>
                                            <td width="18%"></td>
                                            <td width="20%" style="text-align:right; color:#2189e1;">$'.number_format($total_water_and_sewage_charges_this_month,2).'</td>
                                        </tr>';

                            $content .= '</table></td>';


                           
                            $content .='<td>
                                        <table width="100%" style="border-left:1px solid black;">
                                        <tr class="asd">
                                            
                                            <td colspan="2" width="80%" style="font-size:10px;">DATE DUE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;18-sep-2021</td>
                                        </tr>

                                        <tr class="asd">
                                           
                                            <td colspan="2" width="80%" style="font-size:10px;">AMOUNT DUE  &nbsp;&nbsp;&nbsp;&nbsp; $'.$amount_due.'</td>
                                        </tr>
                                        <tr><td></td></tr><tr><td></td></tr>

                                        <tr>
                                            <td width="0.5%"></td>
                                            <td width="110%"><span style = "font-size:8px; color: #e97c3b;">Electric Daily Usage History</span><span style = "font-size:8px;">(kWh used)</span></td>
                                        </tr>

                                        <tr><td></td></tr>

                                        <tr class = "add-border-graph">
                                            <td colspan ="5"><img style="width:150px;" src="'.base_url().'/graph_img/'.$nameOfFile.'"></td>
                                        </tr>

                                        <tr><td></td></tr><tr><td></td></tr>


                                       <tr class="asd">
                                           
                                            <td colspan = "5" width="40%" style="color:#f49a55;">Bill History</td>
                                            <td colspan = "5" width="35%">Amount</td>
                                        </tr>';

                                        // echo '<pre>';
                                        // print_r($combine_array);
                                        // echo '</pre>';
                                        // die();

                                    foreach ($combine_array as $key => $valueMonth) 
                                    { 
                                        if($valueMonth['amount_due'] == '')
                                        {
                                            $content .= '<tr class="asd">
                                                       
                                                        <td colspan = "5" width="40%">'.$valueMonth['month_name'].'</td>
                                                        <td colspan = "5" width="35%"></td>
                                                     </tr>';
                                        }
                                        else
                                        {
                                            $content .= '<tr class="asd">
                                                       
                                                        <td colspan = "5" width="40%">'.$valueMonth['month_name'].'</td>
                                                        <td colspan = "5" width="35%">$'.$valueMonth['amount_due'].'</td>
                                                     </tr>';
                                        }
                                    }
                                  
                            $content .=  '</table>
                                        </td>
                                        </tr></table>';
                            


                            $content .='<table width="75.94%" style="border-right:1px solid black;">
                                         <tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr>
                                         </table>';
                            // end water section========++++++++++++++++===============>

                        
                            //start FOOTER SECTION=======================>
                            // f-sec-1===========>
                            $content .= '<table>
                                        <tr>
                                           <td width="100%" style="font-size:7px;">PLEASE KEEP THIS PORTION FOR YOUR RECORD.(FAVOUR DE GUARDAR ESTA PARTE PARA SUS REGISTORS)</td>
                                        </tr>

                                        <tr>
                                           <td style="border-bottom:1px dashed black;"></td>
                                        </tr>
                                        <tr><td></td></tr>

                                        <tr>
                                         <td width="100%" style="font-size:7px;">PLEASE RETURN THIS PORTION WITH YOUR PAYMENT TO SANDIRENT PROPERTY MANAGEMENT.(FAVOUR THE DEVOLVER ESTA PARTE CON SU PAGO)</td>
                                        </tr>';       

                            $content .= '</table>';
                            //end f-sec-1=====++++++++======> 

                            // f-sec-2===========>
                            $content .= '<table>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <img style="width:150px;" src="'.base_url().'/assets/img/logos/logo.jpeg">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>SERVICE ADDRESS :</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>'.$customer_data1['resident_name'].' , '.$customer_data1['unit'].' ('.$customer_data1['unit_id'].')</td>
                                                    </tr>
                                                     <tr>
                                                        <td>'.$customer_data1['street_address'].' ,  '.$customer_data1['city'].' , '.$customer_data1['zip_code'].' , '.$customer_data1['state'].'</td>
                                                    </tr>

                                                    <tr><td></td></tr><tr><td></td></tr>
                                                    <tr>
                                                       <td width="50%"></td>
                                                       <td width="20%"></td>
                                                       <td width="45%"></td>
                                                       <td width="70%">SANDIRENT PROPERTY MANAGEMENT</td>
                                                    </tr>

                                                    <tr>
                                                       <td width="50%"></td>
                                                       <td width="20%"></td>
                                                       <td width="45%"></td>
                                                       <td width="70%">365W 2nd Ave. Suite 100</td>
                                                    </tr>

                                                    <tr>
                                                       <td width="50%"></td>
                                                       <td width="20%"></td>
                                                       <td width="45%"></td>
                                                       <td width="70%">Escondido, CA 92025</td>
                                                    </tr>

                                                    <tr>
                                                       <td width="50%"></td>
                                                       <td width="20%">Bill Number :</td>
                                                       <td width="5%"></td>
                                                       <td width="30%">'.$data['bill_number'].'</td>
                                                    </tr>
                                                </table>
                                            </td>
                                           
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td></td>
                                                        <td width="1%"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr> 
                                                    <tr>
                                                        <td></td>
                                                        <td width="1%"></td>
                                                        <td></td>
                                                        <td width="15%"></td>
                                                        <td width="30%" class= "">DATE DUE</td>
                                                        <td width="25%" class= "">'.$current_date.'</td>
                                                    </tr>      

                                                    <tr>
                                                        <td width="1%"></td>
                                                        <td width="1%"></td>
                                                        <td width="35%">ACCOUNT NUMBER</td>
                                                        <td width="12%"></td>
                                                        <td width="35%" class= "">AMOUNT DUE</td>
                                                        <td width="25%" class= "">$'.$amount_due.'</td>
                                                    </tr>

                                                    <tr>
                                                        <td width="1%"></td>
                                                        <td width="1%"></td>
                                                        <td width="35%"></td>
                                                        <td width="12%"></td>
                                                        <td width="35%"></td>
                                                        <td width="25%"></td>
                                                    </tr>   

                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td width="35%">'.$customer_data1['account_number'].'</td>
                                                        <td></td>
                                                        <td width="45%">Please enter amount enclosed</td>
                                                        <td></td>
                                                    </tr> 

                                                     <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td width="45%" style="border:1px solid black; height:15px; font-size:17px;">$</td>
                                                        <td></td>
                                                    </tr>


                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td width="45%">write your name and account number on check and make payable to Sandlrent</td>
                                                        <td></td>
                                                    </tr> 
                                                </table>
                                                </td>
                                            </tr>';

                            $content .= '</table>';
                            // end f-sec-2===========> 
                           // END FOOTER SECTION ==+++++++++++++++++++=======================>

                            // define footer variable 
                            $obj_pdf->writeHTML($content); 
                            ob_clean(); 

                            $obj_pdf->Output($attach_file_name, 'F');

                            // sent email to the customer========================>

                            $email = \Config\Services::email();
                            $email->setFrom('info@wartiz.com', 'Roshan Energy');
                            $email->setTo($customer_data1['email']);

                            
                            $template = '<div style="background-color: #eeeeef; padding: 50px 0;"><div style="max-width:640px; margin:0 auto;"><div style="color: #fff; text-align: center; background-color:#110d35!important; padding: 15px; border-top-left-radius: 3px; border-top-right-radius: 3px; margin: 0;"><img style="width: 308px; height:130px; border-radius: 24px;" src="'.base_url().'/assets/img/logos/logo.jpeg"></div><div style="padding: 20px; background-color: rgb(255, 255, 255); color:#555;"><h1 style="text-align: center; font-family: monospace;">GENERATE BILL STATEMENT</h1><br><h2 style="font-family: monospace;">Hello &nbsp;'.$customer_data1['resident_name']. '&nbsp; Your Account Summary Is:</h2><div style = width:"100%; font-family: monospace;"><span style="font-family: monospace;"><b>Account Number</b></span><span style="float:right; font-family: monospace;">'.$customer_data1['account_number'].'</span></div><br><div style = width:"100%;"><span style = "font-family: monospace;"><b>SERVICE FOR</b></span><span style="float:right; font-family: monospace;">'.$customer_data1['resident_name'].' , '.$customer_data1['unit'].'  ('.$customer_data1['unit_id'].')'.$customer_data1['street_address'].' ,  '.$customer_data1['city'].'</span></div><br><div style = width:"100%; font-family: monospace;"><span style = "font-family: monospace;"><b>Billing Period</b></span><span style="float:right; font-family: monospace;">'.$start_date.' to '.$end_date.' </span></div><br><div style = "width: 100%; font-family: monospace;"><span><b>Electric Charges</b></span><span style="float:right;">$'.number_format($total_electric_charge_this_month,2).'</span></div><br><div style = "width: 100%; font-family: monospace;"><span><b>Water Charges</b></span><span style="float:right;">$'.$total_water_and_sewage_charges_this_month.'</span></div><br><div style = "width: 100%; font-family: monospace; font-size: 15px"><span><b>Total Amount</b></span><span style="float:right;"><b>$'.$amount_due.'</b></span></div><br><p style="font-size: 14px; font-family: monospace;"><b>Thank you - <br>Roshan Energy</b></p></div></div></div>';

                            $email->setSubject('Email Test');
                            $email->setMessage($template);

                            $email->attach($attach_file_name, 'F');

                            $email->send();

                            //end section sent email to the customer========================>


                        }
                    }
                    // end nameoffle bracket close

                          $session->setFlashdata('success', 'success');
                    }
                        else
                        {
                           $session->setFlashdata('error', 'error'); 
                        }
                }
                //end if cus-id! = 0 bracket close 

                    // success message when we insert the data--->

                    $path = site_url().'generate-statements';
                    return redirect()->to($path);
                }
               // if isset gen statement bracket close===>

               //end when we click on generate button then generate statememt in the table====>
                else
                {
                    $model = new CustomersModel();
                    // find all data from the customer table=======>
                    $customerData = $model->select('*')->findAll();
                    $data['customerData'] = $customerData;
                    // end find all data from the customer table====>

                    // fetch data from database store in the table======>
                    $model1 = new GenerateStatementModel();
                    $statement_record = $model1->select('*')->findAll();
                    $data['statement_record'] = $statement_record;

                    $data['content'] = 'Statements/generate_statements';
                    return view('template_with_header/template', $data);
                }
                 $session->setFlashdata('error', 'error');
            }
                //end if section session id exist bracket close====>
                else
                {
                  $path = site_url();
                  return redirect()->to($path);
                }
        }
        // public gen statement bracket close===>
//end generate-statement section======================================>

    public function statements_view()
   {

      $session = session();

      $sessionId = $session->get('id');
      // if sessions exists then only open this page otherwise redirect to login page 
      if(isset($sessionId))
      {
         $data['content']  = 'Statements/statements_view';
         return view('template/template' , $data);
      }
      else
      {
         $path  = site_url();
         return redirect()->to($path); 
      }
   }
    
    // utility statement section============>

    public function utility_statements()
   {

        // add current date=======>
        $current_date = date('Y-m-d H:i:s');

        $stringdate = preg_replace('/\s+/', '', $current_date);

        $session = session();
        $sessionId = $session->get('id');
        // if sessions exists then only open this page otherwise redirect to login page 
        if(isset($sessionId))
        {  
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

            //end find data from the water and electricity calculation table=======>

            $combinedArrayValue = array();
            if(isset($_POST['master_sheet']))
            {   
                // // get months from the form 
                $select_month = $this->request->getVar('select_months');
                
                // // numeric month to alphabet month=====>
                // $month_name = date("F", mktime(0, 0, 0, $select_month, 10));


                // // get years from the form 
                $select_years = $this->request->getVar('select_years');

                
                // if select month and select year is empty then show error========>
                if(($select_month == 'select') && ($select_years == 'select'))
                {
                    $session->setFlashdata('error', 'error');
                    
                    // redirect here 
                    $path = site_url().'utility-statements';
                    return redirect()->to($path); 
                }
                else
                {
                    // get months from the form 
                    $select_month = $this->request->getVar('select_months');
                    
                    // numeric month to alphabet month=====>
                    $month_name = date("F", mktime(0, 0, 0, $select_month, 10));


                    // get years from the form 
                    $select_years = $this->request->getVar('select_years');
                
                }



                // end select month and select year is empty then show error========>

                // GET CUSTOMERS DATA FROM CUSTOMER TABLE 
                $cusmodel = new CustomersModel();
                $cusmodel_findAllData = $cusmodel->findAll();

                foreach ($cusmodel_findAllData as $key => $value1) 
                {

                    $cusmodel_data[$value1['account_number']] = array
                    (
                        'account_number' => $value1['account_number'],
                        'first_name'     => $value1['first_name'],
                        'street_address' => $value1['street_address'],
                        'unit'           => $value1['unit'],
                        'unit_id'        => $value1['unit_id'],
                        'city'           => $value1['city'],
                        'state'          => $value1['state'],
                        'zip_code'       => $value1['zip_code'],
                        'resident_name'  => $value1['resident_name'],
                    );
                }
                //END CUSTOMERS DATA FROM CUSTOMER TABLE 

            
                // get data from w/e table==========>
                $this->db = \Config\Database::connect();

                $sql = "SELECT * FROM `water_and_electricity_calculation` WHERE `statement_start_date` LIKE '%$select_years%' AND `month_name_numeric` = '".$select_month."'";

                $query = $this->db->query($sql);
                $water_electricity_Alldata = $query->getResultArray();

                // echo "<pre>";
                // print_r($water_electricity_Alldata);
                // echo "</pre>";
                // die();

                if(empty($water_electricity_Alldata))
                {
                     $session->setFlashdata('error', 'error');
                    
                    // redirect here 
                    $path = site_url().'utility-statements';
                    return redirect()->to($path); 
                }

                foreach ($water_electricity_Alldata as $key1 => $value1) 
                {   
                    // get totalkwh reading=========>
                    $electric_reading = $value1['this_period_off_peak_kwh_reading']-$value1['this_period_on_peak_kwh_reading'];

                    $total_reading = $electric_reading.'/'.$value1['this_period_kgall_reading'];



                    $water_electricity_data[$value1['account_number']] = array
                    (  

                        'account_number'                    => $value1['account_number'],

                        'this_period_kgall_reading'         => $value1['this_period_kgall_reading'],

                        'total_amount_due'                  => $value1['total_amount_due'],

                        'month_name_numeric'                => $value1['month_name_numeric'],

                        'electric_reading'                  => $electric_reading,

                        'total_reading'                     => $total_reading,

                        'statement_start_date'              => $value1['statement_start_date'],

                        'statement_end_date'                => $value1['statement_end_date']
                    );
                }
             

                // get data from the generate statement table=============>

                // GET PDF LINK FROM STATEMENT TABLE ON THE BASIS OF ACCOUNT NUMBER AND MONTH NUMERIC 
                if(isset($water_electricity_data))
                {
                    $monthly_utility_statements_model =  new MonthlyUtilityStatementsModel();

                    // download excel file link===========>

                    $current_date = date('Y-m-d');

                    $download_excelfile = base_url().'/monthly_utility_bills/'.$select_month.'_'.$select_years.'_'.$stringdate.'.xlsx';
                   

                    // echo '<pre>';
                    // print_r($water_electricity_data);
                    // echo '</pre>';
                    // die();

                    // end download excel file link===========>
                    $count = 1;

                    $AllCusTotalAmount = 0;

                    foreach ($water_electricity_data as $water_electricity_dataKey => $water_electricity_dataValue) 
                    {
                        $sqlGetPdf = "SELECT * FROM generate_statement_datatable WHERE account_number ='".$water_electricity_dataValue['account_number']."' AND month_name_numeric = '".$water_electricity_dataValue['month_name_numeric']."'";

                        $queryGetPdf = $this->db->query($sqlGetPdf);
                        $PdfLinkData = $queryGetPdf->getResultArray();

                        // echo '<pre>';
                        // print_r($PdfLinkData);
                        // echo '</pre>';
                        // die();


                        if(isset($PdfLinkData[0]))
                        {
                            // find all cus total amount=====>
                            // $AllCusTotalAmount+= floatval(preg_replace('/[^\d. ]/', '', $water_electricity_dataValue['total_amount_due']));

                             $AllCusTotalAmount+= floatval(preg_replace('/[^\d. ]/', '', $water_electricity_dataValue['total_amount_due']));

                            $all_cus_totalAmt =  number_format($AllCusTotalAmount,2);
                          

                            //end find all cus total amount=====>

                            // count number of rows ==============>
                           $number_of_cusValue = $count ++;
                            // end sec count number of rows ==============>
                    

                            $combinedArrayValue = array
                            (

                                'month_name_numeric'           => $water_electricity_dataValue['month_name_numeric'],

                                'excel_file_link'              => $download_excelfile,

                                'select_month'                 => $month_name,

                                'select_year'                  => $select_years,

                                'current_date'                 => $current_date,

                                'total_number_of_customer'     => $number_of_cusValue,

                                'all_cus_total_amount'         => $all_cus_totalAmt,

                             );

                            // echo '<pre>';
                            // print_r($combinedArrayValue);
                            // echo '</pre>';
                            // die();

                        
                            $combinedArrayValue2[] = array
                            (

                                'customer_name'                => $cusmodel_data[$water_electricity_dataValue['account_number']]['resident_name'],

                                'customer_address'             => $cusmodel_data[$water_electricity_dataValue['account_number']]['street_address'],

                                'account_number'               => $water_electricity_dataValue['account_number'],

                                'this_period_kgall_reading'    => $water_electricity_dataValue['this_period_kgall_reading'],

                                'total_amount_due'             => $water_electricity_dataValue['total_amount_due'],

                                'month_name_numeric'           => $water_electricity_dataValue['month_name_numeric'],

                                'electric_reading'             => $water_electricity_dataValue['electric_reading'],

                                'statement_pdf_link'           => $PdfLinkData[0]['statement_pdf_download'],

                                'bill_number'                  => $PdfLinkData[0]['bill_number'],

                                'total_reading'                => $water_electricity_dataValue['total_reading'],

                                'excel_file_link'              => $download_excelfile,

                                'select_month'                 => $month_name,

                                'select_year'                  => $select_years,

                                'current_date'                 => $current_date,

                                'unit'                         => $cusmodel_data[$water_electricity_dataValue['account_number']]['unit'],

                                'unit_id'                      => $cusmodel_data[$value1['account_number']]['unit_id'],

                                'city'                         => $cusmodel_data[$value1['account_number']]['city'],

                                'state'                        => $cusmodel_data[$value1['account_number']]['state'],

                                'zip_code'                     => $cusmodel_data[$value1['account_number']]['zip_code'],

                                'total_number_of_customer'     => $number_of_cusValue,

                                'all_cus_total_amount'         => $all_cus_totalAmt
                             );


                        }
                    }

                    $monthly_utility_statements_model->insert($combinedArrayValue);

                }
                // echo '<pre>';
                // print_r($combinedArrayValue2);
                // echo '</pre>';
                // die();

                // excel sheet design==============================================>

                // get number of days in a month =============>
                $NumberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN,$select_month,$select_years);
                $current_date = date('F d, Y');


                // echo "start date 1-".$select_month."-".$select_years." ";
                // echo "end date ".$NumberOfDaysInMonth."-".$select_month."-".$select_years." ";


                      
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                // add background color=======>
                // $sheet->getStyle('B2:J50')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');

                // ser value header========>
                $sheet->setCellValue('E6',  'MASTERSHEET');
                $sheet->setCellValue('G4',  'Bill Date :');
                $sheet->setCellValue('H4',   $current_date);
                $sheet->setCellValue('G6',  'Billing Cycle :');
                $sheet->setCellValue('H6',  '1-'.$month_name.'-'.$select_years.'');
                $sheet->setCellValue('I6',  ''.$NumberOfDaysInMonth.'-'.$month_name.'-'.$select_years.'');
                // end value header========>


                // table heading===========>
                $sheet->setCellValue('C10',  'Item #');
                $sheet->setCellValue('D10',  'Bill to Address');
                $sheet->setCellValue('E10',  'Tenant Name');
                $sheet->setCellValue('F10',  'Kwh,Kgall');
                $sheet->setCellValue('G10',  'Amount');
                $sheet->setCellValue('H10',  'Bill Number');
                $sheet->setCellValue('I10',  'Link to Report');
                //end  table heading=======>

                // table cell width=======>
                $sheet->getColumnDimension('B')->setWidth(15);
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(20);
                $sheet->getColumnDimension('F')->setWidth(20);
                $sheet->getColumnDimension('G')->setWidth(20);
                $sheet->getColumnDimension('H')->setWidth(20);
                $sheet->getColumnDimension('I')->setWidth(20);
                $sheet->getColumnDimension('J')->setWidth(15);
                //end table cell width=======>

              
                // insert data in the excel sheet================>
                $cells_start = 11;
                if(isset($combinedArrayValue2))
                {
                   $i = 1;
                   foreach($combinedArrayValue2 as $key => $MonthlyData)
                   { 
                    // echo '<pre>';
                    // print_r($combinedArrayValue2);
                    // echo '</pre>';
                    // die();

                        $new_cells_inc = $cells_start++;



                        $sheet->setCellValue('C'.$new_cells_inc.'',  $i++);

                        // $sheet->setCellValue('D'.$new_cells_inc.'',  $MonthlyData['customer_address'].''.$MonthlyData['unit'].'-'.$MonthlyData['unit_id'].','.$MonthlyData['city'].','.$MonthlyData['zip_code']);

                         $sheet->setCellValue('D'.$new_cells_inc.'',  $MonthlyData['unit'].'-' .$MonthlyData['unit_id'].' '.$MonthlyData['customer_address'].', ' .$MonthlyData['city'].', '.$MonthlyData['zip_code'].' '.$MonthlyData['state']);


                        $sheet->setCellValue('E'.$new_cells_inc.'',  $MonthlyData['customer_name'].' - ' .$MonthlyData['unit'].' '.$MonthlyData['unit_id']);

                        $sheet->setCellValue('F'.$new_cells_inc.'',  $MonthlyData['total_reading']);
                        $sheet->setCellValue('G'.$new_cells_inc.'',  $MonthlyData['total_amount_due']);
                        $sheet->setCellValue('H'.$new_cells_inc.'',  $MonthlyData['bill_number']);
                        $sheet->setCellValue('I'.$new_cells_inc.'',  $MonthlyData['statement_pdf_link']); 

                        $spreadsheet->getActiveSheet()->getCell("I".$new_cells_inc)->getHyperlink()->setUrl($MonthlyData['statement_pdf_link']);

                         // border Array============>

                        $styleArray = array(
                        'borders' => array(
                            'allBorders' => array(
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => array('argb' => 'FF70AD47'),
                            ),),
                        );
                        $spreadsheet->getActiveSheet()->getStyle('C10:I10')->applyFromArray($styleArray);
                        $spreadsheet->getActiveSheet()->getStyle("C".($new_cells_inc).":I".($new_cells_inc))->applyFromArray($styleArray, False);

                        // end section border array========>

                         // alignment array =======>

                        $CenterArray = [

                                            'alignment'   => [
                                                               'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

                                                               'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,

                                                              ],
                                        ];
                        $spreadsheet->getActiveSheet()->getStyle("C".($new_cells_inc).":I".($new_cells_inc))->applyFromArray($CenterArray);
                     // end alignment array =======>

                        
                        // set height of cells=======>
                        $sheet->getRowDimension($new_cells_inc)->setRowHeight(70);
                        // set height of cells=======>

                        // add background color========>
                        $sheet->getStyle("B2:J".($new_cells_inc+10))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF7F');
                        // end section background color========>

                        // add bg color in cells row======>
                        if($new_cells_inc % 2 == 1) 
                            {
                                $spreadsheet->getActiveSheet()->getStyle('C' . $new_cells_inc . ':I' . $new_cells_inc)->applyFromArray(
                                    array(
                                        'fill' => array(
                                            'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                            'color' => array('argb' => 'FFE2EFDA')
                                        ),
                                    )
                                );
                            }
                            else 
                            {
                                $spreadsheet->getActiveSheet()->getStyle('C' . $new_cells_inc . ':I' . $new_cells_inc)->applyFromArray(
                                    array(
                                        'fill' => array(
                                            'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                            'color' => array('argb' => 'FFFFFFFF')
                                        ),
                                    )
                                );
                            }
                        // end sec bg color in cells row======>
                    } 
                } 

                // set warp text========>

                $spreadsheet->getActiveSheet()->getStyle('I')->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);

                // end sec wrap text==========>
                           
                // font size array ===========>
                $FontSizeArray = [
                                    'font'       => [
                                                       'size' => 11,
                                                    ],
                                 ];

                $spreadsheet->getActiveSheet()->getStyle('C10:I10')->applyFromArray($FontSizeArray);
                //end section font size array ===========>

                
                // alignment array =======>

                $AlignmentArray = [

                                    'alignment'   => [
                                                       'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                                      ],
                                   ];
                $spreadsheet->getActiveSheet()->getStyle('C11:I15')->applyFromArray($AlignmentArray);
                $spreadsheet->getActiveSheet()->getStyle('C10:I10')->applyFromArray($AlignmentArray);
                $spreadsheet->getActiveSheet()->getStyle('E6')->applyFromArray($AlignmentArray);

                 //end section alignment array =======>

                // bold arrray===========>

                $BoldArray = [
                                'font'  => [
                                               'bold' => true,
                                           ],
                            ];
                $spreadsheet->getActiveSheet()->getStyle('G')->applyFromArray($BoldArray);
                $spreadsheet->getActiveSheet()->getStyle('E6')->applyFromArray($BoldArray);
                $spreadsheet->getActiveSheet()->getStyle('C10:I10')->applyFromArray($BoldArray);

                //end section bold arrray===========>

                // add logo===========>
                $drawing = new Drawing();
                $drawing->setName('Paid');
                $drawing->setDescription('Paid');
                $drawing->setPath('logo.jpeg'); 
                $drawing->setCoordinates('C3');
                $drawing->setWorksheet($spreadsheet->getActiveSheet());
               
               // save file in the folder=======>
               $writer = new Xlsx($spreadsheet);
               // $writer->save('monthly_utility_bills/test_'.$test.'.xlsx');
               $writer->save('monthly_utility_bills/'.$select_month.'_'.$select_years.'_'.$stringdate.'.xlsx');


               $data['combinedArrayValue'] = $combinedArrayValue;
               $session->setFlashdata('success', 'success');
                
            }
            // end excel sheet design==============================================>
            else
            {
                $data['combinedArrayValue'] = $combinedArrayValue;
            }


            // fetch data==================================>
            $monthly_utility_statements_model =  new MonthlyUtilityStatementsModel();
            $data['table'] = $monthly_utility_statements_model->findAll();
            // fetch data==================================>

            
             $data['content']  = 'Statements/utility_statements';
             return view('template_with_header/template' , $data);
        }
           else
           {  
             $data['content']  = 'Statements/utility_statements';
             return view('template_with_header/template' , $data); 
           }
     }
   // end utility statement section======>

   // upload row data in the csv file===============================>

   public function upload_data()
   {
        $dataArray = array();
        if(isset($dataArray))
        {
            $session = session();

            if(($_FILES['file11']['name']))
             {
                    $fileNameVar = $_FILES['file11']['name'];

                    $explodeFileName = explode('.', $fileNameVar);

                    $extensionType= $explodeFileName[1];
             }
             else
             {
                $extensionType = '';
             }
            

        if(($_FILES['file11']['tmp_name']!= '') && ($extensionType))
        {  
            $fileName = $_FILES["file11"]["tmp_name"];
            $file = fopen($fileName, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $dataArray[] = $column;
        }
        // remvoe the zeroth key 
        unset($dataArray[0]);

            foreach ($dataArray as $key => $value) 
            {  
               $water_electricity_model = new WaterAndElectricityModel();
               $start_date11 = date("Y-m-d", strtotime($value['33']));
               $end_date11 = date("Y-m-d", strtotime($value['34']));

               $data = [
                         'statement_start_date'             => $start_date11,
                         'statement_end_date'               => $end_date11,
                         'month_name_numeric'               => $value['35'],
                         'this_period_on_peak_kwh_reading'  => $value['23'],
                         'this_period_off_peak_kwh_reading' => $value['22'],
                         'this_period_kgall_reading'        => $value['32'],
                         'past_due_amount'                  => $value['12'],
                       ];

                $update_data = array(
                                        'account_number'     => $value['0'],
                                        'month_name_numeric' => $value['35']
                                    );

               $water_electricity_model->set($data);
               $water_electricity_model->where($update_data);
               $result = $water_electricity_model->update();
            }
                $session->setFlashdata('success', 's');
                $path = site_url().'generate-statements';
                return redirect()->to($path); 
        }
            else
            {
                $session->setFlashdata('error', 'e');
                $path = site_url().'generate-statements';
                return redirect()->to($path);
           }
        }
    }
   // end upload row data in the csv file===============================>

    // delete generate statement======>

    public function delete_gen_statement()
    {
        $this->db = \Config\Database::connect();

        if ($this->request->isAJAX())
        {
            $hiddenCustomerID = $this->request->getVar('hiddenCustomerID');
            $sql = "SELECT * FROM generate_statement_datatable WHERE id ='".$hiddenCustomerID."'";
            $query = $this->db->query($sql);
            $getCustomersData = $query->getResultArray();
            $customerAccountNumber = $getCustomersData[0]['account_number'];

            $model = new GenerateStatementModel();
            $model->where('id', $hiddenCustomerID)->delete();

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
// end delete generate statement======>

    // delete utility statement=======>
    public function delete_utility_statement()
    {
       $this->db = \Config\Database::connect(); 
        if ($this->request->isAJAX())
        {
            $hiddenCustomerID = $this->request->getVar('hiddenCustomerID');
            $sql = "SELECT * FROM monthly_utility_statements WHERE id ='".$hiddenCustomerID."'";
            $query = $this->db->query($sql);
            $getCustomersData = $query->getResultArray();
            // $customerAccountNumber = $getCustomersData[0]['account_number'];
            

            $model = new MonthlyUtilityStatementsModel();
            $model->where('id', $hiddenCustomerID)->delete();

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
    // end delete utility statement=======>

}
// main class bracket close===>

  
    
