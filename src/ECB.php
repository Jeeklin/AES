<?php
/*
 * @Author: Jeek
 * @Date: 2022-08-25 11:18:50
 * @Description: 
 */
namespace Jeeklin\AES;

class ECB {

    /**
     * @description: AES ECB加密
     * @param {*} $data
     * @param {*} $key
     * @param {*} $type
     * @return {string}
     */
    public static function encrypt($data, $key, $type = 'hex') {

        $types = ['hex', 'base64'];
        $method = 'aes-128-ecb';

        if (!in_array($type, $types)) {
            throw new \Exception('type error');
        }

        $encrypt = openssl_encrypt($data, $method, $key, 0, "");

        if ( 'base64' == $type ) {
            return $encrypt;
        }

        return self::base64ToHex($encrypt);

    }

    /**
     * @description: AEC ECB解密
     * @param {*} $data
     * @param {*} $key
     * @param {*} $type
     * @return {string}
     */
    public static function decrypt ($data, $key, $type = 'hex') {

        $types = ['hex', 'base64'];
        $method = 'aes-128-ecb';

        if (!in_array($type, $types)) {
            throw new \Exception('type error');
        }

        if ( 'hex' == $type ) {
            $data = hex2bin($data);
            $data = base64_encode($data);
        }

        return openssl_decrypt($data, $method, $key, 0, "");

    }


    /**
     * @description: base64转hex
     * @param {*} $str 
     * @param {*} $toupper
     * @return {string}
     */
    private static function base64ToHex($str, $toupper = false) {

        $str = base64_decode($str);

        $hex = "";

        for($i=0; $i < strlen($str); $i++) {
            $dechex = dechex(ord($str[$i]));
            $hex .= strlen($dechex) == 2 ? $dechex : '0' .$dechex; //补0
            if ($toupper) {
                $hex = strtoupper($hex);
            }
        }
        
        return $hex;
    }


}