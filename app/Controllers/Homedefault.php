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
class Homedefault extends Controller
{
    protected $template = 'Smarty2'; 
    protected $layout = 'default-home';
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

        return View::make('Welcome/home')
            ->shares('title', __('Welcome to'))
            ->with('welcomeMessage', $message);
    }
    
   public function contact() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        $phone = '';
        
        if (!Input::has('contact_name')) {
            $errors['desc'] = 'Full name is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
       
        if (!Input::has('contact_email')) {
            $errors['desc'] = 'Email is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
       
        if (!Input::has('contact_subject')) {
            $errors['desc'] = 'Subject is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        } 
       
       
        $emailmsg = '
        Hi Administrator, <br><br>
        You have an enquiry from the contact form. Details as below:<br><br>

        Full name: '. Input::get('contact_name', '') . '<br>
        Email: '. Input::get('contact_email', '') . '<br>
        Phone: '. Input::get('contact_phone', '') . '<br>
        Subject: '. Input::get('contact_subject', '') . '<br>
        Message: <br>'. Input::get('contact_message', '') . '<br>
        ';
        
        DB::table('email')->insert(
            array(
                'email_to' => 'alan.teo@lignarlabs.com',
                'email_body' => $emailmsg,
                'email_subject' => '[Cashflow.to] You have an enquiry!',
                'first_name' => 'Administrator',
                'last_name' => '',
                'title' => 'You have an enquiry!',
                'template' => 'Emails/Welcome'
                ));
        
//        Mailer::send('Emails/Welcome', ['title' => 'Don\'t worry, we all forget sometimes', 'content' => $emailmsg], function($message) use($username)
//            { $message->to($_POST['email'], $username)->subject('Reset your Cashflow.to password');
//            });

        $data['success'] = true;
        return Response::make(json_encode($data));
        
        
    }
    
    public function subscribe() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
       
        if (!Input::has('email')) {
            $errors['desc'] = 'Email is required!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
       
       
        $emailmsg = '
        Hi '. Input::get('email', '') . ', <br><br>
        You have subscribed to our newsletter. Keep a look out for our latest news! <br><br>
        
        This is an auto generated email. Please do not reply.
        ';
        
        DB::table('email')->insert(
            array(
                'email_to' => Input::get('email', ''),
                'email_body' => $emailmsg,
                'email_subject' => '[Cashflow.to] Thank you for subscribing to us!',
                'first_name' => '',
                'last_name' => '',
                'title' => ' Thank you for subscribing!',
                'template' => 'Emails/Welcome'
                ));
        
        DB::table('subscribe')->insert(
            array('email' => Input::get('email', ''))
            );
        
//        Mailer::send('Emails/Welcome', ['title' => 'Don\'t worry, we all forget sometimes', 'content' => $emailmsg], function($message) use($username)
//            { $message->to($_POST['email'], $username)->subject('Reset your Cashflow.to password');
//            });

        $data['success'] = true;
        return Response::make(json_encode($data));
        
        
    }
}