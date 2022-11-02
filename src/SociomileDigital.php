<?php
namespace Kopigreenx\SociomileDigital;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Kopigreenx\SociomileDigital\Models\SociomileDigitalLog;

class SociomileDigital
{

    public static function createTicketAsCustomer(String $internal_id,String $phone,String $name,String $message)
    {
        $log = new SociomileDigitalLog();
        $client = new Client(['base_uri' => "https://".env("SOCIOMILE_DIGITAL_HOST","XXXXX")."/"]);
        $headers = [
            'Accept'        => 'application/json',
        ];
        $log->internal_id = $internal_id;
        $log->user_id = $phone;
        $log->name = $name;
        $log->phone = $phone;
        $log->message = $message;
        try {
            $response = $client->request(
                'POST',
                'partner/ticket/create',
                array(
                    'headers' => $headers,
                        'form_params' => array(
                            'client_secret_key' => env("SOCIOMILE_DIGITAL_SECRET","XXXXX"),
                            'client_secret_id' => env("SOCIOMILE_DIGITAL_ID","XXXXX"),
                            'user_id' => $phone,
                            'name' => $name,
                            'phone' => $phone,
                            'message' => $message
                        )
                )
            );

            $body = $response->getBody();
            $log->response = ($body);
            $log->save();
            return response()->json((json_decode((string) $body)));
        } catch (GuzzleException $e) {
            $log->response = json_encode(["status"=>"error","message"=>$e->getMessage()]);
            $log->save();
            return response()->json(["status"=>"error","message"=>$e->getMessage()]);
        }
    }

    public static function statusTicket(String $user_id)
    {
        $client = new Client(['base_uri' => "https://".env("SOCIOMILE_DIGITAL_HOST","XXXXX")."/"]);
        $headers = [
            'Accept'        => 'application/json',
        ];
        try {
            $response = $client->request(
                'POST',
                'partner/ticket/status',
                array(
                    'headers' => $headers,
                        'form_params' => array(
                            'client_secret_key' => env("SOCIOMILE_DIGITAL_SECRET","XXXXX"),
                            'client_secret_id' => env("SOCIOMILE_DIGITAL_ID","XXXXX"),
                            'user_id' => $user_id
                        )
                )
            );

            $body = $response->getBody();
            return response()->json((json_decode((string) $body)));
        } catch (GuzzleException $e) {
            return response()->json(["status"=>"error","message"=>$e->getMessage()]);
        }
    }

    public function createTicketAsAgent($internal_id,$phone,$name,$message){
        $log = new SociomileDigitalLog();
        $client = new Client(['base_uri' => "https://".env("SOCIOMILE_DIGITAL_HOST","XXXXX")."/"]);
        $headers = [
            'Accept'        => 'application/json',
            'X-API-KEY'        =>  env("SOCIOMILE_DIGITAL_WABA_SECRET","XXXXX"),
            'X-WABA-ID'        =>  env("SOCIOMILE_DIGITAL_WABA_ID","XXXXX"),
            'X-NOTIFICATION'        =>  env("SOCIOMILE_DIGITAL_WABA_TYPE","XXXXX"),
        ];
        $log->internal_id = $internal_id;
        $log->user_id = $phone;
        $log->name = $name;
        $log->phone = $phone;
        $log->message = $message;

        $randomId = self::generateRandomString();
        try {
            $response = $client->request(
                'POST',
                'ivowaba',
                array(
                    'headers' => $headers,
                    'json' => [
                        "message" => [
                            "text" => $message
                        ],
                        "contact" => [
                            "id" => "606bc9bab2763d7a3078a3a3",
                            "full_name" => $name,
                            "whatsapp" => $phone,
                            "whatsapp_id" => $phone
                        ],
                        "disposition" =>[
                            "http_code" => 201,
                            "http_response" => [
                                "messages" => [
                                    [
                                        "id" => $randomId
                                    ]
                                ],
                                "meta" => [
                                    "api_status" => "stable",
                                    "version" => "2.33.3"
                                ]
                            ],
                            "message_id" => $randomId
                        ],
                    ],
                )
            );
            $body = json_decode($response->getBody());
            $log->response = json_encode($body);
            $log->save();
            return $body;
        } catch (GuzzleException $e) {
            $log->response = json_encode(["status"=>"error","message"=>$e->getMessage()]);
            $log->save();
            return (object)(["error"=> true,"status"=>"error","message"=>$e->getMessage()]);
        }
    }

    protected static function generateRandomString($length = 28) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
