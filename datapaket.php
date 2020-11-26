<?php 
$ekspedisi = $_POST["ekspedisi"];
$kota = $_POST["kota"];
$berat = $_POST["berat"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=55&destination=".$kota."&weight=".$berat."&courier=".$ekspedisi,
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: d1d8d7f02854b30bc12ef970ed8e86e5"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
    // jadikan array 
    $array_response = json_decode($response,TRUE);

    $paket = $array_response["rajaongkir"]["results"]["0"]["costs"];

    // echo "<pre>";
    // print_r($paket);
    // echo "</pre>"; 

    echo "<option value=''>--Pilih Paket--</option>";
    foreach ($paket as $key => $tiap_paket) 
    {
      echo "<option 
      paket='".$tiap_paket['service']."'
      ongkir='".$tiap_paket["cost"]["0"]["value"]."'
      etd='".$tiap_paket["cost"]["0"]["etd"]."' >";
      echo $tiap_paket["service"]." ";
      echo number_format($tiap_paket["cost"]["0"]["value"])." ";
      echo $tiap_paket["cost"]["0"]["etd"];
      echo "</option>";
    }
}
 ?>