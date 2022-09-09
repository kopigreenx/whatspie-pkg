<?php
namespace Kopigreenx\SociomileDigital;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Kopigreenx\SociomileDigital\Models\SociomileDigitalLog;

class SociomileDigital
{

    public static function createTicket(String $internal_id,String $user_id,String $name,String $phone,String $message)
    {
        $log = new SociomileDigitalLog();
        $client = new Client(['base_uri' => "https://".env("SOCIOMILE_DIGITAL_HOST","XXXXX")."/"]);
        $headers = [
            'Accept'        => 'application/json',
        ];
        $log->internal_id = $internal_id;
        $log->user_id = $user_id;
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
                            'user_id' => $user_id,
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
}
