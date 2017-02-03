<?php

 $hash_key="127D121F034399EEC2445DD342A081C10CE8197C9E91175B4622094269C376441FD738A417BA5F5F039AA8AA9E18D32E7D782C106E53594AE3F135900D00A9CD";
                    
    
  $orderId=trim($_REQUEST['order_id']);
  $amount=trim($_REQUEST['amount']);
$email=trim($_REQUEST['email']);
    $return_url="http://yudala.com/debitcreditcard/response";
    $merch_id='4236';
    $curr_code='566';

echo hash('sha512', $merch_id.$orderId. $amount.$curr_code.$cust_id.$return_url.$hash_key);


?>