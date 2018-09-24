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
class Auction extends Controller
{
    protected $template = 'Smarty'; 
    protected $layout = 'default';
    
    private function getBidStatus ($statuscode, $boolhtml) {
        $status = array (
            "0" => "No Bid",
            "1" => "Bid",
            "2" => "Rejected",
            "3" => "Won",
            "4" => "Lost"
        );
        
        if ($boolhtml) {
            $html = "";
            if ($statuscode == 0) {
                $html = "<span class=\"label label-default\">".$status[$statuscode]."</span>";
            }
            else if ($statuscode == 1) {
                $html = "<span class=\"label label-primary\">".$status[$statuscode]."</span>";
            }
            else if ($statuscode == 2) {
                $html = "<span class=\"label label-danger\">".$status[$statuscode]."</span>";
            }
            else if ($statuscode == 3) {
                $html = "<span class=\"label label-success\">".$status[$statuscode]."</span>";
            }
            else if ($statuscode == 4) {
                $html = "<span class=\"label label-danger\">".$status[$statuscode]."</span>";
            }
            return $html;
        }
        else {
            return $status[$statuscode];
        }
    }
    
    private function getStatusCode ($statuscode) {
        $status = array (
            "No Bid" => "0",
            "Bid" => "1",
            "Rejected" => "2",
            "Won" => "3",
            "Lost" => "4"
        );
        
        return $status[$statuscode];
    } 
    
    public function createauction1()
    {

        $main_nav = 'Auction';
        $sub_nav = 'Create';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        


        return View::make('Auction/CreateAuction1')
            ->shares('title', __('Create Auction'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav);
    }
    
    public function saveauction1() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }

        if (!Input::has('inv_id')) {
            $errors['desc'] = "Please select at least 1 invoice.";
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (!Input::has('txt_rdr')) {
            $errors['desc'] = "Please enter a discount rate.";
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (!is_numeric(Input::get('txt_rdr'))) {
            $errors['desc'] = "Discount rate is not numeric. Please enter again.";
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        if (!Input::has('expiry_date')) {
            $errors['desc'] = "Please select a date.";
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }

        $date_now = date("Y-m-d"); 
        if (Input::get('expiry_date') < $date_now) {
            $errors['desc'] = 'Auction date cannnot be earlier than today!';
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        $id = DB::table('auction')->insertGetId(
                array('discount_rate' => Input::get('txt_rdr', ''), 
                      'auction_date' => Input::get('expiry_date'),
                      'auction_created' => $date_now,
                      'user_id' => Auth::user()->id
                     )
        );
        
        $inv_ids = json_decode(Input::get('inv_id', ''), true);
        
        foreach ($inv_ids as $inv_id) {
            DB::table('auction_details')->insert(
                array('auction_id' => $id, 
                      'invoice_id' => $inv_id)
            );
            
            $supp = DB::table('invoice_supp')
                        ->where('invoice_id', '=', $inv_id)->first();
            
            $user = DB::table('users')
                        ->where('email', '=', $supp->supplier_email)->first();
            
            $real_supp = DB::table('suppliers')
                        ->where('supplier_id', '=', Auth::user()->supplier_id)->first();
            
            $first_name = '';
            $last_name = '';
            
            if (isset($user)) {
                $first_name = $user->first_name;
                $last_name = $user->last_name;
            
                $emailmsg = '
        Dear '. $first_name . ' ' . $last_name . ', <br><br>
        You have been invited by ' . $real_supp->supplier_name. ' to bid for an auction. Please proceed to <a href="'. site_url().'">Cashflow.to</a> to login or sign up to bid.<br><br>
        
        This is an auto generated email. Please do not reply.
        
        ';
                
                DB::table('notification')->insert(
                    array(
                        'message' => 'There is a bid request by '. $real_supp->supplier_name,
                        'type' => 'info',
                        'user_id' => $user->id
                    ));
            }
            else {
                $emailmsg = '
        Hi there, <br><br>
        You have been invited by ' . $real_supp->supplier_name. ' to bid for an auction. Please proceed to <a href="'. site_url().'">Cashflow.to</a> to login or sign up to bid.<br><br>
        
        This is an auto generated email. Please do not reply.
        
        ';
                
            }
            
            DB::table('email')->insert(
                array(
                        'email_to' => $supp->supplier_email,
                        'email_body' => $emailmsg,
                        'email_subject' => 'Invitation for Bid',
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'title' => 'You are invited to bid for an auction!',
                        'template' => 'Emails/Welcome'
                    ));
        }
        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }
    
    //Listing the invoice data table in Auction screen
    public function getinvoiceforauction() {
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        $response = array();
        
        
//        $invoices = DB::table('invoice')
//                    ->join('suppliers', 'suppliers.supplier_id', '=', 'invoice.supplier_id')
//                    ->where('user_id', Auth::user()->id)->get();
        
        $prefix = DB::getTablePrefix();
        $invoices = DB::select("SELECT I.*, S.supplier_name FROM {$prefix}invoice I
                        INNER JOIN {$prefix}invoice_supp S ON I.invoice_id = S.invoice_id
                        WHERE I.invoice_id NOT IN (SELECT invoice_id FROM {$prefix}auction_details)
                        AND I.user_id = '". Auth::user()->id . "';");
        $i = 0;

        
        foreach ($invoices as $invoice)  {
            $inv_date = date_create($invoice->invoice_date);
            $exp_date = date('Y-m-d', strtotime($invoice->invoice_date. ' + '. $invoice->credit_terms .' days'));
            $exp_date = date_create($exp_date);
            
            $row[$i] =array("invoice_no" => $invoice->invoice_no, 
                            "invoice_date" => date_format($inv_date, 'Y-m-d'), 
                            "expiry_date" => date_format($exp_date, 'Y-m-d'), 
                            "credit_terms" => $invoice->credit_terms, 
                            "grand_total" => $invoice->grand_total,
                            "invoice_id" => $invoice->invoice_id,
                            "supplier_name" => $invoice->supplier_name
                           );
            $response['data'] = $row;
            $i++;
        } 
        
            
        echo json_encode($response);
    }
    
    public function listauction() {

        $main_nav = 'Auction';
        $sub_nav = 'List';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }

        return View::make('Auction/ListAuction')
            ->shares('title', __('List Auction'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav);
    }
    
    public function getauctionlisttble() {
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        $response = array();
        
        
        $auctions = DB::table('auction')
                    ->where('user_id', Auth::user()->id)->get();
        $i = 0;

        
        foreach ($auctions as $auction)  {
            $auction_date = date_create($auction->auction_date);
            
            if ($auction->status == 0) {
                $status = "<span class=\"label label-primary\">In Queue </span>";
            }
            else if ($auction->status == 1) {
                $status = "<span class=\"label label-info\">Processing </span>";
            }
            else if ($auction->status == 2) {
                $status = "<span class=\"label label-success\">Completed </span>";
            }
            else if ($auction->status == 3) {
                $status = "<span class=\"label label-danger\">Cancelled </span>";
            } 
            
            $c2['auction_id'] = $auction->auction_id;
            $c2['status'] = $auction->status;
            
            
            $row[$i] =array("auction_id" => $auction->auction_id, 
                            "auction_date" => date_format($auction_date, 'Y-m-d'), 
                            "discount_rate" => number_format($auction->discount_rate, 3).'%',
                            "status" => $status,
                            "c2" => $c2
                           );
            $response['data'] = $row;
            $i++;
        } 
        
            
        echo json_encode($response);
    }
    
    public function viewauction() {

        $main_nav = 'Auction';
        $sub_nav = 'List';
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }
        
        if (!Input::has('auction_id')) {
            return Redirect::to('/listauction');
            exit;
        }
        
        $auction = DB::table('auction')
                ->where('auction_id', Input::get('auction_id', ''))
                ->where('user_id', Auth::user()->id)->first();
         
        $auction_date = date_create($auction->auction_date);
        $status = "";
        
        if ($auction->status == 0) {
            $status = "<span class=\"label label-primary\">In Queue </span>";
        }
        else if ($auction->status == 1) {
            $status = "<span class=\"label label-info\">Processing </span>";
        }
        else if ($auction->status == 2) {
            $status = "<span class=\"label label-success\">Completed </span>";
        }
        else if ($auction->status == 3) {
            $status = "<span class=\"label label-danger\">Cancelled </span>";
        } 
        

        
        $invs = DB::table('auction_details')
                ->join('invoice', 'invoice.invoice_id', '=', 'auction_details.invoice_id')
                ->join('invoice_supp', 'invoice.invoice_id', '=', 'invoice_supp.invoice_id')
                ->where('auction_id', Input::get('auction_id', ''))
                ->where('invoice.user_id', Auth::user()->id)->get();
        $inv_html = '';
        
        foreach ($invs as $inv)  {
            $invs_details = DB::table('invoice_items')
                    ->join('invoice', 'invoice.invoice_id', '=', 'invoice_items.invoice_id')
                    ->where('invoice.invoice_id', $inv->invoice_id)->get();
            
            
            $inv_html .= '<tr>';
            $inv_html .= '    <td>';
            $inv_html .= '        <div style="padding-bottom:15px;"><strong>'. $inv->invoice_no .'</strong></div>';
            $inv_html .= '        <small><table  class="table table-bordered"><tr><th>Item</th><th style="text-align:center;">Quantity</th><th style="text-align:right;">Unit Price</th><th style="text-align:right;">Total</th></tr>';
            foreach ($invs_details as $invs_detail)  {
                
                $inv_html .= '        <tr><td>'. $invs_detail->item_name . '</td>';
                $inv_html .= '            <td style="text-align:center;width:10%;">'. $invs_detail->item_qty . '</td>';
                $inv_html .= '            <td style="text-align:right;width:25%;">$'. $invs_detail->item_unit_price . '</td>';
                $inv_html .= '            <td style="text-align:right;width:25%;">$'. $invs_detail->item_total_price . '</td></tr>';
                
            }
            $inv_html .= '        </table></small><br>';
            $inv_html .= '    </td>';
            $inv_html .= '    <td>'. $inv->supplier_name .'</td>';
            
            $inv_date = date_create($inv->invoice_date);
            $exp_date = date('Y-m-d', strtotime($inv->invoice_date. ' + '. $inv->credit_terms .' days'));
            $exp_date = date_create($exp_date);            
            
            $inv_html .= '    <td>'. date_format($inv_date, 'd M Y') .'</td>';
            $inv_html .= '    <td>'. date_format($exp_date, 'd M Y') .'</td>';
            $inv_html .= '    <td style="text-align: right">$ '. $inv->grand_total .'</td>';
            $inv_html .= '    <td style="text-align: center">'.$this->getBidStatus($inv->bid_status, true).'</td>';
            $bid_rate = (is_null($inv->bid_rate))?"0.000":number_format($inv->bid_rate,3);
            $inv_html .= '    <td style="text-align: right">'. $bid_rate.'%</td>';
            $inv_html .= '</tr>';
        }

        return View::make('Auction/ViewAuction')
            ->shares('title', __('View Auction'))
            ->shares('main_nav', $main_nav)
            ->shares('sub_nav', $sub_nav)
            ->shares('auction_id', $auction->auction_id)
            ->shares('discount_rate', number_format($auction->discount_rate,3))
            ->shares('status', $status)
            ->shares('auction_date', date_format($auction_date, 'd M Y'))
            ->shares('inv_html', $inv_html);
    }
    
    public function cancelauction() {
        $errors = array();      // array to hold validation errors
        $data   = array();      // array to pass back data
        
        if (!Auth::check())  { // The user is logged in...
            return Redirect::to('login');
            exit;
        }

        if (!Input::has('auction_id')) {
            $errors['desc'] = "There is an error in cancelling the auction. Please contact the administrator.";
            $data['success'] = false;
            $data['errors']  = $errors;
            return Response::make(json_encode($data));
            exit;
        }
        
        DB::table('auction')
            ->where('auction_id', Input::get('auction_id', ''))
            ->update(array('status' => 3));
        
        $data['success'] = true;
        return Response::make(json_encode($data));
    }
}
