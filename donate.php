<?php
 $conn = mysqli_connect('sql109.infinityfree.com','if0_36862604','vIgyFSWffw82xyc','if0_36862604_mcrc') or die('connection failed');
 if(isset($_POST['submit'])){

   $Name = $_POST['Name'];
   $Email = $_POST['Email'];
   $Amount = $_POST['Amount'];
   $Transaction = $_POST['Transaction'];
     
    mysqli_query($conn, "INSERT INTO `Donate`(Name, Email, Amount, Transaction) VALUES('$Name', '$Email', '$Amount', '$Transaction')") or die('query failed');
    header('location:http://mcrcedu.great-site.net/Donate_Success.html');
      
}
?>