<?php
/*
 * @Author: Jeek
 * @Date: 2022-08-25 11:31:37
 * @Description: 
 */
require_once("./vendor/autoload.php");

use Jeeklin\AES\ECB;

try {
    $en = ECB::encrypt('{"code":0,"msg":"ok"}', '123456a', 'hex');
    $de = ECB::decrypt($en, '123456a', 'hex');
    echo $en."\n";
    echo $de."\n";
} catch (\Throwable $th) {
    echo $th->getMessage()."\n";
}
