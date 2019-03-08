<?php


include_once("actoken.php");

$paypal= new MyPayPal();	 

$token=$paypal->token();

//echo $token["access_token"].'<br/>';

$endpoint = "https://api.sandbox.paypal.com/v2/checkout/orders";

/*
$post_data = array (
  'intent' => 'sale',
  'redirect_urls' => 
  array (
    'return_url' => 'http://localhost/rest/returnurl.php',
    'cancel_url' => 'http://cancel_URL_here',
  ),
  'payer' => 
  array (
    'payment_method' => 'paypal',
  ),
  'transactions' => 
  array (
    0 => 
    array (
      'amount' => 
      array (
        'total' => '7.47',
        'currency' => 'USD',
      ),
      'description' => 'This is the payment transaction description.',
    ),
  ),
);
//var_dump ($post_data);
*/

		$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $endpoint);
     
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
			// Turn off the server and peer verification (TrustManager Concept).
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

      //curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
		
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
	
			// Set the request as a POST FIELD for curl.
			//curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

			curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "intent": "CAPTURE",
  "purchase_units": [
    {
      "reference_id": "PUHF",
      "amount": {
        "currency_code": "USD",
        "value": "220.00",
        "breakdown": {
          "item_total": {
            "currency_code": "USD",
            "value": "180.00"
          },
          "shipping": {
            "currency_code": "USD",
            "value": "20.00"
          },
          "handling": {
            "currency_code": "USD",
            "value": "10.00"
          },
          "tax_total": {
            "currency_code": "USD",
            "value": "20.00"
          },
          "shipping_discount": {
            "currency_code": "USD",
            "value": "10.00"
          }
        }
      },
      "description": "Sporting Goods",
      "custom_id": "CUST-HighFashions",
      "soft_descriptor": "HighFashions",
      "items": [
        {
          "name": "T-Shirt",
          "unit_amount": {
            "currency_code": "USD",
            "value": "90.00"
          },
          "tax": {
            "currency_code": "USD",
            "value": "10.00"
          },
          "quantity": "1",
          "description": "Green XL",
          "sku": "sku01",
          "category": "PHYSICAL_GOODS"
        },
        {
          "name": "Shoes",
          "unit_amount": {
            "currency_code": "USD",
            "value": "45.00"
          },
          "tax": {
            "currency_code": "USD",
            "value": "5.00"
          },
          "quantity": "2",
          "description": "Running, Size 10.5",
          "sku": "sku02",
          "category": "PHYSICAL_GOODS"
        }
      ],
      "shipping": {
        "options": [
          {
            "id": "PICKUP0000001",
            "label": "Free Shipping",
            "type": "PICKUP",
            "amount": {
              "currency_code": "USD",
              "value": "5.00"
            }
          },
          {
            "id": "STORE00020202",
            "label": "Free Shipping",
            "type": "SHIPPING",
            "amount": {
              "currency_code": "USD",
              "value": "0.00"
            }
          },
          {
            "id": "PICKUP00000232323",
            "label": "Priority Shipping",
            "type": "PICKUP",
            "amount": {
              "currency_code": "USD",
              "value": "10.00"
            }
          }
        ],
        "address": {
          "address_line_1": "123 Townsend St",
          "address_line_2": "Floor 6",
          "admin_area_2": "San Francisco",
          "admin_area_1": "CA",
          "postal_code": "94107",
          "country_code": "US"
        }
      }
    }
  ]
}'
  													);

			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    			"Content-Type: application/json",
    			"Authorization: Bearer".' '.$token["access_token"],
    			));


			$httpResponse = curl_exec($ch);
			//$info  = curl_getinfo($ch,CURLINFO_HTTP_CODE); 

      //echo $info;
			
 			//if(!$httpResponse) {
			//	exit("failed: ".curl_error($ch).'('.curl_errno($ch).')');
			//	}
 			
			//print_r($httpResponse);

      $arr = json_decode($httpResponse,1);

      $orderID = array();

      $orderID['orderID'] = $arr['id'];

      echo json_encode($orderID);

			//$httpResponseAr = explode('"', $httpResponse);

			//print_r($httpResponseAr);

			//echo "<a href='$httpResponseAr[57]'>$httpResponseAr[57]</a>" ;
	
			
