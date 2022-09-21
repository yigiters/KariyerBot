<?php  

require '../db.php';
date_default_timezone_set("Europe/Istanbul");

$today = date("d.m.Y");
$convert = strtotime('-1 day',strtotime($today));
$delete_date = date("d.m.Y",$convert); 

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // sql to delete a record
  $sql = "DELETE FROM job_postings WHERE crdate < '$delete_date' ";

  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Record deleted successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

?>