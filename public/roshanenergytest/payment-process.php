<?php

require '../roshanenergytest/vendor/autoload.php';

$access_token = 'EAAAEKGxxaGyvHTdKAqYKVoStBqc3G3lRBWIZPW5YuRmZo9L8r4VFJMaVv2j6IFr';
# setup authorization
\SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);
# create an instance of the Transaction API class
$transactions_api = new \SquareConnect\Api\TransactionsApi();
$location_id = 'LKNYD0HWCBEZV';
$nonce = $_POST['nonce'];

$request_body = array (
    "card_nonce" => $nonce,
    # Monetary amounts are specified in the smallest unit of the applicable currency.
    # This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
    "amount_money" => array (
        "amount" => (int) $_POST['amount'],
        "currency" => "USD"
    ),
    # Every payment you process with the SDK must have a unique idempotency key.
    # If you're unsure whether a particular payment succeeded, you can reattempt
    # it with the same idempotency key without worrying about double charging
    # the buyer.
    "idempotency_key" => uniqid()
);

try {
    $result = $transactions_api->charge($location_id,  $request_body);
    // print_r($result);
	
	// echo '';
	if($result['transaction']['id']){
		echo 'Payment success!';
		echo "Transation ID: ".$result['transaction']['id']."";
	}
} catch (\SquareConnect\ApiException $e) {
    echo "Exception when calling TransactionApi->charge:";
    var_dump($e->getResponseBody());
}
?>