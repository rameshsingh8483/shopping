<?php
require_once('include/vdooz.php');
require_once('include/top.php');

// // if live search selected specific category
//     if(isset($_POST['term']) && !empty($_POST['cat'])){
//
// 	$Name = $_POST['term'];
// 	$cat = $_POST['cat'];
// 	//Search query.
//    $Query = $conn->query("SELECT DISTINCT vpro_name FROM product_profile WHERE vps_spec_name = 'price' and vpd_user_status = 'active' and vpro_main_cat = '$cat' and  vpro_name LIKE '%$Name%' LIMIT 10");
//
// 		    while($row = $Query->fetch_assoc()){
//                 echo "<p>" . $row['vpro_name'] . "</p>";
//
// 	}
//
//   }
// // if live search all categories
// else{
//
// 	$Name = $_POST['term'];
//
// //Search query.
//    $Query = $conn->query("SELECT DISTINCT vpro_name FROM product_profile WHERE vps_spec_name = 'price' and vpd_user_status = 'active' and  vpro_name LIKE '%$Name%' LIMIT 10");
//
// 		    while($row = $Query->fetch_assoc()){
//                 echo "<p>" . $row['vpro_name'] . "</p>";
//
// 	}
// }

   // $data = array();
   // $query = $conn->query("SELECT DISTINCT vpro_name FROM product_profile WHERE vps_spec_name = 'price' and vpd_user_status = 'active'");
   //
   //  if($query->num_rows > 0){
   //
   //      $userData = $query->fetch_assoc();
   //      $data['status'] = 'ok';
   //      $data['skills'] = $userData;
   //
   //  }else{
        $data['status'] = 'err';
        $data['result'] = 'No data';
    // }
    //returns data as JSON format
    echo json_encode($data);

?>
