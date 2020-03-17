<?php  


require __DIR__ .  '/vendor/autoload.php';
MercadoPago\SDK::setAccessToken('APP_USR-4757481950856737-121911-393ff6ebe112271cc1bf3b7e1b7ad7ca__LD_LA__-291362068');

$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = $_POST['item_pay'];
$item->quantity = $_POST['unit_pay'];
$item->unit_price = $_POST['price_pay'];
$payer = new MercadoPago\Payer();
  $payer->name = "Lalo";
  $payer->surname = "Landa";
  $payer->email = "test_user_92120185@testuser.com";
  $payer->phone = array(
    "area_code" => "",
    "number" => "011 2222-3333"
  );
  $payer->identification = array(
    "type" => "DNI",
    "number" => "22333444"
  );
  
  $payer->address = array(
    "street_name" => "Falsa",
    "street_number" => 123,
    "zip_code" => "111"
  );
$preference->items = array($item);
$preference->payment_methods = array(
  "excluded_payment_methods" => array(
    array("id" => "amex")
  ),
  "excluded_payment_types" => array(
    array("id" => "atm")
  ),
  "installments" => 6
);
$preference->external_reference="ABCD1234";
$preference->auto_return="approved";
$preference->back_urls = array(
    "success" => "https://mercadopago-test-devcertificat.herokuapp.com/back_urls/success.php",
    "failure" => "https://mercadopago-test-devcertificat.herokuapp.com/back_urls/success.php",
    "pending" => "https://mercadopago-test-devcertificat.herokuapp.com/back_urls/success.php"
);
$preference->save();

header('Location: '.$preference->sandbox_init_point);


?>