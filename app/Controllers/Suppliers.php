<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@novaframework.com
 * @version 3.0
 */

namespace App\Controllers;

use App\Core\Controller;

use Config, View, DB, Auth, Response, Redirect, Input;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Suppliers extends Controller
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
    
    public function index()
    {

        $main_nav = 'Settings';
        $sub_nav = 'Suppliers';
        $sub_sub_nav = 'List Suppliers';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        


        return View::make('Settings/ListSuppliers')
            ->shares('title', __('List Suppliers'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->shares('sub_sub_nav', $sub_sub_nav);
    }
    
    //Listing the suppliers data table
    public function getsupplierslisttble() {
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        $response = array();
        
        
        $suppliers = DB::table('suppliers')
                    ->join('supplier_user_view', 'supplier_user_view.supplier_id', '=', 'suppliers.supplier_id')
                    ->where('supplier_user_view.user_id', Auth::user()->id)->get();
        $i = 0;

        
        foreach ($suppliers as $supplier)  {
            $supplier_id = $supplier->supplier_id;
            $supplier_name = $supplier->supplier_name;
            
            
            $row[$i] =array("supplier_id" => $supplier->supplier_id, 
                            "supplier_name" =>$supplier->supplier_name,
                            "supplier_email" =>$supplier->supplier_email,
                            "supplier_phone1" =>$supplier->supplier_phone1,
                            "supplier_credit_terms" =>$supplier->supplier_credit_terms
                           );
            $response['data'] = $row;
            $i++;
        } 
        
            
        echo json_encode($response);
    }
    
    public function addsuppliers1()
    {

        $main_nav = 'Settings';
        $sub_nav = 'Suppliers';
        $sub_sub_nav = 'Add Supplier';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $supp_addr1 = "";
        $supp_addr2 = "";
        $supp_state = "";
        $supp_postal = "";
        $country_list = "";
        $supp_email = "";
        $supp_phone1 = "";
        $supp_phone2 = "";
        $credit_terms = "";

        
        if (Input::has('supplier_id')) {
            $inv = DB::table('suppliers')
                ->join('supplier_user_view', 'supplier_user_view.supplier_id', '=', 'suppliers.supplier_id')
                ->where('supplier_id', Input::get('supplier_id', ''))
                ->where('supplier_user_view.user_id', Auth::user()->id)->first();
            
            $supp_addr1 = $inv->supplier_addr1;
            $supp_addr2 = $inv->supplier_addr2;
            $supp_state = $inv->supplier_state;
            $supp_postal = $inv->supplier_postal;
            $supp_email = $inv->supplier_email;
            $supp_phone1 = $inv->supplier_phone1;
            $supp_phone2 = $inv->supplier_phone2;
            $credit_terms = $inv->credit_terms;

            foreach ($this->country as $code => $name) {
                $country_list .= '<option value="' . $code . '" ' . ($inv->supplier_country_code == $code ? 'selected="selected"' : null) . '>' . $name . '</option>';
            }
            
        }
        else {
            foreach ($this->country as $code => $name) {
                $country_list .= '<option value="' . $code . '">' . $name . '</option>';
            }
        }
        
//        $prefix = DB::getTablePrefix();
//        $suppliers = DB::select("SELECT * FROM {$prefix}suppliers S
//                            inner join {$prefix}supplier_user_view V on V.supplier_id = S.supplier_id
//                            WHERE V.user_id = ".Auth::user()->id);
//        
//        $ret_val = '';
//        foreach($suppliers as $option) {
//            $opt_selected = "";
//            
//            if (Input::has('inv_id')) {
//                if ($inv->supplier_id == $option->supplier_id) {
//                    $opt_selected = "selected";
//                }
//            }
//
//            $ret_val .= "<option value=\"$option->supplier_id\" $opt_selected>$option->supplier_name</option>";
//        }
        

        return View::make('Settings/AddSupplier')
            ->shares('title', __('Add Supplier'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->shares('sub_sub_nav', $sub_sub_nav)
//            ->with('ret_val', $ret_val)
            ->with('supp_addr1', $supp_addr1)
            ->with('supp_addr2', $supp_addr2)
            ->with('supp_state', $supp_state)
            ->with('supp_postal', $supp_postal)
            ->with('country_list', $country_list)
            ->with('supp_email', $supp_email)
            ->with('supp_phone1', $supp_phone1)
            ->with('supp_phone2', $supp_phone2)
//            ->with('inv_no', $inv_no)
//            ->with('po_no', $po_no)
//            ->with('do_no', $do_no)
//            ->with('inv_date', $inv_date)
            ->with('credit_terms', $credit_terms);
//            ->with('inv_doc', $inv_doc)
//            ->with('inv_po', $inv_po)
//            ->with('inv_do', $inv_do);
    }
    
}
