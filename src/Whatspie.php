<?php
namespace Kopigreenx\Whatspie;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Whatspie
{
    public static $device;
    public static $secret_key;
    public static $client;
    public function __construct(string $device,string $secret_key,string $uri){
        self::$device = $device;
        self::$secret_key = $secret_key;
        self::$client = new Client(['base_uri' => "https://".$uri."/"]);;

    }

    public static function sendTextMessage(String $receiver,String $message)
    {
        $headers = [
            'Accept'        => 'application/json',
            'Content-Type'        => 'application/json',
            'Authorization'        => 'Bearer '. self::$secret_key,
        ];
        try {
            $response = self::$client->request(
                'POST',
                'messages',
                array(
                    'headers' => $headers,
                    'body' => json_encode([
                        "device" => self::$device,
                        "receiver" => $receiver,
                        "type" => "chat",
                        "message" => $message,
                        "simulate_typing"=> 1
                    ]),
                )
            );

            $body = $response->getBody();
            return (object)((json_decode((string) $body)));
        } catch (GuzzleException $e) {
            return (object)(["error"=> true,"status"=>"error","message"=>$e->getMessage()]);
        }
    }

    public static function sendImageMessage(String $receiver,String $message,String $file_url)
    {
        $headers = [
            'Accept'        => 'application/json',
            'Content-Type'        => 'application/json',
            'Authorization'        => 'Bearer '. self::$secret_key,
        ];
        try {
            $response = self::$client->request(
                'POST',
                'messages',
                array(
                    'headers' => $headers,
                    'body' => json_encode([
                        "device" => self::$device,
                        "receiver" => $receiver,
                        "type" => "image",
                        "message" => $message,
                        "file_url" => $file_url,
                        "simulate_typing"=> 1
                    ]),
                )
            );

            $body = $response->getBody();
            return (object)((json_decode((string) $body)));
        } catch (GuzzleException $e) {
            return (object)(["error"=> true,"status"=>"error","message"=>$e->getMessage()]);
        }
    }
    public static function sendFileMessage(String $receiver,String $message,String $file_url)
    {
        $headers = [
            'Accept'        => 'application/json',
            'Content-Type'        => 'application/json',
            'Authorization'        => 'Bearer '. self::$secret_key,
        ];
        try {
            $response = self::$client->request(
                'POST',
                'messages',
                array(
                    'headers' => $headers,
                    'body' => json_encode([
                        "device" => self::$device,
                        "receiver" => $receiver,
                        "type" => "file",
                        "message" => $message,
                        "file_url" => $file_url,
                        "simulate_typing"=> 1
                    ]),
                )
            );

            $body = $response->getBody();
            return (object)((json_decode((string) $body)));
        } catch (GuzzleException $e) {
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
