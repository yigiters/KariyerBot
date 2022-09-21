<?php  

function SessionCheck() {
	if (isset($_SESSION['login'])) {
		if ($_SESSION['login'] != "true") {
			header("Location: ../");
		} 
	} else {
		header("Location: ../");
	}
}

function  AllTable() {
	require '../db.php';
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM search_terms");
		$stmt->execute();
		$result = $stmt->fetchAll();
		$count = count($result);

		echo '<table class="table">
		<thead>
		<tr>
		<th scope="col">Arama İsmi</th>
		<th scope="col">Arama Linki</th>
		<th scope="col">Son Çalışma</th>
		<th scope="col">İşlem</th>
		</tr>
		</thead>
		<tbody>';

		for ($i=0; $i < $count; $i++) { 
			echo '<tr>
			<td>' . $result[$i]['name'] . '</td>
			<td>' . $result[$i]['link'] . '</td>
			<td>' . $result[$i]['last_run'] . '</td>
			<td><a href="./delete.php?id= ' . $result[$i]['id'] . '" class="btn btn-danger">Sil</a> </td>
			</tr>';
		}

		echo '</tbody>
		</table>';

	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;

}

function NewSearch($name, $link) {
	require '../db.php';

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO search_terms (name, link)
		VALUES ('$name', '$link')";
		$conn->exec($sql);
		echo '
		<div class="alert alert-primary" role="alert">
		Yeni Kayıt Başarıyla oluşturuldu!
		</div>';
	} catch(PDOException $e) {
		echo '
		<div class="alert alert-danger" role="alert">
		' . $sql . "<br>" . $e->getMessage() . '
		</div>';
	}

	$conn = null;
}

function Delete($id) {
	include '../db.php';

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM search_terms WHERE id=$id";
		$conn->exec($sql);
		header("Location: ./");
	} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
}

?>