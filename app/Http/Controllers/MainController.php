<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function start(Request $request) {
        $ids = $request->input('ids');
        $subject = $request->input('subject');
        $text = $request->input('text');

        //get user data
        $userData = $this->getUserData($ids);
        
        //to Mailchimp
        $mailchimpResponse = $this->sendToMailchimp($userData, $subject, $text);
        return $mailchimpResponse;
        
    }
    
    private function generateMail(){
        
    }
    
    private function getUserData($ids){
        $userDataArray = array(
            array(
                'id'        => 0,
                'vorname'   => "Max",
                'name'  => "Mustermann",
                'geschlecht'=> "m",
                'email'     => "n.schoenerstedt@gmx.com"
            ),
            array(
                'id'        => 1,
                'vorname'   => "Lischen",
                'name'  => "Müller",
                'geschlecht'=> "f",
                'email'     => "nico@schoenerstedt.net"
            ),
            array(
                'id'        => 3,
                'vorname'   => 'Pierre',
                'name'      => 'Otto',
                'geschlecht'=>  'm',
                'email'     =>  'pierre_otto@ozonecoders.de'
            )
        );
        return $userDataArray;
    }
    
    private function sendToMailchimp($recipients, $subject, $message){
        $key = $_ENV['MANDRILL_KEY'];
        $senderName = $_ENV['MANDRILL_FROM_NAME'];
        $senderEmail = $_ENV['MANDRILL_FROM_EMAIL'];
        
        $uri = 'https://mandrillapp.com/api/1.0/messages/send.json';

        $postString = '{
        "key": "' . $key . '",
        "message": {
            "html": "' . $message . '",
            "text": "' . $message . '",
            "subject": "' . $subject . '",
            "from_email": "' . $senderEmail . '",
            "from_name": "' . $senderName . '",
            "to": ' . json_encode($recipients) . ',
            "headers": {

            },
            "track_opens": true,
            "track_clicks": true,
            "auto_text": true,
            "url_strip_qs": true,
            "preserve_recipients": true,

            "merge": true,
            "global_merge_vars": [

            ],
            "merge_vars": [

            ],
            "tags": [

            ],
            "google_analytics_domains": [

            ],
            "google_analytics_campaign": "...",
            "metadata": [

            ],
            "recipient_metadata": [

            ],
            "attachments": [

            ]
        },
        "async": false
        }';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

        $result = curl_exec($ch);

        return $result;
        
        //return $postString;
    }

}
