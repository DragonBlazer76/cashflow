<?php
namespace App\Cron\Adapters;

use Nova\Cron\Adapter;
use DB, Mailer;

class RunAuction extends Adapter
{
    // The name of your Cron
    protected $name = 'Run Auction';

    /**
     * Execute the CRON operations.
     */
    
    private function runauctionnow() {
        $response = "";
        $auctions = DB::table('auction')->get();
        
        foreach ($auctions as $auction)  {
            if ($auction->bidstatus < 2) {

            
                $auctiondate_db = strtotime($auction->auction_date);
                $auction_date = mktime(23, 59, 59, date("m", $auctiondate_db), date("d", $auctiondate_db), date("Y", $auctiondate_db));
                $date_now  = mktime(date("H"), date("i"), date("s"), date("m")  , date("d"), date("Y"));
                $compare_date = date("Y-m-d H:i:s", $date_now);
                $auction_date = date("Y-m-d H:i:s", $auction_date);

                if ($compare_date > $auction_date) {
                    $details = DB::table('auction_details')
                        ->where('bid_status', '=', 1)
                        ->where('auction_id', '=', $auction->auction_id)
                        ->orderBy('bid_rate', 'desc')->get();

                    $max_rate = 0;
                    $max_rate_id = "";
                    $all_inv_id = array(); //get all the invoice ID

                    $i = 0;
                    //Find the max rate and its ID
                    foreach ($details as $detail) {
                        if ($detail->bid_rate > $max_rate) {
                            $max_rate = $detail->bid_rate;
                            $max_rate_id = $detail->id;
                        }
                        $all_inv_id[$i] = $detail->invoice_id;
                        $i++;
                    }


                    if ($max_rate <> 0) {
                        //Update the winning bid first
                        DB::table('auction_details')
                        ->where('id', '=', $max_rate_id)
                        ->update(array(
                                    'bid_status' => 3
                                ));  

                        //Update the losing bid
                        DB::table('auction_details')
                        ->where('id', '<>', $max_rate_id)
                        ->where('auction_id', '=', $auction->auction_id)
                        ->update(array(
                                    'bid_status' => 4
                                ));

                        //Update the auction
                        DB::table('auction')
                        ->where('auction_id', '=', $auction->auction_id)
                        ->update(array(
                                    'status' => 2
                                ));

                        //Update all the invoice
                        DB::table('invoice')
                        ->whereIn('invoice_id', $all_inv_id)
                        ->update(array(
                                    'status' => 2
                                ));                    
                    }

                    $response = "done";
                }
                else {
                    $response = "not yet";
                }
            }
            else {
                    $response = "not yet";
            }
        }
        
        return $response;
    }
    
    private function runemailengine() {
        $response = "";
        $allemails = DB::table('email')->get();
        
        foreach ($allemails as $onemail)  {
            if ($onemail->processed == 0) {
                $username = $onemail->first_name.' '.$onemail->last_name;
                $email_to = $onemail->email_to;
                $email_subject = $onemail->email_subject;
                
                Mailer::send($onemail->template, ['title' => $onemail->title, 'content' => $onemail->email_body], function($message) use($username,$email_to,$email_subject) { 
                    $message->to($email_to, $username)->subject($email_subject);
                });
                
                DB::table('email')
                         ->where('id', '=', $onemail->id)
                        ->update(array(
                                    'processed' => 1
                                ));      
                
                $response = "sent";
            }
            $response = "not sent";
        }
        return $response;
        
    }
    
    public function handle()
    {
        
   //     $reply = $this->runauctionnow();
        
        $reply = $this->runemailengine();
        return $reply;
        
        // Or your complicated code here.
    }

}
