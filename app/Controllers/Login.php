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
class Login extends Controller
{
    protected $template = 'Smarty'; 
    protected $layout = 'default-login';
    /**
     * Create and return a View instance.
     */
    public function index()
    {
        $message = '';

        if (Auth::check())  { // The user is logged in...
            return Redirect::to('dashboard');
            exit;
        }

        return View::make('Welcome/Login')
            ->shares('title', __('Login'))
            ->with('welcomeMessage', $message);
    }
    
    public function signin() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (empty($_POST['email'])) {
            $errors['desc'] = 'Email is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['password'])) {
            $errors['desc'] = 'Password is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (!Auth::attempt(array('email' => $_POST['email'], 'password' => $_POST['password']))) { // User is authenticated there.
            $errors['desc'] = 'Email or password is incorrect.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if ((Auth::user()->active) == 0) {
            $errors['desc'] = 'Account not activated. Please check your email.';
            $data['success'] = false;
            $data['errors']  = $errors;
            Auth::logout();
            return Response::make(json_encode($data));
            exit;
        }
        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }
    
    public function signout() {
        if (Auth::check())  {
            Auth::logout();
            return Redirect::to('login');
        }
        
    }
    
    public function recover() {
        $message = '';
        
        if (Auth::check())  { // The user is logged in...
            $message = 'auth';
            return Redirect::to('dashboard');
            exit;
        }
        
        return View::make('Welcome/Recover')
            ->shares('title', __('Recover'))
            ->with('welcomeMessage', $message);
    }

    public function reset() {
        $username = '';
        $first_name = '';
        $last_name = '';
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (Auth::check())  { // The user is logged in...
            $message = 'auth';
            return Redirect::to('dashboard');
            exit;
        }
        
        $users = DB::table('users')->where('email', '=', $_POST['email'])->get();
        
        if (count($users) == 0) {
            $errors['desc'] = 'Your email is not found in our system. Please register first.';
            $data['success'] = false;
            $data['errors']  = $errors; 
            return Response::make(json_encode($data));
            exit;
        }

        foreach ($users as $user) {
            $chgcode = str_random(60);
            DB::table('users') ->where('email', $_POST['email']) ->update(array('chgpwd_code' => $chgcode));
            $username = $user->first_name.' '.$user->last_name;
            $first_name = $user->first_name;
            $last_name = $user->last_name;
        }

            
        
        $emailmsg = '
        Dear '. $username . ', <br><br>
        You have recently requested to reset your password for this account: '. $_POST['email'] .'. If you had not asked for a password reset, please contact the administrator or change your password immediately.<br><br>

        Please click on the button below to reset your password: <br><br>
        
        '.site_url('chgpwd').'?token='.$chgcode.'&email='. urlencode($_POST['email']) .'<br><br>
        
        This is an auto generated email. Please do not reply.
        
        ';
        
        DB::table('email')->insert(
            array(
                'email_to' => Input::get('email', ''),
                'email_body' => $emailmsg,
                'email_subject' => 'Reset your Cashflow.to password',
                'first_name' => $first_name,
                'last_name' => $last_name,
                'title' => 'Don\'t worry, we all forget sometimes.',
                'template' => 'Emails/Welcome'
                ));
        
//        Mailer::send('Emails/Welcome', ['title' => 'Don\'t worry, we all forget sometimes', 'content' => $emailmsg], function($message) use($username)
//            { $message->to($_POST['email'], $username)->subject('Reset your Cashflow.to password');
//            });

        $data['success'] = true;
        return Response::make(json_encode($data));
        
        
    }
    
    public function chgpwd() {
        $message = 'Reset Password';
        $form_style = '';
        $alert_style = 'margin-bottom: 0px;display:none;';
        
        if ((empty($_GET['email'])) or (empty($_GET['token'])))  {
            $form_style = 'display:none;';
            $alert_style = 'margin-bottom: 0px;';
        } 
        else {
            $user = DB::table('users')->where('email', '=', $_GET['email'])->where('chgpwd_code', '=', $_GET['token'])->first();
        
            if (empty($user)) {
                $form_style = 'display:none;';
                $alert_style = 'margin-bottom: 0px;';
            }
        }
        

        
        return View::make('Welcome/Chgpwd')
            ->shares('title', __('Reset Password'))
            ->with('message', $message)
            ->with('form_style', $form_style)
            ->with('alert_style', $alert_style)
            ->with('hid_email',  $_GET['email'])
            ->with('hid_token', $_GET['token']);
    }
    
    public function chgpwd2() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (empty($_POST['new_pwd'])) {
            $errors['desc'] = 'Password is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['cfm_pwd'])) {
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
        
        if (($_POST['new_pwd']) <> ($_POST['cfm_pwd'])) {
            $errors['desc'] = 'Your password is not the same.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        } 
            
        if (empty($_POST['email'])) {
            $errors['desc'] = 'There is some problem with the link. Please reset your password again.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
            
        if (empty($_POST['token'])) {
            $errors['desc'] = 'There is some problem with the link. Please reset your password again.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }  
        
        $user = DB::table('users')->where('email', '=', $_POST['email'])->where('chgpwd_code', '=', $_POST['token'])->first();

        if (empty($user)) {
            $errors['desc'] = 'There is some problem with the link. Please reset your password again.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        $new_password = Hash::make($_POST['new_pwd']);
        

        DB::table('users') ->where('email', $_POST['email']) ->update(array('chgpwd_code' => null, 'password' => $new_password));

            
        $username = $user->first_name.' '.$user->last_name;
        $emailmsg = '
        Dear '. $username . ', <br><br>
        You have recently changed your password for this account: '. $_POST['email'] .'. If you had not changed your password, please contact the administrator immediately.<br><br>
        
        This is an auto generated email. Please do not reply.
        
        ';
        
        DB::table('email')->insert(
            array(
                'email_to' => Input::get('email', ''),
                'email_body' => $emailmsg,
                'email_subject' => 'Cashflow.to password has changed!',
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'title' => 'Password has changed!',
                'template' => 'Emails/Welcome'
                ));
        
//        Mailer::send('Emails/Welcome', ['title' => 'Password has changed!', 'content' => $emailmsg], function($message) use($username)
//            { $message->to($_POST['email'], $username)->subject('Cashflow.to password has changed');
//            });

        $data['success'] = true;
        return Response::make(json_encode($data));
        
        
    }
    
    public function register() {
        $message = '';
        
        if (Auth::check())  { // The user is logged in...
            $message = 'auth';
            return Redirect::to('dashboard');
            exit;
        }
        
        return View::make('Welcome/Register')
            ->shares('title', __('Register'))
            ->with('welcomeMessage', $message);
    }
    
    
    public function register2() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (empty($_POST['email'])) {
            $errors['desc'] = 'Email is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['new_pwd'])) {
            $errors['desc'] = 'Password is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['cfm_pwd'])) {
            $errors['desc'] = 'Please verify your password!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['first_name'])) {
            $errors['desc'] = 'First name is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['last_name'])) {
            $errors['desc'] = 'Last name is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['company_name'])) {
            $errors['desc'] = 'Company name is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['sel_country'])) {
            $errors['desc'] = 'Please select a country!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (empty($_POST['chk_agree'])) {
            $errors['desc'] = 'Please agree the terms and conditions!';
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
        
        if (($_POST['new_pwd']) <> ($_POST['cfm_pwd'])) {
            $errors['desc'] = 'Your password is not the same.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (!$_POST['chk_agree']) {
            $errors['desc'] = 'Please agree on the terms and conditions before continue.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        $user = DB::table('users')->where('email', '=', $_POST['email'])->first();

        if (!empty($user)) {
            $errors['desc'] = 'Account has already been registered.';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        $supplier_id = "";
        
        if (Input::has('supplier_id')) {
            $supplier_id = Input::get('supplier_id', '');
        }
        else {
            $email = Input::get('email', '');
            $domain = substr($email, strpos($email, '@')+1, strlen($email));
            
            $supplier_id = DB::table('suppliers')->insertGetId(
                array('supplier_name' => Input::get('company_name', ''),
                      'supplier_country_code' => Input::get('sel_country', ''),
                      'supplier_email' => $email,
                      'url' => $domain
                     )
            );
        }
        
        
        $new_password = Hash::make($_POST['new_pwd']);
        $activation_code = str_random(60);
        // 1 is buyer, 0 is seller
        if ($_POST['chk_buyer'] == 'false') {
          $buyer_seller = '0';  
        } 
        else {
          $buyer_seller = '1';
        }
        
        $created_date = date('Y-m-d H:i:s');
        

        DB::table('users')->insert(array('role_id' => '6', 'username' => $_POST['first_name'], 'password' => $new_password,
                                         'email' => $_POST['email'], 'active' => '0', 'activation_code' => $activation_code,
                                         'first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'], 
                                         'country_code' => $_POST['sel_country'], 'buyer_seller' => $buyer_seller,
                                         'created_at' => $created_date, 'updated_at' => $created_date, 'supplier_id' => $supplier_id
                                        )); 
       
        
        //send the email out
        $username = $_POST['first_name']. ' '. $_POST['last_name'];
        $emailmsg = '
        Dear '. $username . ', <br><br>
        You have recently registered Cashflow.to with this account: '. $_POST['email'] .'. Please follow the link below to activate your account: <br><br>
        
        '.site_url('activate').'?token='.$activation_code.'&email='. urlencode($_POST['email']) .'<br><br>
        
        This is an auto generated email. Please do not reply.
        
        ';
        
        DB::table('email')->insert(
            array(
                'email_to' => Input::get('email', ''),
                'email_body' => $emailmsg,
                'email_subject' => 'Hola! Thank you for registering Cashflow.to!',
                'first_name' => Input::get('first_name', ''),
                'last_name' => Input::get('last_name', ''),
                'title' => 'Please verify your E-mail address',
                'template' => 'Emails/Welcome'
                ));
//        
//        Mailer::send('Emails/Welcome', ['title' => 'Please verify your E-mail address', 'content' => $emailmsg], function($message) use($username)
//            { $message->to($_POST['email'], $username)->subject('Hola! Thank you for registering Cashflow.to!');
//            });
        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }
    
    
    public function activate() {
        $message = '';
        $alert_style = '';
        $form_style = '';
        $js_script = 'js/login.js';
        
        if ((empty($_GET['email'])) or (empty($_GET['token'])))  {
            $alert_style = 'alert-danger';
            $form_style = 'margin-bottom: 0px;';
            $message = 'You have not activate your account yet. Please check your email. Click <a href="/"> here</a> to go back.';
        } 
        else {
            $user = DB::table('users')->where('email', '=', $_GET['email'])->where('activation_code', '=', $_GET['token'])->first();
            
            if (empty($user)) {
                $alert_style = 'alert-danger';
                $form_style = 'margin-bottom: 0px;';
                $message = 'You have not activate your account yet. Please check your email. Click <a href="/"> here</a> to go back.';
            }
            else {
                $alert_style = 'alert-success';
                $form_style = 'margin-bottom: 0px;';
                $message = 'Account activated successully. Click <a href="/"> here</a> to go back or wait 5 seconds to redirect back to login.';
                $js_script = 'js/activate.js';
                
                DB::table('users') ->where('email', $_GET['email']) ->update(array('active' => 1, 'activation_code' => null));
            }
                
        }

        
        return View::make('Welcome/Activate')
            ->shares('title', __('Activate Account'))
            ->with('message', $message)
            ->with('form_style', $form_style)
            ->with('alert_style', $alert_style)
            ->with('js_script', $js_script);
    }
    
    
    public function checkdomain() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Input::has('email')) {
            $errors['desc'] = 'Email is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        $email = Input::get('email', '');
        $domain = substr($email, strpos($email, '@')+1, strlen($email));
        
        $supplier = DB::table('suppliers')
                    ->where('url', $domain)->first();
        
        if (empty($supplier)) {
            $data['success'] = true;
            return Response::make(json_encode($data));
            exit;
        }
        else {
            $data['name'] = $supplier->supplier_name;
            $data['supp_id'] = $supplier->supplier_id;
            $data['success'] = true;
            return Response::make(json_encode($data));
            exit;
        }
        
    }
}
