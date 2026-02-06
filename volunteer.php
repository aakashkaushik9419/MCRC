<?php
 $conn = mysqli_connect('sql109.infinityfree.com','if0_36862604','vIgyFSWffw82xyc','if0_36862604_mcrc') or die('connection failed');
 if(isset($_POST['submit'])){

   $Name = $_POST['Name'];
   $Email = $_POST['Email'];
   $Subject = $_POST['Subject'];
   $Message = $_POST['Message'];
   

   $select_users = mysqli_query($conn, "SELECT * FROM `Volunteer` WHERE Email = '$Email' AND Subject = '$Subject'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      echo 'Sorry, ',$Name; echo'! You have already contacted regarding ',$Subject;
      }else{
         mysqli_query($conn, "INSERT INTO `Volunteer`(Name, Email, Message, Subject) VALUES('$Name', '$Email', '$Message', '$Subject')") or die('query failed');
         header('location:http://mcrcedu.great-site.net/Message_Success.html');
      }
}
?>