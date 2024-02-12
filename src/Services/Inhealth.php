<?php

namespace Deantev\Inhealth\Integration\Services;
use Exception as GlobalException;
use FFI\Exception;
use Illuminate\Support\Facades\Http;

class Inhealth
{

    /**
    * Your service's server key and url
    * @static
    */
    public static $Inhealth_uat_url;
    public static $Inhealth_prod_url;
    protected static $Inhealth_token;
    protected static $Inhealth_provider_code;

    /**
    * true for production
    * false for developer mode
    * @static
    */
    public static $isProduction;

    public function __construct()
    {
        Inhealth::$isProduction = config('payment-inhealth.inhealth_prod');
        Inhealth::$Inhealth_uat_url = config('payment-inhealth.inhealth_dev_url');
        Inhealth::$Inhealth_prod_url = config('payment-inhealth.inhealth_dev_url');
        Inhealth::$Inhealth_token = config('payment-inhealth.credentials.token');
        Inhealth::$Inhealth_provider_code = config('payment-inhealth.credentials.provider_code');
    }

    /**
    * @return string Service API URL, depends on $isProduction
    */
    public static function getUrl()
    {
        return Inhealth::$isProduction ?
        Inhealth::$Inhealth_prod_url : Inhealth::$Inhealth_uat_url;
    }

    /**
     * @return array Service API Credentials
     */
    protected static function getCredentials(): array {
        $credentials = [
            'token' => Inhealth::$Inhealth_token,
            'kodeprovider' => Inhealth::$Inhealth_provider_code
        ];
        return $credentials;
    }

   /**
     * Send GET request
     * @param string  $url
     * @param mixed[] $data_hash
     */
    public static function get($url, $data_hash)
    {
        return self::remoteCall($url, $data_hash, false);
    }

    /**
     * Send POST request
     * @param string  $url
     * @param mixed[] $data_hash
     */
    public static function post($url, $data_hash)
    {
        return self::remoteCall($url, $data_hash, true);
    }

    /**
     * Actually send request to API server
     * @param string  $url
     * @param string  $server_key
     * @param mixed[] $data_hash
     * @param bool    $post
     */
    public static function remoteCall($url, $data_hash, $post = true)
    {
        try{
            $data_hash = array_merge(Inhealth::getCredentials(),$data_hash);
        
            if($post){
                $result = Http::post($url, $data_hash);
            }
    
            if(!$post){
                $result = Http::get($url, $data_hash);
            }
            if ($result === false) {
                throw new GlobalException('CURL Error');
            } else {
                if ($result->getStatusCode() != 200) {
                    throw new GlobalException($result->reason(), $result->getStatusCode());
                } else {
                    return $result->getBody()->getContents();
                }
            }
        }catch(Exception $e){
            throw $e;
        }
       
    }

    public static function postEligibilitasPeserta($data_hash = [])
    {
        $result = Inhealth::post(
            Inhealth::getUrl() . 'api/EligibilitasPeserta',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCekPoli($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/Poli',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCekProviderRujukan($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/ProviderRujukan',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCekRestriksiObat($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CekRestriksiEPrescriptions',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postDigitalFOI($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/DigitalFOI',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postUpdateSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/UpdateSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postHapusSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/HapusSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanTindakan($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanTindakan',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postHapusTindakan($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/HapusTindakan',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postInfoSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/InfoSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCekRestriksiTransaksi($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CekRestriksiTransaksi',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanBiayaINACBGS($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanBiayaINACBGS',
            $data_hash
        );
        return json_decode($result, true);
    }
    
    public static function postSimpanTindakanRITL($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanTindakanRITL',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postProsesSJPtoFPK($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/ProsesSJPtoFPK',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanObat($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanObat',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCetakSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CetakSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCetakSJPWithResep($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CetakSJPWithResep',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postCetakLampiranFPK($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/CetakLampiranFPK',
            $data_hash
        );
        return json_decode($result, true);
    }
    
    public static function postUpdateTanggalPulang($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/UpdateTanggalPulang',
            $data_hash
        );
        return json_decode($result, true);
    }
    
    public static function postConfirmAKTFirstPayor($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/ConfirmAKTFirstPayor',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postRekapHasilVerifikasi($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/RekapHasilVerifikasi',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanRuangRawat($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanRuangRawat',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postHapusDetailSJP($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/HapusDetailSJP',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanSJPV2($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanSJPV2',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postSimpanDischarge($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/SimpanDischarge',
            $data_hash
        );
        return json_decode($result, true);
    }

    public static function postInfoBenefit($data_hash=[]) {
        $result = Inhealth::post(
            Inhealth::getUrl().'api/InfoBenefit',
            $data_hash
        );
        return json_decode($result, true);
    }
}
