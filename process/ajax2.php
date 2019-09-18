<?php
require_once('../include/vdooz.php');

$data2 = array();

  if(isset($_POST['cat'])){

	$cat = $_POST['cat'];

  $query = $conn->query("SELECT DISTINCT vpro_name FROM product_profile WHERE vps_spec_name = 'price' and vpd_user_status = 'active' and vpro_main_cat = '$cat'");

   if($query->num_rows > 0){

     while( $row = $query->fetch_assoc()) {

       array_push($data2 , $row['vpro_name']);

       }

       $data['skills'] = $data2;

   }else{

       $data['skills'] = 'No data';
   }

}else{


$query = $conn->query("SELECT DISTINCT vpro_name FROM product_profile WHERE vps_spec_name = 'price' and vpd_user_status = 'active' and  vpro_name LIKE '%$Name%' LIMIT 10");

 if($query->num_rows > 0){

   while( $row = $query->fetch_assoc()) {

     array_push($data2 , $row['vpro_name']);

     }

     $data['skills'] = $data2;

 }else{

     $data['skills'] = 'No data';
 }


}

    //returns data as JSON format
    echo json_encode($data);

?>
