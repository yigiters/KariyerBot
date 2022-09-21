<?php  

require '../db.php';

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM job_postings";
	$conn->exec($sql);
	echo "Record deleted successfully";
} catch(PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

?>