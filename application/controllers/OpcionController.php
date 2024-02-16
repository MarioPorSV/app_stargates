<?php
class OpcionController extends CI_Controller
{
    public function __construct()
    {

    }


    public function prueba_Mario()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
                                    CURLOPT_URL => 'https://apis-sandbox.fedex.com/address/v1/addresses/resolve',
                                    CURLOPT_RETURNTRANSFER => true,
                                    
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => 'POST',
                                  
                                    CURLOPT_HTTPHEADER => array(
                                        'Authorization: Bearer ',
                                        'X-locale: en_US',
                                        'Content-Type: application/json'
                                    ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }



    public function listado_lmd()
    {
        $url = 'https://apis-sandbox.fedex.com/address/v1/addresses/resolve';
        $header = array(
                        'Authorization: Bearer ',
                        'X-locale: UTF-8',
                        'Content-Type: application/json');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
       // curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.52 Safari/537.17');
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_unescape($ch, $effective_url);

        $response           = curl_exec($ch);

        curl_close($ch);
        echo $response;

     
    }
}
