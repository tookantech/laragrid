<?php
namespace Aryala7\Laragrid;


class Laragrid {

        public static function getMainNet() {
            return config('laragrid.main_net');
        }

        public static function getShastaTestNet() {
            return config('laragrid.shasta_testnet');
        }

        public static function getNileTestNet() {
            return config('laragrid.nile_testnet');
        }

        public static function getToken() {
            return config('laragrid.token');
        }

        public static function getNet($net) {

            return match($net){
                'main'=>function(){
                    return self::getMainNet();
                },
                'shasta'=>function(){
                    return self::getShastaTestNet();
                },
                'nile'=>function(){
                    return self::getNileTestNet();
                },
            };
        }

        public function getAddressDetail($address)
        {
            $client = new \GuzzleHttp\Client();
            $response = $client->reponse('GET', self::getNet('main') . '/address/' . $address,[
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);

            return $response->getBody();

        }

        public function getAddressTransactionsInfo($address)
        {
            $client = new \GuzzleHttp\Client();
            $response = $client->reponse('GET', self::getNet('main') . '/address/' . $address . '/transactions',[
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);

            return $response->getBody();

        }

        public function getTRC20TransactionsInfoByAddress($address,$limit = 20,$order_by='desc',$only_to = false,$only_from = false)
        {
            $client = new \GuzzleHttp\Client();
            $response = $client->reponse('GET', self::getNet('main') . '/address/' . $address . '/transactions/trc20',[
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'query' => [
                    'limit' => $limit,
                    'order_by' => $order_by,
                    'only_to' => $only_to,
                    'only_from' => $only_from
                ]
            ]);

            return $response->getBody();
        }

        public function validateAddress($address)
        {
            $client = new \GuzzleHttp\Client();
            $response = $client->reponse('POST', self::getNet('main') . '/wallet/validateaddress',[
                'body' => json_encode(['address' => $address]),
                'headers' => ['Accept' => 'application/json','Content-Type' => 'application/json','TRON-PRO-API-KEY' => self::getToken()]
            ]);

            return $response->getBody();
        }

}
