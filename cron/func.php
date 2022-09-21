<?php  


function Bot($search_link, $search_name) {

	require '../db.php';
	date_default_timezone_set("Europe/Istanbul");
	$crdate = date("d.m.Y H:i:s");

	$get = file_get_contents($search_link);

//ID 
	preg_match_all('@jobId="(.*?)"@si', $get , $id);

// TITLE
	preg_match_all('@<h3 class="kad-card-title" style="overflow:hidden;" data-v-1abc0786><span style="box-shadow:transparent 0 0;"><span>(.*?)</span></span></h3>@si', $get, $title);

//COMPANY 
	preg_match_all('@<div class="k-text small" data-v-69edd34a data-v-1abc0786><div style="overflow:hidden;" data-v-1abc0786><span style="box-shadow:transparent 0 0;"><span>(.*?)</span></span></div></div>@si', $get, $company);

//LOCATION
	preg_match_all('@<div data-test="location" class="k-text small weak" data-v-69edd34a data-v-1abc0786>(.*?)</div></div></div></div></div></div>@si', $get, $location);

//LINK
	preg_match_all('@<div class="list-items" data-v-1a67b496><a href="(.*?)"@si', $get, $link);

	$count = count($id[0]);

	for ($i=0; $i < $count; $i++) { 

		$data_id = trim($id[1][$i]);
		$data_title = trim($title[1][$i]);
		$data_company = trim($company[1][$i]);
		$data_location = trim($location[1][$i]);
		$data_link = trim($link[1][$i]);

		$find = array('ç','Ç','ı','İ','ğ','Ğ','ü','ö','Ş','ş','Ö','Ü');
		$replace = array('c','C','i','I','g','G','u','o','S','s','O','U');

		$data_company = str_replace($find, $replace, $data_company);
		$data_location = str_replace($find, $replace, $data_location);  

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO job_postings (id, title, company, location, link, crdate)
			VALUES ('$data_id', '$data_title', '$data_company', '$data_location', '$data_link', '$crdate')";
			$conn->exec($sql);
			echo "<pre>";
			echo "New record created successfully" . " " . "<b>" . $data_id . "</b>" . "<br>";
			echo "</pre>";
			$text = "<b>YENİ İŞ İLANI!</b> ($search_name) %0A %0A ->$data_title %0A %0A ->$data_company %0A %0A ->$data_location %0A %0A https://kariyer.net$data_link";
			file_get_contents("https://api.telegram.org/bot".$bot_token."/sendmessage?chat_id=".$chat_id."&parse_mode=html"."&text=" . $text); 
		} catch(PDOException $e) {
			echo "<pre>";
			echo "Registration already exists!" . " " . "<b>" . $data_id . "</b>" . "<br>";
			echo "</pre>";
		}
		$conn = null;
	}


}


function RunUpdate($id) {

	require '../db.php';
	date_default_timezone_set('Europe/Istanbul');	
	$crdate = date("d.m.Y H:i:s");

	try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "UPDATE search_terms SET last_run='$crdate' WHERE id=$id";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

}


?>