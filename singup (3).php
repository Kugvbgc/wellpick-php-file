<?php
$con = mysqli_connect('localhost', 'njoabbmn_items_wellpick', 'Well_pick1234!@', 'njoabbmn_items_wellpick');
  
   $target_path = "proImage";  
   $image = $_POST['ProImages'];  
   $name = $_POST['ProName'];
   $ProEmail= $_POST['ProEmail'];
   $ProPassword =$_POST['ProPassword'];
   $key=$_POST['key'];

   $SecurityKey=decryptData($key);

   if($SecurityKey=='khair1234@'){
      
   $imageStore = rand()."_".time().".jpeg";  
   $target_path = $target_path."/".$imageStore;  
   
   if(file_put_contents($target_path, base64_decode($image))){
     $select ="INSERT INTO profile_table( name, email, password, Images) VALUES ('$name','$ProEmail','$ProPassword','$imageStore')";
   $response = mysqli_query($con,$select);  
   if($response){  
     echo "Image Upload";  
     mysqli_close($con);  
   } else echo "Something Wrong";  
      

   }

  }else{
    echo "Something Wrong";
  }
   //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


  function decryptData($text){
    $decoded=base64_decode($text);
  $decryptData=openssl_decrypt($decoded,'AES-128-ECB','abulkhair123456@',
  OPENSSL_RAW_DATA);
  return $decryptData;

   }

   function encryptData($text) {
    $encryptedData = openssl_encrypt($text, 'AES-128-ECB', 'abulkhair123456@', OPENSSL_RAW_DATA);
    $encoded = base64_encode($encryptedData);
    return $encoded;
}

   
 


?>