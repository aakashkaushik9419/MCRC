<?php
 $conn = mysqli_connect('sql109.infinityfree.com','if0_36862604','vIgyFSWffw82xyc','if0_36862604_mcrc') or die('connection failed');
 if(isset($_POST['submit'])){

   $Name = $_POST['Name'];
   $Email = $_POST['Email'];
   $Aadhar = $_POST['Aadhar'];
   $Gender = $_POST['Gender'];
   $Qualification = $_POST['Qualification'];
   $College = $_POST['College'];
   $Contact = $_POST['Contact'];
   $course_year = $_POST['course_year'];
   $TransactionId = $_POST['TransactionId'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image = $_POST['image'];
   $image_folder = 'uploaded_img/'.$image;
   $image_tmp_name = $_FILES['image']['tmp_name'];
   
   

   $select_users = mysqli_query($conn, "SELECT * FROM `Applicant` WHERE Email = '$Email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      echo 'Sorry, ',$Name; echo'! You have already Registered ';
      }else{
        $add_product_query=mysqli_query($conn, "INSERT INTO `Applicant`(Name, Email, Aadhar, Gender, Qualifiation, College, Contact, course_year, TransactionId, image) VALUES('$Name', '$Email', '$Aadhar', '$Gender', '$Qualification', '$College', '$Contact','$course_year','$TransactionId', '$image')") or die('query failed');
         header('location:http://mcrcedu.great-site.net/Application_Success.html');
         if($add_product_query){
            if($image_size > 2000000){
               $message[] = 'image size is too large';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'product added successfully!';
            }
         }else{
            $message[] = 'product could not be added!';
         }
      }
}
?>