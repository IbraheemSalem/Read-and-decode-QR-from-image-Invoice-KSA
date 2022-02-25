<?php

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}


function extract_data_from_qr($decodeQR){

/* By Ibraheem Salem */
	
	$fetched_data =	array(); /* مصفوفة التي ستخزن بها البيانات */ 

	/* الحصول على مبلغ الضريبة */
	if (strpos($decodeQR , '') == TRUE) {
		$data 	= explode("", $decodeQR);
	}elseif(strpos($decodeQR , '') == TRUE){
		$data 	= explode("", $decodeQR);
	}
	$fetched_data['tax']	=	(float)substr($data[1], 1);
	
	/* الحصول على مبلغ الفاتورة */
	if (strpos($data[0] , '') == TRUE) {
		$data 	= explode("", $data[0]);
	}elseif(strpos($data[0] , '') == TRUE){
		$data 	= explode("", $data[0]);
	}
	$fetched_data['money']	=	(float)substr($data[1], 1);
	
	/* الحصول على وقت الفاتورة */
	if (strpos($data[0] , '') == TRUE) {
		$data 	= explode("", $data[0]);
	}elseif(strpos($data[0] , '') == TRUE){
		$data 	= explode("", $data[0]);
	}
	$fetched_data['time']	=	substr($data[1], 1);

	/* الحصول على الرقم الضريبي */
	if (strpos($data[0] , '') == TRUE) {
		$data 	= explode("", $data[0]);
	}elseif(strpos($data[0] , '') == TRUE){
		$data 	= explode("", $data[0]);
	}
	$fetched_data['number']	=	(int)substr($data[1], 1);

	/* الحصول على اسم البائع */
	if (strpos($data[0] , '') == TRUE) {
		$data 	= explode("", $data[0]);
	}elseif(strpos($data[0] , '') == TRUE){
		$data 	= explode("", $data[0]);
	}
	$fetched_data['seller']	=	substr($data[0], 2);

	return $fetched_data;

}

$QRurl		=	"https://myfatorh.com/qr/invoice_8_2780_825_6411643271190.png";
$url 		=	"https://zxing.org/w/decode?u=".$QRurl;
$userAgent 	=	"Mozilla / 5.0 (Windows NT 5.1؛ rv: 31.0) Gecko / 20100101 Firefox / 31.0";

// initialize
$init = curl_init();
 curl_setopt($init,CURLOPT_URL,$url); // connect the website
 curl_setopt($init,CURLOPT_RETURNTRANSFER,true); // get the result of connect
 curl_setopt($init,CURLOPT_HEADER,0);
 curl_setopt($init,CURLOPT_USERAGENT ,$userAgent);

//execute 	
 $output = curl_exec($init);
 
 if($output === FALSE ){
 echo "CURL Error:".curl_error($init);
 die();
 }

// close the connect
 curl_close($init);





$qr_code = get_string_between($output, '<table id="result"><tr><td>Raw text</td><td><pre>', '</pre></td></tr><tr><td>Raw bytes</td>');

$decodeQR	=	base64_decode($qr_code);

echo "<pre>";
	print_r(extract_data_from_qr($decodeQR)); 
echo "</pre>";

	
 ?>
