<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */


namespace App\Controllers;

use App\Core\Controller;
use Config, View, DB, Auth, Response, Redirect, Hash, Mailer, Input;

class Profile extends Controller
{
 /**
     * Create and return a View instance.
     */
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
    public function index()
    {

        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        
        $main_nav = 'Settings';
        $sub_nav = 'Profile';
        $sub_sub_nav = '';
        $message = 'testing';
        
        $email = Auth::user()->email;
        
        $prefix = DB::getTablePrefix();
        $users = DB::select("SELECT * FROM
                    {$prefix}users WHERE email='".$email."';");
        
        $ret_val = '';
        $first_name = '';
        $last_name = '';
        $email = '';
        $mobile_number='';
        $country_code = '';
        $image = '';
        foreach($users as $row) {
            $ret_val = $row->first_name.' '.$row->last_name.' '.$row->country_code.
            $first_name =  $row->first_name;
            $last_name = $row->last_name;
            $email = $row->email;
            $mobile_number = $row->mobile_number;
            $country_code = $row->country_code;
            $image = $row->image;
            if (empty($image)) {
                $image = strtolower(template_url('images/noavatar.jpg', 'Smarty'));
            }
        }
        
        $country_list = "";
        foreach ($this->country as $code => $name) {
	       $country_list .= '<option value="' . $code . '" ' . ($country_code == $code ? 'selected="selected"' : null) . '>' . $name . '</option>';
        }
        
        $company = DB::select("
                    SELECT  nova_company.*
                    from {$prefix}users
                    inner JOIN {$prefix}company
                    on {$prefix}users.company_id={$prefix}company.company_id
                     WHERE email='".$email."';");
        
        $ret_val = '';
        $company_name = '';
        $registration_number = '';
        $company_address = '';
        $company_country='';
        $industry = '';
        $website_url='';

        
        foreach($company as $row) {
        
            $company_name = $row->company_name;
            $registration_number = $row->registration_number;
            $company_address = $row->company_address;
            $company_country = $row->country_code;
            $industry = $row->industry;
            $website_url = $row->website_url;
        }
        
        $country_list2 = "";
        foreach ($this->country as $code => $name) {
	       $country_list2 .= '<option value="' . $code . '" ' . ($company_country == $code ? 'selected="selected"' : null) . '>' . $name . '</option>';
        }
        
        $suppliers = DB::select("SELECT nova_suppliers.*
        from {$prefix}suppliers
        inner JOIN {$prefix}users
        on {$prefix}users.supplier_id={$prefix}suppliers.supplier_id
         WHERE email='".$email."';");
        
        $ret_val = '';
        $supplier_name = '';
        $supplier_addr1 = '';
        $supplier_addr2 = '';
        $supplier_state='';
        $supplier_postal = '';
        $supplier_email='';
        $supplier_phone1='';
        $supplier_phone2='';
        $supplier_credit_terms='';
        $supplier_country_code='';
        

        
        foreach($suppliers as $row) {
        
            $supplier_name = $row->supplier_name;
            $supplier_addr1 = $row->supplier_addr1;
            $supplier_addr2 = $row->supplier_addr2;
            $supplier_state = $row->supplier_state;
            $supplier_postal = $row->supplier_postal;
            $supplier_email = $row->supplier_email;
            $supplier_credit_terms = $row->supplier_credit_terms;
            $supp_country_code = $row->supplier_country_code;
            $supplier_phone1 = $row->supplier_phone1;
            $supplier_phone2 = $row->supplier_phone2;
            
        }
        
        $supplier_country_code = "";
        foreach ($this->country as $code => $name) {
	       $supplier_country_code .= '<option value="' . $code . '" ' . ($supp_country_code == $code ? 'selected="selected"' : null) . '>' . $name . '</option>';
        }
        
        return View::make('Settings/Profile')
            ->shares('title', __('Profile'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->shares('sub_sub_nav', $sub_sub_nav)
            ->with('welcomeMessage', $message)
            ->with('user_name',  $ret_val)
            ->with('country_list',  $country_list)
            ->with('first_name',  $first_name)
            ->with('last_name',  $last_name)
            ->with('email', $email)
            ->with('image', $image)
            ->with('mobile_number',$mobile_number)
            ->with('company_name',$company_name)
            ->with('registration_number',$registration_number)
            ->with('company_address',$company_address)
            ->with('country_list2',$country_list2)
            ->with('industry',$industry)
            ->with('website_url',$website_url)
            ->with('supplier_name', $supplier_name)
            ->with('supplier_addr1', $supplier_addr1)
            ->with('supplier_addr2', $supplier_addr2)
            ->with('supplier_state', $supplier_state)
            ->with('supplier_postal', $supplier_postal)
            ->with('supplier_country_code', $supplier_country_code)
            ->with('supplier_email', $supplier_email)
            ->with('supplier_phone1', $supplier_phone1)
            ->with('supplier_phone2', $supplier_phone2)
            ->with('supplier_credit_terms', $supplier_credit_terms);
    }
    
  
    public function personal_profile() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        if (empty($_POST['first_name'])) {
            $errors['desc'] = 'Please enter your first name';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['last_name'])) {
            $errors['desc'] = 'Please enter your last name';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['mobile_number'])) {
            $errors['desc'] = 'Please enter your mobile number';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
         if (empty($_POST['sel_country'])) {
            $errors['desc'] = 'Please select your country';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
          if (empty($_POST['email_id'])) {
            $errors['desc'] = 'please enter your email address';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        DB::table('users')
            ->where('email', Auth::user()->email)
            ->update(array(
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'mobile_number' => $_POST['mobile_number'],
                        'country_code' => $_POST['sel_country'],
                        'email' => $_POST['email_id']
                        )
                    );
        
        $data['success'] = true;
        return Response::make(json_encode($data));
  

    }
    
     public function company_profile() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        if (empty($_POST['company_name'])) {
            $errors['desc'] = 'Please enter your company name';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['registration_number'])) {
            $errors['desc'] = 'Please enter your company registration no';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['company_address'])) {
            $errors['desc'] = 'Please enter your company address';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
         if (empty($_POST['country_code'])) {
            $errors['desc'] = 'Please select your country';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
          if (empty($_POST['industry'])) {
            $errors['desc'] = 'please enter your industry';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
            if (empty($_POST['website_url'])) {
            $errors['desc'] = 'please enter your company url';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        DB::table('company')
            ->where('company_id', Auth::user()->company_id)
            ->update(array(
                        'company_name' => $_POST['company_name'],
                        'registration_number' => $_POST['registration_number'],
                        'company_address' => $_POST['company_address'],
                        'country_code' => $_POST['country_code'],
                        'industry' => $_POST['industry'],
                        'website_url' => $_POST['website_url']
                        )
                    );
        
        $data['success'] = true;
        return Response::make(json_encode($data));
  

    }
    
    public function profile_picture() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data

        $destinationPath = ROOTDIR .'assets/smarty/assets/upload/'.Auth::user()->id.'/';
        //$destinationPath = APPDIR .'Storage/Files/upload/'.Auth::user()->id.'/';

        if (Input::hasFile('newPicture')) {
            if (Input::file('newPicture')->isValid()) {

                $inv_filename = Input::file('newPicture')->getClientOriginalName();
                $inv_filesize = Input::file('newPicture')->getSize();
                $inv_filetype = Input::file('newPicture')->getMimeType();
                Input::file('newPicture')->move($destinationPath, $inv_filename);

                DB::table('users') ->where('email', Auth::user()->email) 
                    ->update(array('image' => template_url('upload/'.Auth::user()->id.'/'.rawurlencode($inv_filename), 'smarty')));
            }
        }
        $data['success'] = true;
        return Response::make(json_encode($data));
        
    }
    
    public function profile_password() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        if (empty($_POST['current_pwd'])) {
            $errors['desc'] = 'Password is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['new_pwd'])) {
            $errors['desc'] = 'Please enter your new password!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['confirm_pwd'])) {
            $errors['desc'] = 'Please confirm your password!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (strlen($_POST['new_pwd'] ) < 8) {
            $errors['desc'] = 'Password is too short! Password must be between 8 to 20 characters';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
           
        if (strlen($_POST['new_pwd']) > 20) {
            $errors['desc'] = 'Password is too long! Password must be between 8 to 20 characters';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
           
        if (!preg_match("#[0-9]+#", $_POST['new_pwd'])) {
            $errors['desc'] = 'Password must include at least one number!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
           
        if (!preg_match("#[a-z]+#", $_POST['new_pwd'])) {
            $errors['desc'] = 'Password must include at least one letter!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }

        if (!preg_match("#[A-Z]+#", $_POST['new_pwd'])) {
            $errors['desc'] = 'Password must include at least one CAPS!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (($_POST['new_pwd']) <> ($_POST['confirm_pwd'])) {
            $errors['desc'] = 'Your password is not the same.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        } 
        
//        $current_pwd = Hash::make($_POST['current_pwd']);
        $current_pwd = $_POST['current_pwd'];
        

        $user = DB::table('users')->where('email', Auth::user()->email)->first();
//        if ($user->password <> $current_pwd) {
        if (!Hash::check($current_pwd, $user->password)) {
            $errors['desc'] =  "Your current password is wrong";
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
            
        
        $new_password = Hash::make($_POST['new_pwd']);
        

        DB::table('users') ->where('email', Auth::user()->email) ->update(array('password' => $new_password));

            
//        $username = Auth::user()->first_name.' '.Auth::user()->last_name;
//        $emailmsg = '
//        Dear '. $username . ', <br><br>
//        You have recently changed your password for this account: '.  Auth::user()->email .'. If you had not changed your password, please contact the administrator immediately.<br><br>
//        
//        This is an auto generated email. Please do not reply.
//        
//        ';
//        
//        Mailer::send('Emails/Welcome', ['title' => 'Password has changed!', 'content' => $emailmsg], function($message) use($username)
//            { $message->to( Auth::user()->email, $username)->subject('Cashflow.to password has changed');
//            });

        $data['success'] = true;
        return Response::make(json_encode($data));
  
    }
}


?>
