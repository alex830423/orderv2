<?php
class MyPayPal {
function token(){

$clientid = "AVkXtxVTYa-8-B3rc3R-V1oDdkKLczfkjQhysVVxdG4aj--k1WOvpfFN5hyP87KE1ve_Tt3tgV7ZgD0y";
$secret = "EKH_rpKcyiuaoki9p9EDkmqCWtNylpy2B8toZgN-RH3sVULZhaRRA8llOXvJN-bFtVmwsZlQx26y4RDj";

//$clientid = "Ac_DIlswK_739nflppQpRFe4f6Ubwl05VbYyS8W0I9ftFuEXSPO9AYicswvYGDstvIH5tUZI-9mJ-GYQ";
//$secret = "ECYGSlzxOZ56S3IvZJVY113i5C_JrWgS0vzB3b4_FjHE_awCQWL4gKb-gXg48t5kSWxhl1Sp35R6hqjx";

//$clientid = "ATnI3LNgoJY0I2jKHZmeViiYi8kJIPM-zGwG3CwkblKPGm5JcoWHYmWxh741OemygDFWqvcZsZzH9NZi";
//$secret = "EGL7-pSGMh3PGwm0KwUiT-sPVpFENUq72OYKD5192Yrz0brJCdrCoLeD8sO9Cgm2xGKclKp5hlaPP60n";

//$clientid = "AccYBgk0wEmKQ6TUke-7VHDju6PDmhjkIOHGPgbnJBbuOsNqfRECPrtuWDL8wG5drvM5nUBZdpPe0Qmr";
//$secret = "EAAZqd7D2r0vF6BAn6ge7B_XadTM7jKHvUNv0HEewxPtxupBr0w1WJsyRl6SmIqs03z0VUsFP0cINkk5";


$endpoint = "https://api.sandbox.paypal.com/v1/oauth2/token";


$post_data = "grant_type=client_credentials"; 

			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $endpoint);
			curl_setopt($ch, CURLOPT_USERPWD, $clientid.':'.$secret);

			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			//curl_setopt($ch, CURLOPT_POST, 1);
	
			// Set the request as a POST FIELD for curl.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    			'Accept: application/json',
    			'Accept-Language: en_US',
    			));
			$httpResponse = curl_exec($ch);
			
			$token=json_decode($httpResponse,true);
			//print_r($httpResponse);

			//$token = explode('"', $httpResponse);
			
			//print_r($token[11]);

			//curl_close($ch);
			return $token;
			 //echo $token[1];
}
}		

//$paypal= new MyPayPal();	 

//$token=$paypal->token();
//echo $token["access_token"];

//print_r($token[11]);

?>




