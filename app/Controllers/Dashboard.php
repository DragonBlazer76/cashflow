<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */

namespace App\Controllers;

use App\Core\Controller;

use Config, View, DB, Auth, Response, Redirect, Hash, Input;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Dashboard extends Controller
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

    /**
     * Create and return a View instance.
     */
    public function index()
    {

        if (Auth::check())  { // The user is logged in...
            $message = '';
        }
        else {
            return Redirect::to('login');
        }
        $main_nav = 'Dashboard';
        $sub_nav = '';
        
        $country_list = "";
        
        foreach ($this->country as $code => $name) {
            $country_list .= '<option value="' . $code . '">' . $name . '</option>';
        }
        
        return View::make('Welcome/Dashboard')
            ->shares('title', __('Dashboard'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->with('country_list', $country_list)
            ->with('welcomeMessage', $message);
    }
    
    public function getuserfirsttime()
    {

        $data   = array();      // array to pass back data

        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $user = DB::table('suppliers')->where('supplier_id', '=', Auth::user()->supplier_id)->first();
        
        $data['supplier_id'] = Auth::user()->supplier_id;
        $data['supplier_name'] = $user->supplier_name;
        $data['supplier_addr1'] = $user->supplier_addr1;
        $data['supplier_addr2'] = $user->supplier_addr2;
        $data['supplier_state'] = $user->supplier_state;
        $data['supplier_postal'] = $user->supplier_postal;
        $data['supplier_email'] = Auth::user()->email;
        $data['supplier_phone1'] = $user->supplier_phone1;
        $data['supplier_phone2'] = $user->supplier_phone2;
        $data['credit_terms'] = $user->supplier_credit_terms;
        $data['supp_country_code'] = $user->supplier_country_code;
        $data['first_time'] =  Auth::user()->first_time;
        $data['success'] = true;
        return Response::make(json_encode($data)); 
    }

    public function updatesupplierfirsttime() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
//        if (empty($_POST['supplier_id'])) {
//            $errors['desc'] = 'There is a problem in saving the info. Please contact the administrator.';
//            $data['success'] = false;
//            $data['errors']  = $errors;
//            return Response::make(json_encode($data));
//            exit;
//        }
        
        if (empty($_POST['supplier_name'])) {
            $errors['desc'] = 'Please enter your company name!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['supplier_addr1'])) {
            $errors['desc'] = 'Please enter address 1!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['supplier_postal'])) {
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
        
//        if (empty($_POST['supplier_email'])) {
//            $errors['desc'] = 'Please enter the email!';
//            $data['success'] = false;
//            $data['errors']  = $errors;
//            return Response::make(json_encode($data));
//            exit;
//        }
        
        if (empty($_POST['supplier_phone1'])) {
            $errors['desc'] = 'Please enter the phone number!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }

        
        if (empty($_POST['supplier_credit_terms'])) {
            $errors['desc'] = 'Please enter the credit terms!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        
        DB::table('suppliers')
            ->where('supplier_id', Auth::user()->supplier_id)
            ->update(array(
                           'supplier_addr1' => Input::get('supplier_addr1', ''),
                           'supplier_addr2' => Input::get('supplier_addr2', ''),
                           'supplier_state' => Input::get('supplier_state', ''),
                           'supplier_postal' => Input::get('supplier_postal', ''),
                           'supplier_country_code' => Input::get('supp_country', ''),
                           'supplier_phone1' => Input::get('supplier_phone1', ''),
                           'supplier_phone2' => Input::get('supplier_phone2', ''),
                           //'supplier_email' => Input::get('supplier_email', ''),
                           'supplier_credit_terms' => Input::get('supplier_credit_terms', ''),
                          ));
        
         
        DB::table('users')
            ->where('id',  Auth::user()->id)
            ->update(array(
                           'first_time' => 2
                    ));
        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }
    
    public function changeprofile() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            $errors['desc'] = 'Error in profile selection. Please contact the administrator';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['chk_profile'])) {
            $errors['desc'] = 'Error in profile selection. Please contact the administrator';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        $profile_val = Input::get('chk_profile', '');
        $val = 0;
        
        if ($profile_val == 'true') {
            $val = 1;
        }
        
        DB::table('users')
            ->where('id',  Auth::user()->id)
            ->update(array(
                           'buyer_seller' => $val
                    ));
        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }
    
    public function getnotification() {
        $message = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $notifys = DB::table('notification')
                    ->where('user_id', '=', Auth::user()->id)
                    ->where('read', '=', 0)
                    ->where('displayed', '=', 0)->get();
        
        $i = 0;
        foreach($notifys as $notify) {
            $message[$i]['msg'] = $notify->message;
            $message[$i]['type'] = $notify->type;
            $i++;
            
            DB::table('notification')
            ->where('id',  $notify->id)
            ->update(array(
                           'displayed' => 1
                    ));
        }
        
        
        $data['success'] = true;
        $data['message'] = $message;
        return Response::make(json_encode($data));
    }
    
    public function updatesuppliersecondtime() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        DB::table('users')
            ->where('id',  Auth::user()->id)
            ->update(array(
                           'first_time' => 0
                    ));
        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }

}
