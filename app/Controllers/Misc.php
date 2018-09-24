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
class Misc extends Controller
{
    protected $template = 'Smarty'; 
    protected $layout = 'default';
    
    public function notification()
    {

        $main_nav = 'Notification';
        $sub_nav = 'List';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        


        return View::make('Settings/Notification')
            ->shares('title', __('Notifications'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav);
    }
    
    public function getnotifylist() {
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        $notifys = DB::table('notification')
                    ->where('user_id', '=', Auth::user()->id)->get();
        
        $i = 0;
        foreach($notifys as $notify) {
            $row[$i] =array("id" => $notify->id, 
                            "message" => $notify->message,
                            "read" => $notify->read
                           );
            
            $data['data'] = $row;
            $i++;
        }
        
        
        echo json_encode($data);
    }
    
    public function updatenotify() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        if (!Input::has('hid_id')) {
            $errors['desc'] = "There is an error in notification. Please contact the administrator.";
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
            
        DB::table('notification')
            ->where('id',  Input::get('hid_id', ''))
            ->update(array(
                           'read' => 1
                    ));
        
        DB::table('users')
            ->where('id', '=', Auth::user()->id)
            ->decrement('msg_count');
        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }
    
    public function deletenotify() {
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
        
        $notify = DB::table('notification')
                    ->where('id', '=', Input::get('inv_id', ''))->first();
        
        if ($notify->read == "0") {
            DB::table('users')
                ->where('id', '=', Auth::user()->id)
                ->decrement('msg_count');
        }
        
        DB::table('notification')->where('id', '=', Input::get('inv_id', ''))->delete();
       
        $data['success'] = true;
        return Response::make(json_encode($data));
   }

}
