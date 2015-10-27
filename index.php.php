<?php
include_once "inc/connect.php";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT id, artist, album, title FROM tracks";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/sandstone/bootstrap.min.css">
	</head>
	<body class="container">
		<h1>Hello world! This is HTML5 Boilerplate.</h1>
  <table class="table table-bordered table-striped">
	<thead>
	  <tr>
	  <th>Select</th>
		<th>
		<a href="#">
		Artist
		</a></th>
		<th>
		<a href="#">
		Album
		</a></th>
		<th>
		<a href="#">
		Song
		</a></th>
		<th>Remove</th>
	  </tr>
	</thead>
	    <tbody>
	    <?php
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {

	    ?>
	<tr>
		<td><input type="checkbox" id="<?php echo $row["id"] ?>" value="" /></td>
		<td><?php echo $row["artist"] ?></td>
		<td><?php echo $row["album"] ?></td>
		<td><?php echo $row["title"] ?></td>
		<td>X</td>
	</tr>
<?php 
	}
} else {
	echo "0 results";
}
$conn->close();

?>	
</tbody>
</table>
	</body>
</html>