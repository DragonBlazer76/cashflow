<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */

namespace App\Controllers;

use App\Core\Controller;

use Config, View, DB, Auth, Response, Redirect, Mailer, Hash, Input;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Invoice extends Controller
{
    protected $template = 'Smarty'; 
    protected $layout = 'default';
    
    public $country = array(
            'AF' => 'Afghanistan',
            'AX' => 'Aland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BQ' => 'Bonaire, Saint Eustatius and Saba',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'VG' => 'British Virgin Islands',
            'BN' => 'Brunei',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CW' => 'Curacao',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'CD' => 'Democratic Republic of the Congo',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'TL' => 'East Timor',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and McDonald Islands',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'CI' => 'Ivory Coast',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'XK' => 'Kosovo',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Laos',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'KP' => 'North Korea',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'CG' => 'Republic of the Congo',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russia',
            'RW' => 'Rwanda',
            'BL' => 'Saint Barthelemy',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'MF' => 'Saint Martin',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and the Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SX' => 'Sint Maarten',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and the South Sandwich Islands',
            'KR' => 'South Korea',
            'SS' => 'South Sudan',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syria',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'VI' => 'U.S. Virgin Islands',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatican',
            'VE' => 'Venezuela',
            'VN' => 'Vietnam',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
        );
    
    
//    private function getCountryCode($countrycode) {
//        return $his->country[$countrycode];
//    }
    
    private function getStatus ($statuscode) {
        $status = array (
            "0" => "New",
            "1" => "In Bid",
            "2" => "Completed",
            "3" => "Rejected"
        );
        
        return $status[$statuscode];
    }
    
    private function getStatusCode ($statuscode) {
        $status = array (
            "New" => "0",
            "In Bid" => "1",
            "Completed" => "2",
            "Rejected" => "3"
        );
        
        return $status[$statuscode];
    } 
    
    public function createinvoice1()
    {

        $main_nav = 'Invoice';
        $sub_nav = 'New';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $supp_name = "";
        $supp_addr1 = "";
        $supp_addr2 = "";
        $supp_state = "";
        $supp_postal = "";
        $country_list = "";
        $supp_email = "";
        $supp_phone1 = "";
        $supp_phone2 = "";
        $inv_no = "";
        $po_no = "";
        $do_no = "";
        $inv_date = "";
        $credit_terms = "";
        $inv_doc = "optional";
        $inv_po = "optional";
        $inv_do = "optional";
        
        if (Input::has('inv_id')) {
            $inv = DB::table('invoice')
                ->join('invoice_supp', 'invoice.invoice_id', '=', 'invoice_supp.invoice_id')
                ->where('invoice.invoice_id', Input::get('inv_id', ''))
                ->where('invoice.user_id', Auth::user()->id)->first();
            
            $supp_name = $inv->supplier_name;
            $supp_addr1 = $inv->supplier_addr1;
            $supp_addr2 = $inv->supplier_addr2;
            $supp_state = $inv->supplier_state;
            $supp_postal = $inv->supplier_postal;
            $supp_email = $inv->supplier_email;
            $supp_phone1 = $inv->supplier_phone1;
            $supp_phone2 = $inv->supplier_phone2;
            $inv_no = $inv->invoice_no;
            $po_no = $inv->po_no;
            $do_no = $inv->do_no;
            $inv_date = date_create($inv->invoice_date);
            $inv_date = date_format($inv_date, "Y-m-d");
            $credit_terms = $inv->credit_terms;

            foreach ($this->country as $code => $name) {
                $country_list .= '<option value="' . $code . '" ' . ($inv->supplier_country_code == $code ? 'selected="selected"' : null) . '>' . $name . '</option>';
            }
            
            $inv_file = DB::table('invoice_doc')
                ->where('invoice_id', Input::get('inv_id', ''))->first();
            
            if (!empty($inv_file->inv_doc_file_size)) {
                $doc_temp = pathinfo($inv_file->inv_doc_file_path);
                $inv_doc = $doc_temp['basename']. ' (' .$inv_file->inv_doc_file_size.' bytes)';
            }
            
            if (!empty($inv_file->po_doc_file_size)) {
                $doc_temp = pathinfo($inv_file->po_doc_file_path);
                $inv_po = $doc_temp['basename']. ' (' .$inv_file->po_doc_file_size.' bytes)';
            }
            
            if (!empty($inv_file->do_doc_file_size)) {
                $doc_temp = pathinfo($inv_file->do_doc_file_path);
                $inv_do = $doc_temp['basename']. ' (' .$inv_file->do_doc_file_size.' bytes)';
            }
        }
        else {
            foreach ($this->country as $code => $name) {
                $country_list .= '<option value="' . $code . '">' . $name . '</option>';
            }
        }
        
        $prefix = DB::getTablePrefix();
        $suppliers = DB::select("SELECT * FROM {$prefix}suppliers S
                            inner join {$prefix}supplier_user_view V on V.supplier_id = S.supplier_id
                            WHERE V.user_id = ".Auth::user()->id);
        
        $ret_val = '';
        foreach($suppliers as $option) {
            $opt_selected = "";
            
            if (Input::has('inv_id')) {
                if ($inv->supplier_id == $option->supplier_id) {
                    $opt_selected = "selected";
                }
            }

            $ret_val .= "<option value=\"$option->supplier_id\" $opt_selected>$option->supplier_name</option>";
        }
        

        return View::make('Invoice/CreateInvoice1')
            ->shares('title', __('New Invoice'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->with('ret_val', $ret_val)
            ->with('supp_name', $supp_name)
            ->with('supp_addr1', $supp_addr1)
            ->with('supp_addr2', $supp_addr2)
            ->with('supp_state', $supp_state)
            ->with('supp_postal', $supp_postal)
            ->with('country_list', $country_list)
            ->with('supp_email', $supp_email)
            ->with('supp_phone1', $supp_phone1)
            ->with('supp_phone2', $supp_phone2)
            ->with('inv_no', $inv_no)
            ->with('po_no', $po_no)
            ->with('do_no', $do_no)
            ->with('inv_date', $inv_date)
            ->with('credit_terms', $credit_terms)
            ->with('inv_doc', $inv_doc)
            ->with('inv_po', $inv_po)
            ->with('inv_do', $inv_do);
    }
    
    public function createinvoice2()
    {

        $main_nav = 'Invoice';
        $sub_nav = 'New';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        


        return View::make('Invoice/CreateInvoice2')
            ->shares('title', __('New Invoice'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav);
    }
    
    
    public function createinvoice3()
    {

        $main_nav = 'Invoice';
        $sub_nav = 'New';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        
        $inv = DB::table('invoice')
                ->join('invoice_supp', 'invoice.invoice_id', '=', 'invoice_supp.invoice_id')
                ->where('invoice.invoice_id', Input::get('inv_id', ''))
                ->where('invoice.user_id', Auth::user()->id)->first();
         
        $inv_date = date_create($inv->invoice_date);
        $exp_date = date('Y-m-d', strtotime($inv->invoice_date. ' + '. $inv->credit_terms .' days'));
        $exp_date = date_create($exp_date);
        
        $inv_details = DB::table('invoice_items')->where('invoice_id', Input::get('inv_id', ''))->get();
        $detail_html = '';
        
        foreach ($inv_details as $detail)  {
            $detail_html .= '<tr>';
            $detail_html .= '    <td>';
            $detail_html .= '        <div><strong>'. $detail->item_name .'</strong></div>';
            $detail_html .= '        <small><br></small>';
            $detail_html .= '    </td>';
            $detail_html .= '    <td>'. $detail->item_qty .'</td>';
            $detail_html .= '    <td>$ '. $detail->item_unit_price .'</td>';
            $detail_html .= '    <td>$ '. $detail->item_total_price .'</td>';
            $detail_html .= '</tr>';
        }

        return View::make('Invoice/CreateInvoice3')
            ->shares('title', __('New Invoice'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->shares('supplier_name', $inv->supplier_name)
            ->shares('supplier_addr1', $inv->supplier_addr1)
            ->shares('supplier_addr2', $inv->supplier_addr2)
            ->shares('supplier_state', $inv->supplier_state)
            ->shares('supplier_postal', $inv->supplier_postal)
            ->shares('supplier_country', $this->country[$inv->supplier_country_code])
            ->shares('supplier_phone1', $inv->supplier_phone1)
            ->shares('supplier_phone2', $inv->supplier_phone2)
            ->shares('supplier_email', $inv->supplier_email)
            ->shares('invoice_no', $inv->invoice_no)
            ->shares('po_no', $inv->po_no)
            ->shares('do_no', $inv->do_no)
            ->shares('invoice_date', date_format($inv_date, 'd M Y'))
            ->shares('credit_terms', $inv->credit_terms)
            ->shares('exp_date', date_format($exp_date, 'd M Y'))
            ->shares('detail_html', $detail_html)
            ->shares('grand_total', $inv->grand_total);
    }
    
    public function getsupplierdetails() {
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $supplier_id = '';
        $data = array();
        
        if (Input::has('supp_id')) {
            $supplier_id = Input::get('supp_id');
        }
        
        
        $supplier = DB::table('suppliers')
//                        ->join('supplier_tax', 'suppliers.supplier_tax_id', '=', 'supplier_tax.tax_id')
                        ->where('supplier_id', $supplier_id)->first();
        
        $data = $supplier;
        return Response::make(json_encode($data));       
        
    }
    
    public function getsearchsuppdata() {
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $data = array();
        
        $searchid = '';
        if (Input::has('searchid')) {
            $searchid = Input::get('searchid');
        }
        
        
        $prefix = DB::getTablePrefix();
        $suppliers = DB::select("SELECT DISTINCT s.supplier_id, s.supplier_name FROM {$prefix}suppliers s
                                inner join {$prefix}users u on s.supplier_id = u.supplier_id
                                where supplier_name like '%".$searchid."%'
                                and supplier_name <> 
                                (SELECT DISTINCT s.supplier_name FROM {$prefix}suppliers s
                                 inner join {$prefix}users u on s.supplier_id = u.supplier_id
                                 where u.id = ". Auth::user()->id .")");
        $i = 0;
        foreach ($suppliers as $supplier) {
//            $data['id'][$i] = $supplier->supplier_id;
//            $data['name'][$i] = $supplier->supplier_name;
            //$data[$i] = array($supplier->supplier_id, $supplier->supplier_name);
            $data[$i] = array('value' => $supplier->supplier_id,
                            'label' =>  $supplier->supplier_name);   
            $i++;
        }
        
        return Response::make(json_encode($data));  
    }
    
    public function gettaxdetails() {
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $tax_id = '';
        $data = array();
        
        if (Input::has('tax_id')) {
            $tax_id = Input::get('tax_id');
        }
        
        
        $tax = DB::table('supplier_tax')
                        ->where('tax_id', $tax_id)->first();
        
        $data = $tax;
        return Response::make(json_encode($data));       
        
    }
    
    public function saveinvoice1() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
//        if (empty($_POST['sel_supplier'])) {
//            $errors['desc'] = 'Please select a supplier!';
//            $data['success'] = false;
//            $data['errors']  = $errors;
//            return Response::make(json_encode($data));
//            exit;
//        }
        
        if (empty($_POST['supp_addr1'])) {
            $errors['desc'] = 'Please enter address 1!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['supp_postal'])) {
            $errors['desc'] = 'Please enter the postal code!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['supp_country'])) {
            $errors['desc'] = 'Please select a country!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['email'])) {
            $errors['desc'] = 'Please enter the email!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['supp_phone1'])) {
            $errors['desc'] = 'Please enter the phone number!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }

        
        if (empty($_POST['invoice_no'])) {
            $errors['desc'] = 'Please enter the invoice number!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['po_no'])) {
            $errors['desc'] = 'Please enter the PO number!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['inv_date'])) {
            $errors['desc'] = 'Please enter the PO number!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        
        
        $date_now = date("Y-m-d"); 
        if ($_POST['inv_date'] > $date_now) {
            $errors['desc'] = 'Invoice date cannnot be later than today!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        
        
        $id = 0;
        
        if (Input::has('opr')) {
            if (Input::get('opr', '') == "2") {
                $id = Input::get('inv_id', '');
                
                DB::table('invoice')->where('invoice_id', $id)
                    ->update(array(
                          'po_no' => $_POST['po_no'],
                          'do_no' => Input::get('do_no', ''),
                          'invoice_date' => $_POST['inv_date'],
//                          'supplier_id' => $_POST['sel_supplier'],
                          'credit_terms' => Input::get('credit_terms', '')
                    ));
            }
        }
        else {
            $id = DB::table('invoice')->insertGetId(
                array('invoice_no' => $_POST['invoice_no'], 
                      'po_no' => $_POST['po_no'],
                      'do_no' => Input::get('do_no', ''),
                      'invoice_date' => $_POST['inv_date'],
//                      'supplier_id' => $_POST['sel_supplier'],
                      'credit_terms' => Input::get('credit_terms', ''),
                      'user_id' => Auth::user()->id
                     )
            );
        }
        
        if ($id == 0) {
            $errors['desc'] = 'Error in inserting tables. Please contact the administrator.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        
        if (!Input::has('supp_id')) {
            $email = Input::get('email', '');
            $domain = substr($email, strpos($email, '@')+1, strlen($email));
            
            DB::table('suppliers')->insert(
                        array(
                               'supplier_name' => Input::get('supp_name', ''),
                               'supplier_addr1' => Input::get('supp_addr1', ''),
                               'supplier_addr2' => Input::get('supp_addr2', ''),
                               'supplier_state' => Input::get('supp_state', ''),
                               'supplier_postal' => Input::get('supp_postal', ''),
                               'supplier_country_code' => Input::get('supp_country', ''),
                               'supplier_phone1' => Input::get('supp_phone1', ''),
                               'supplier_phone2' => Input::get('supp_phone2', ''),
                               'supplier_email' => Input::get('email', ''),
                               'supplier_credit_terms' => Input::get('credit_terms', ''),
                               'url' => $domain
                              ));
        }
        
        //insert or update the suppliers details for this invoice
        if (Input::has('opr')) {
            if (Input::get('opr', '') == "2") {
                $id = Input::get('inv_id', '');
                
                DB::table('invoice_supp')->where('invoice_id', $id)
                    ->update(
                        array(
                               'supplier_addr1' => Input::get('supp_addr1', ''),
                               'supplier_addr2' => Input::get('supp_addr2', ''),
                               'supplier_state' => Input::get('supp_state', ''),
                               'supplier_postal' => Input::get('supp_postal', ''),
                               'supplier_country_code' => Input::get('supp_country', ''),
                               'supplier_phone1' => Input::get('supp_phone1', ''),
                               'supplier_phone2' => Input::get('supp_phone2', ''),
                               'supplier_email' => Input::get('email', ''),
                              ));
            }
        }
        else {
        
            //insert the suppliers details for this invoice
            DB::table('invoice_supp')->insert(
                        array(
                               'invoice_id' => $id,
                               'supplier_name' => Input::get('supp_name', ''),
                               'supplier_addr1' => Input::get('supp_addr1', ''),
                               'supplier_addr2' => Input::get('supp_addr2', ''),
                               'supplier_state' => Input::get('supp_state', ''),
                               'supplier_postal' => Input::get('supp_postal', ''),
                               'supplier_country_code' => Input::get('supp_country', ''),
                               'supplier_phone1' => Input::get('supp_phone1', ''),
                               'supplier_phone2' => Input::get('supp_phone2', ''),
                               'supplier_email' => Input::get('email', ''),
                              ));
        }
        
        $has_file = false;
        $destinationPath = APPDIR .'Storage/Files/upload/'.Auth::user()->id.'/';
        $inv_filename = null;
        $inv_filesize = null;
        $inv_filetype = null;
        $po_filename = null;
        $po_filesize = null;
        $po_filetype = null;
        $do_filename = null;
        $do_filesize = null;
        $do_filetype = null;
        
        if (Input::hasFile('inv_file_data')) {
            if (Input::file('inv_file_data')->isValid()) {
                
                $has_file = true;
                $inv_filename = Input::file('inv_file_data')->getClientOriginalName();
                $inv_filesize = Input::file('inv_file_data')->getSize();
                $inv_filetype = Input::file('inv_file_data')->getMimeType();
                Input::file('inv_file_data')->move($destinationPath, $inv_filename);
                
            }
        }        
        
        if (Input::hasFile('po_file_data')) {
            if (Input::file('po_file_data')->isValid()) {
                
                $has_file = true;
                $po_filename = Input::file('po_file_data')->getClientOriginalName();
                $po_filesize = Input::file('po_file_data')->getSize();
                $po_filetype = Input::file('po_file_data')->getMimeType();
                Input::file('po_file_data')->move($destinationPath, $po_filename);
                
            }
        }
        
        if (Input::hasFile('do_file_data')) {
            if (Input::file('do_file_data')->isValid()) {
                
                $has_file = true;
                $do_filename = Input::file('do_file_data')->getClientOriginalName();
                $do_filesize = Input::file('do_file_data')->getSize();
                $do_filetype = Input::file('do_file_data')->getMimeType();
                Input::file('do_file_data')->move($destinationPath, $do_filename);
                
            }
        }
        
        if ($has_file) {
            if (Input::has('opr')) {
                if (Input::get('opr', '') == "2") {
                    $id = Input::get('inv_id', '');

                    DB::table('invoice_doc')->where('invoice_id', $id)
                        ->update(
                            array('invoice_id' => $id,
                                  'inv_doc_file_path' => $destinationPath.$inv_filename,
                                  'inv_doc_file_type' => $inv_filetype,
                                  'inv_doc_file_size' => $inv_filesize,
                                  'po_doc_file_path' => $destinationPath.$po_filename,
                                  'po_doc_file_type' => $po_filetype,
                                  'po_doc_file_size' => $po_filesize,
                                  'do_doc_file_path' => $destinationPath.$do_filename,
                                  'do_doc_file_type' => $do_filetype,
                                  'do_doc_file_size' => $do_filesize
                         )
                    );
                }
            }
            else {
                DB::table('invoice_doc')->insert(
                    array('invoice_id' => $id,
                          'inv_doc_file_path' => $destinationPath.$inv_filename,
                          'inv_doc_file_type' => $inv_filetype,
                          'inv_doc_file_size' => $inv_filesize,
                          'po_doc_file_path' => $destinationPath.$po_filename,
                          'po_doc_file_type' => $po_filetype,
                          'po_doc_file_size' => $po_filesize,
                          'do_doc_file_path' => $destinationPath.$do_filename,
                          'do_doc_file_type' => $do_filetype,
                          'do_doc_file_size' => $do_filesize
                         )
                );
            }
        }
         
        
        $data['success'] = true;
        $data['id'] = $id;
        return Response::make(json_encode($data));
    }
    
    public function getinvoicedetails() {
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        
        $page = $_GET['page']; // get the requested page
        $limit = $_GET['rows']; // get how many rows we want to have into the grid
        $sidx = $_GET['sidx']; // get index row - i.e. user click to sort
        $sord = $_GET['sord']; // get the direction
        $inv_id = Input::get('inv_id', '0');
        
        if(!$sidx) $sidx =1;
        
        $count = DB::table('invoice_items')->where('invoice_id', $inv_id)->count();

        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages) $page=$total_pages;
        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
        
        
        $users = DB::table('invoice_items')
                    ->join('invoice', 'invoice.invoice_id', '=', 'invoice_items.invoice_id')
                    ->where('invoice_items.invoice_id', $inv_id)
                    ->where('invoice.user_id', Auth::user()->id)
                    ->orderBy('invoice_items.'.$sidx, $sord)->skip($start)->take($limit)->get();

        $response['total'] = $total_pages;
        $response['page'] = $page;
        $response['records'] = $count;
        $i = 0;
        $item_total_price = 0;
        
        foreach ($users as $user)  {
            $rows[$i]['id'] = $user->invoice_item_id;
            $rows[$i]['cell'] =array($user->invoice_item_id, $user->invoice_id, $user->item_name,
                                     $user->item_qty, $user->item_unit_price, $user->item_total_price);
            $response['rows'] = $rows;
            
            $item_total_price += $user->item_total_price;
            $i++;
        } 
        
        $userdata = array();
        $userdata['item_total_price'] = $item_total_price;
        $userdata['item_unit_price'] = 'Invoice Totals:';
        $response['userdata'] = $userdata;
            
        echo json_encode($response);
    }
    
    public function updateinvitems() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        if (empty($_POST['item_name'])) {
            $errors['desc'] = 'Please enter the item name!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['item_qty'])) {
            $errors['desc'] = 'Please enter the item quantity!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['item_unit_price'])) {
            $errors['desc'] = 'Please enter the item unit price!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['item_total_price'])) {
            $errors['desc'] = 'Please enter the item total price!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        $invoice_item_id = $_POST['id'];

        
        
        if ($_POST['oper'] == 'add') {
            $inv_id = $_POST['invoice_id'];
            
            $item_name = $_POST['item_name'];
            $item_qty = $_POST['item_qty'];
            $item_unit_price = $_POST['item_unit_price'];
            $item_total_price = $_POST['item_total_price'];
            DB::table('invoice_items')->insert(array(
                               'invoice_id' => $inv_id,
                               'item_name' => $item_name,
                               'item_qty' => $item_qty,
                               'item_unit_price' => $item_unit_price, 
                               'item_total_price' => $item_total_price
                ));
            
            //update the total price of invoice in invoice table
            $total = DB::table('invoice_items')->where('invoice_id', $inv_id)->sum('item_total_price');
            DB::table('invoice')->where('invoice_id', $inv_id)
                ->update(array(
                               'grand_total' => $total
                ));            
                
        }
        else if($_POST['oper'] == 'edit') {
            $item_name = $_POST['item_name'];
            $item_qty = $_POST['item_qty'];
            $item_unit_price = $_POST['item_unit_price'];
            $item_total_price = $_POST['item_total_price'];
            DB::table('invoice_items')->where('invoice_item_id', $invoice_item_id)
                ->update(array(
                               'item_name' => $item_name,
                               'item_qty' => $item_qty,
                               'item_unit_price' => $item_unit_price, 
                               'item_total_price' => $item_total_price
                ));
            //update the total price of invoice in invoice table
            $total = DB::table('invoice_items')->where('invoice_id', $_POST['invoice_id'])->sum('item_total_price');
            DB::table('invoice')->where('invoice_id', $_POST['invoice_id'])
                ->update(array(
                               'grand_total' => $total
                ));    
            
        }
        else if($_POST['oper'] == 'del') {

            DB::table('invoice_items')->where('invoice_item_id', '=', $invoice_item_id)->delete();
        }
        
    }
    
    public function deleteinvitems() {
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $invoice_item_id = $_POST['id'];
        $inv = DB::table('invoice_items')->where('invoice_item_id', '=', $invoice_item_id)->first();
        $inv_id = $inv->invoice_id;
        
        DB::table('invoice_items')->where('invoice_item_id', '=', $invoice_item_id)->delete();
        
        //update the total price of invoice in invoice table
        $total = DB::table('invoice_items')->where('invoice_id', $inv_id)->sum('item_total_price');
        DB::table('invoice')->where('invoice_id', $inv_id)
            ->update(array(
                           'grand_total' => $total
            )); 
    }
    
   public function deleteinvoice() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
       
        if (empty($_POST['inv_id'])) {
            if (empty($_POST['opr'])) {
                $data['success'] = true;
                return Response::make(json_encode($data));
            }
            $errors['desc'] = 'Something went wrong! Please contact the administrator';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        DB::table('invoice_doc')->where('invoice_id', '=', Input::get('inv_id', ''))->delete();
        DB::table('invoice_items')->where('invoice_id', '=', Input::get('inv_id', ''))->delete();
        DB::table('invoice_supp')->where('invoice_id', '=', Input::get('inv_id', ''))->delete();
        DB::table('invoice')->where('invoice_id', '=', Input::get('inv_id', ''))->delete();
       
        $data['success'] = true;
        return Response::make(json_encode($data));
   }
    
    public function listinvoice() {

        $main_nav = 'Invoice';
        $sub_nav = 'List';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        
//        $inv = DB::table('invoice')
//                ->join('suppliers', 'invoice.supplier_id', '=', 'suppliers.supplier_id')
//                ->where('invoice_id', Input::get('inv_id', ''))
//                ->where('user_id', Auth::user()->id)->first();
//         
//        $inv_date = date_create($inv->invoice_date);
//        $exp_date = date('Y-m-d', strtotime($inv->invoice_date. ' + '. $inv->credit_terms .' days'));
//        $exp_date = date_create($exp_date);
//        
//        $inv_details = DB::table('invoice_items')->where('invoice_id', Input::get('inv_id', ''))->get();
//        $detail_html = '';
//        
//        foreach ($inv_details as $detail)  {
//            $detail_html .= '<tr>';
//            $detail_html .= '    <td>';
//            $detail_html .= '        <div><strong>'. $detail->item_name .'</strong></div>';
//            $detail_html .= '        <small><br></small>';
//            $detail_html .= '    </td>';
//            $detail_html .= '    <td>'. $detail->item_qty .'</td>';
//            $detail_html .= '    <td>$ '. $detail->item_unit_price .'</td>';
//            $detail_html .= '    <td>$ '. $detail->item_total_price .'</td>';
//            $detail_html .= '</tr>';
//        }

        return View::make('Invoice/ListInvoice')
            ->shares('title', __('List Invoice'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav);
//            ->shares('supplier_name', $inv->supplier_name)
//            ->shares('supplier_addr1', $inv->supplier_addr1)
//            ->shares('supplier_addr2', $inv->supplier_addr2)
//            ->shares('supplier_state', $inv->supplier_state)
//            ->shares('supplier_postal', $inv->supplier_postal)
//            ->shares('supplier_country', $this->country[$inv->supplier_country_code])
//            ->shares('supplier_phone1', $inv->supplier_phone1)
//            ->shares('supplier_phone2', $inv->supplier_phone2)
//            ->shares('supplier_email', $inv->supplier_email)
//            ->shares('invoice_no', $inv->invoice_no)
//            ->shares('po_no', $inv->po_no)
//            ->shares('do_no', $inv->do_no)
//            ->shares('invoice_date', date_format($inv_date, 'd M Y'))
//            ->shares('credit_terms', $inv->credit_terms)
//            ->shares('exp_date', date_format($exp_date, 'd M Y'))
//            ->shares('detail_html', $detail_html)
//            ->shares('grand_total', $inv->grand_total);
    }
    
    //Listing the invoice data table
    public function getinvoicelisttble() {
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        $response = array();
        
        
        $invoices = DB::table('invoice')
                    ->join('invoice_supp', 'invoice_supp.invoice_id', '=', 'invoice.invoice_id')
                    ->where('invoice.user_id', Auth::user()->id)->get();
        $i = 0;

        
        foreach ($invoices as $invoice)  {
            $inv_date = date_create($invoice->invoice_date);
            $exp_date = date('Y-m-d', strtotime($invoice->invoice_date. ' + '. $invoice->credit_terms .' days'));
            $exp_date = date_create($exp_date);
            $c1['invoice_id'] = $invoice->invoice_id;
            $c1['status'] = $this->getStatus($invoice->status);
            
            $row[$i] =array("invoice_no" => $invoice->invoice_no, 
                            "invoice_date" => date_format($inv_date, 'Y-m-d'), 
                            "expiry_date" => date_format($exp_date, 'Y-m-d'), 
                            "credit_terms" => $invoice->credit_terms, 
                            "grand_total" => $invoice->grand_total,
                            "invoice_id" => $invoice->invoice_id,
                            "status" => $c1,
                            "supplier_name" => $invoice->supplier_name
                           );
            $response['data'] = $row;
            $i++;
        } 
        
            
        echo json_encode($response);
    }
    
//--------------------------------------------------For Edit ------------------------------------------------------>
    //Create View for Edit Invoice Step 1
    public function editinvoice1()
    {

        $main_nav = 'Invoice';
        $sub_nav = 'Edit';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $supp_id = "";
        $supp_name = "";
        $supp_addr1 = "";
        $supp_addr2 = "";
        $supp_state = "";
        $supp_postal = "";
        $country_list = "";
        $supp_email = "";
        $supp_phone1 = "";
        $supp_phone2 = "";
        $inv_no = "";
        $po_no = "";
        $do_no = "";
        $inv_date = "";
        $credit_terms = "";
        $inv_doc = "optional";
        $inv_po = "optional";
        $inv_do = "optional";
        
        if (Input::has('inv_id')) {
            $inv = DB::table('invoice')
                ->join('invoice_supp', 'invoice.invoice_id', '=', 'invoice_supp.invoice_id')
                ->where('invoice.invoice_id', Input::get('inv_id', ''))
                ->where('invoice.user_id', Auth::user()->id)->first();
            
            $supp_id = $inv->id;
            $supp_name = $inv->supplier_name;
            $supp_addr1 = $inv->supplier_addr1;
            $supp_addr2 = $inv->supplier_addr2;
            $supp_state = $inv->supplier_state;
            $supp_postal = $inv->supplier_postal;
            $supp_email = $inv->supplier_email;
            $supp_phone1 = $inv->supplier_phone1;
            $supp_phone2 = $inv->supplier_phone2;
            $inv_no = $inv->invoice_no;
            $po_no = $inv->po_no;
            $do_no = $inv->do_no;
            $inv_date = date_create($inv->invoice_date);
            $inv_date = date_format($inv_date, "Y-m-d");
            $credit_terms = $inv->credit_terms;

            foreach ($this->country as $code => $name) {
                $country_list .= '<option value="' . $code . '" ' . ($inv->supplier_country_code == $code ? 'selected="selected"' : null) . '>' . $name . '</option>';
            }
            
            $inv_file = DB::table('invoice_doc')
                ->where('invoice_id', Input::get('inv_id', ''))->first();
            
            if (!empty($inv_file->inv_doc_file_size)) {
                $doc_temp = pathinfo($inv_file->inv_doc_file_path);
                $inv_doc = $doc_temp['basename']. ' (' .$inv_file->inv_doc_file_size.' bytes)';
            }
            
            if (!empty($inv_file->po_doc_file_size)) {
                $doc_temp = pathinfo($inv_file->po_doc_file_path);
                $inv_po = $doc_temp['basename']. ' (' .$inv_file->po_doc_file_size.' bytes)';
            }
            
            if (!empty($inv_file->do_doc_file_size)) {
                $doc_temp = pathinfo($inv_file->do_doc_file_path);
                $inv_do = $doc_temp['basename']. ' (' .$inv_file->do_doc_file_size.' bytes)';
            }
        }
        else {
            foreach ($this->country as $code => $name) {
                $country_list .= '<option value="' . $code . '">' . $name . '</option>';
            }
        }
        
        $prefix = DB::getTablePrefix();
        $suppliers = DB::select("SELECT * FROM {$prefix}suppliers S
                    inner join {$prefix}supplier_user_view V on V.supplier_id = S.supplier_id
                    WHERE V.user_id = ".Auth::user()->id);
        
        $ret_val = '';
        foreach($suppliers as $option) {
            $opt_selected = "";
            
            if (Input::has('inv_id')) {
                if ($inv->supplier_id == $option->supplier_id) {
                    $opt_selected = "selected";
                }
            }

            $ret_val .= "<option value=\"$option->supplier_id\" $opt_selected>$option->supplier_name</option>";
        }
        

        return View::make('Invoice/EditInvoice1')
            ->shares('title', __('Edit Invoice'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->with('ret_val', $ret_val)
            ->with('supp_id', $supp_id)
            ->with('supp_name', $supp_name)
            ->with('supp_addr1', $supp_addr1)
            ->with('supp_addr2', $supp_addr2)
            ->with('supp_state', $supp_state)
            ->with('supp_postal', $supp_postal)
            ->with('country_list', $country_list)
            ->with('supp_email', $supp_email)
            ->with('supp_phone1', $supp_phone1)
            ->with('supp_phone2', $supp_phone2)
            ->with('inv_no', $inv_no)
            ->with('po_no', $po_no)
            ->with('do_no', $do_no)
            ->with('inv_date', $inv_date)
            ->with('credit_terms', $credit_terms)
            ->with('inv_doc', $inv_doc)
            ->with('inv_po', $inv_po)
            ->with('inv_do', $inv_do);
    }
    
    public function editinvoice2()
    {

        $main_nav = 'Invoice';
        $sub_nav = 'Edit';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        


        return View::make('Invoice/EditInvoice2')
            ->shares('title', __('Edit Invoice'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav);
    }
    
    public function editinvoice3()
    {

        $main_nav = 'Invoice';
        $sub_nav = 'Edit';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        
        $inv = DB::table('invoice')
                ->join('invoice_supp', 'invoice.invoice_id', '=', 'invoice_supp.invoice_id')
                ->where('invoice.invoice_id', Input::get('inv_id', ''))
                ->where('invoice.user_id', Auth::user()->id)->first();
         
        $inv_date = date_create($inv->invoice_date);
        $exp_date = date('Y-m-d', strtotime($inv->invoice_date. ' + '. $inv->credit_terms .' days'));
        $exp_date = date_create($exp_date);
        
        $inv_details = DB::table('invoice_items')->where('invoice_id', Input::get('inv_id', ''))->get();
        $detail_html = '';
        
        foreach ($inv_details as $detail)  {
            $detail_html .= '<tr>';
            $detail_html .= '    <td>';
            $detail_html .= '        <div><strong>'. $detail->item_name .'</strong></div>';
            $detail_html .= '        <small><br></small>';
            $detail_html .= '    </td>';
            $detail_html .= '    <td>'. $detail->item_qty .'</td>';
            $detail_html .= '    <td>$ '. $detail->item_unit_price .'</td>';
            $detail_html .= '    <td>$ '. $detail->item_total_price .'</td>';
            $detail_html .= '</tr>';
        }

        return View::make('Invoice/EditInvoice3')
            ->shares('title', __('Edit Invoice'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->with('supplier_name', $inv->supplier_name)
            ->with('supplier_addr1', $inv->supplier_addr1)
            ->with('supplier_addr2', $inv->supplier_addr2)
            ->with('supplier_state', $inv->supplier_state)
            ->with('supplier_postal', $inv->supplier_postal)
            ->with('supplier_country', $this->country[$inv->supplier_country_code])
            ->with('supplier_phone1', $inv->supplier_phone1)
            ->with('supplier_phone2', $inv->supplier_phone2)
            ->with('supplier_email', $inv->supplier_email)
            ->with('invoice_no', $inv->invoice_no)
            ->with('po_no', $inv->po_no)
            ->with('do_no', $inv->do_no)
            ->with('invoice_date', date_format($inv_date, 'd M Y'))
            ->with('credit_terms', $inv->credit_terms)
            ->with('exp_date', date_format($exp_date, 'd M Y'))
            ->with('detail_html', $detail_html)
            ->with('grand_total', $inv->grand_total);
    }
    
    public function listbid() {

        $main_nav = 'Invoice';
        $sub_nav = 'List Bid';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        

        return View::make('Invoice/ListBid')
            ->shares('title', __('List Bid'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav);
    }
    
    //Listing the invoice data table
    public function getbidlisttble() {
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        $response = array();
        
        
        $invoices = DB::table('auction')
                    ->join('auction_details', 'auction_details.auction_id', '=', 'auction.auction_id')
                    ->join('invoice', 'invoice.invoice_id', '=', 'auction_details.invoice_id')
                    ->join('invoice_supp', 'invoice_supp.invoice_id', '=', 'invoice.invoice_id')
                    ->where('invoice_supp.supplier_email', Auth::user()->email)->get();
        $i = 0;
        
        foreach ($invoices as $invoice)  {
            $inv_date = date_create($invoice->invoice_date);
            $exp_date = date('Y-m-d', strtotime($invoice->invoice_date. ' + '. $invoice->credit_terms .' days'));
            $exp_date = date_create($exp_date);
            $c1['invoice_id'] = $invoice->invoice_id;
            $c1['status'] = $this->getStatus($invoice->status);
            $c1['auction_id'] = $invoice->auction_id;
            $c1['bid_status'] = $invoice->bid_status;
            
            $row[$i] =array("invoice_no" => $invoice->invoice_no, 
                            "invoice_date" => date_format($inv_date, 'Y-m-d'), 
                            "expiry_date" => date_format($exp_date, 'Y-m-d'), 
                            "credit_terms" => $invoice->credit_terms, 
                            "grand_total" => $invoice->grand_total,
                            "invoice_id" => $invoice->invoice_id,
                            "status" => $c1,
                            "discount_rate" => $invoice->discount_rate,
                            "supplier_name" => $invoice->supplier_name
                           );
            $response['data'] = $row;
            $i++;
        } 
        
            
        echo json_encode($response);
    }
    
    public function bidinvoice()
    {

        $main_nav = 'Invoice';
        $sub_nav = 'List Bid';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        
        $inv = DB::table('invoice')
                ->join('invoice_supp', 'invoice.invoice_id', '=', 'invoice_supp.invoice_id')
                ->where('invoice.invoice_id', Input::get('inv_id', ''))
                ->where('invoice_supp.supplier_email', Auth::user()->email)->first();
         
        $inv_date = date_create($inv->invoice_date);
        $exp_date = date('Y-m-d', strtotime($inv->invoice_date. ' + '. $inv->credit_terms .' days'));
        $exp_date = date_create($exp_date);
        
        $inv_details = DB::table('invoice_items')->where('invoice_id', Input::get('inv_id', ''))->get();
        $detail_html = '';
        
        foreach ($inv_details as $detail)  {
            $detail_html .= '<tr>';
            $detail_html .= '    <td>';
            $detail_html .= '        <div><strong>'. $detail->item_name .'</strong></div>';
            $detail_html .= '        <small><br></small>';
            $detail_html .= '    </td>';
            $detail_html .= '    <td>'. $detail->item_qty .'</td>';
            $detail_html .= '    <td>$ '. $detail->item_unit_price .'</td>';
            $detail_html .= '    <td>$ '. $detail->item_total_price .'</td>';
            $detail_html .= '</tr>';
        }
        
        $auction = DB::table('auction')
                    ->where('auction.auction_id', Input::get('a_id', ''))->first();

        return View::make('Invoice/BidInvoice')
            ->shares('title', __('Bid Invoice'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->with('supplier_name', $inv->supplier_name)
            ->with('supplier_addr1', $inv->supplier_addr1)
            ->with('supplier_addr2', $inv->supplier_addr2)
            ->with('supplier_state', $inv->supplier_state)
            ->with('supplier_postal', $inv->supplier_postal)
            ->with('supplier_country', $this->country[$inv->supplier_country_code])
            ->with('supplier_phone1', $inv->supplier_phone1)
            ->with('supplier_phone2', $inv->supplier_phone2)
            ->with('supplier_email', $inv->supplier_email)
            ->with('invoice_no', $inv->invoice_no)
            ->with('po_no', $inv->po_no)
            ->with('do_no', $inv->do_no)
            ->with('invoice_date', date_format($inv_date, 'd M Y'))
            ->with('credit_terms', $inv->credit_terms)
            ->with('exp_date', date_format($exp_date, 'd M Y'))
            ->with('detail_html', $detail_html)
            ->with('grand_total', $inv->grand_total)
            ->with('discount_rate', number_format($auction->discount_rate, 3));
    }
    
    
    public function savebid() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data

        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }

        if (!Input::has('inv_id')) {
            $errors['desc'] = 'Something went wrong! Please contact the administrator';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (!Input::has('auction_id')) {
            $errors['desc'] = 'Something went wrong! Please contact the administrator';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (!Input::has('txt_rdr')) {
            $errors['desc'] = 'Please enter the discount rate';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        $discount_rate =  Input::get('txt_rdr', '');
        
        if ($discount_rate <= 0) {
            $errors['desc'] = 'Discount rate cannot be 0 or less than 0';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        DB::table('auction_details')
            ->where('invoice_id', Input::get('inv_id', ''))
            ->where('auction_id', Input::get('auction_id', ''))
            ->update(array(
                        'bid_rate' => $discount_rate,
                        'bid_status' => 1
            ));  

        DB::table('auction')
            ->where('auction_id', Input::get('auction_id', ''))
            ->update(array(
                        'status' => 1
            ));  
        
        DB::table('invoice')
            ->where('invoice_id', Input::get('inv_id', ''))
            ->update(array(
                        'status' => 1
            ));
        

        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }
    
    public function rejectbid() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data

        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }

        if (empty($_POST['inv_id'])) {
            $errors['desc'] = 'Something went wrong! Please contact the administrator';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['auction_id'])) {
            $errors['desc'] = 'Something went wrong! Please contact the administrator';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }

        DB::table('auction_details')
            ->where('invoice_id', Input::get('inv_id', ''))
            ->where('auction_id', Input::get('auction_id', ''))
            ->update(array(
                        'bid_rate' => 0,
                        'bid_status' => 2
            ));  

        DB::table('auction')
            ->where('auction_id', Input::get('auction_id', ''))
            ->update(array(
                        'status' => 1
            ));  
        
        DB::table('invoice')
            ->where('invoice_id', Input::get('inv_id', ''))
            ->update(array(
                        'status' => 1
            )); 

        $data['success'] = true;
        return Response::make(json_encode($data));
    }
    
}
