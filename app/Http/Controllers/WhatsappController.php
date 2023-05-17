<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function send_notification($user = null, $message = 'empty message')
    {
        header('Content-type: text/html; charset=UTF-8');
        $message = trim($message, " ");
        $phone = $user->phone;
        if ($phone[0] == 0) {
            $phone = substr($phone, 1);
        }
        if ($phone[0] == 'x') {
            $phone = substr($phone, 3);
        }
        $sender = "989035366888";
        $key = "4B7C9DBD3070B9BE3CCA44303BDDF60A";
        $query = "https://wesender.ir/URL?sender=$sender&key=$key&receiverC=98&receiverN=$phone&message=$message";
        $query = str_replace(' ', '%20', $query);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $query);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
       
    }

    public function curl_notification($phone = null, $message = 'empty message')
    {

        $sender = "989035366888";
        $key = "4B7C9DBD3070B9BE3CCA44303BDDF60A";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://wesender.ir/URL?sender=$sender&key=$key&receiverC=98&receiverN=$phone&message=$message");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}
