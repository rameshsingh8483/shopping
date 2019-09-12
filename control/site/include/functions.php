<?php
function print_r2($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function var_dump2($array){
	echo "<pre>";
	var_dump($array);
	echo "</pre>";
}

function clean($var){
    if (get_magic_quotes_gpc()){
        $var = stripslashes(trim($var));
    }global $conn;
    return mysqli_real_escape_string($conn,trim($var));
}

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function is_url($url) {
      $file_headers = @get_headers($url);
      if (strpos($file_headers[0], "200 OK") > 0) {
         return true;
      } else {
        return false;
      }
  }

  function decr($val){
	$key="DFJVKJRKJT$#GJ@DFH%U^HFD";
    $id = pack('H*', $val); // Translate back to binary
	$data =openssl_decrypt($id, 'bf-ecb', $key, true);
    $data = base_convert($data, 36, 10);
    return $data;
}

function encr($val){
	$key="DFJVKJRKJT$#GJ@DFH%U^HFD";
    $id = base_convert($val, 10, 36); // Save some space
	$data =openssl_encrypt($id, 'bf-ecb', $key, true);
    $data = bin2hex($data);
    return $data;
}


function encrypt( $data, $key ="afg56)398@890584#xzcbyi*adf#asgaaawfg^dsdff") {
    $salt = 'dsfds17ghg5s4jy547e8546434q3r21ew321ds21gghh4w6w4w45yrg1f';
    $iv_size = openssl_cipher_iv_length( "AES-256-CBC" );
    $hash = hash( 'sha256', $salt . $key . $salt );
    $iv = substr( $hash, strlen( $hash ) - $iv_size );
    $key = substr( $hash, 0, 32 );
    $encrypted = base64_encode( openssl_encrypt( $data, "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv ) );
    return $encrypted;
}

 function decrypt( $data, $key ="afg56)398@890584#xzcbyi*adf#asgaaawfg^dsdff") {
    $salt = 'dsfds17ghg5s4jy547e8546434q3r21ew321ds21gghh4w6w4w45yrg1f';
    $iv_size = openssl_cipher_iv_length( "AES-256-CBC" );
    $hash = hash( 'sha256', $salt . $key . $salt );
    $iv = substr( $hash, strlen( $hash ) - $iv_size );
    $key = substr( $hash, 0, 32 );
    $decrypted = openssl_decrypt( base64_decode( $data ), "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv );
    $decrypted = rtrim( $decrypted, "\0" );
    return $decrypted;
}

function secureme($input){
	return crypt($input,"TJI^V#34&nhsyaf*badfhhj454");
}

function hash_up($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function search_up($length) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function get_numeric($str) {
$int = intval(preg_replace('/[^0-9]+/', '', $str), 10);
return $int;
}

function remove_numeric($str){
$str= preg_replace('/[[:digit:]]/','', $str);	
return $str;
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function unique_id($l = 8) {
    return strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, $l));
}
?>