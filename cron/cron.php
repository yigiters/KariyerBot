<?php  

require '../db.php';
require 'func.php';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM search_terms");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->fetchAll();
  
  $count = count($result);

  for ($i=0; $i < $count; $i++) {
    $id   = $result[$i]['id'];
  	$link = $result[$i]['link'];
  	$name = $result[$i]['name'];

  	Bot($link, $name);
    RunUpdate($id);

  }

} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;

?>