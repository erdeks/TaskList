<?php
  try {
       $hostname = "ec2-54-83-19-244.compute-1.amazonaws.com";
       $dbname = "dabupu3k2ssbpf";
       $username = "mdzqcusnhqhhmm";
       $pw = "dbb42c0d15296e4827cb89d386f4bc6434d4e9c519927fc1b3edf1c013f99a2d";
       $pdo = new PDO ("pgsql:host=$hostname;dbname=$dbname","$username","$pw");
  }catch (PDOException $e){
       echo "Failed to get DB handle: ".$e->getMessage()."\n";
       exit;
  }
  $id=$_GET['id'];
  $sql="UPDATE tasks SET done=1 WHERE id='$id'";
  $query = $pdo -> prepare($sql);
  $query -> execute();
  header('Location: '.index.php);
  exit();
?>
