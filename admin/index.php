<?php
include_once "inc/connect.php";

//check if the starting row variable was passed in the URL or not
if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT ID, Artist, Song, Genre FROM tracks LIMIT $startrow, 10";
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
	  <th>ID</th>
		<th>
		<a href="#">
		Song
		</a></th>
		<th>
		<a href="#">
		Artist
		</a></th>
		<th>
		<a href="#">
		Genre
		</a></th>
		<th>Edit</th>
	  </tr>
	</thead>
	    <tbody>
	    <?php
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {

	    ?>
	<tr>
		<td><?php echo $row["ID"] ?></td>
		<td><?php echo $row["Song"] ?></td>
		<td><?php echo $row["Artist"] ?></td>
		<td><?php echo $row["Genre"] ?></td>
		<td>Edit</td>
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
<nav>
  <ul class="pager">

<?PHP
$prev = $startrow - 10;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
    echo '<li class="previous"><a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'"><span aria-hidden="true">&larr;</span> Previous</a></li>';
?>
<?PHP
echo '<li class="next"><a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+10).'">Next <span aria-hidden="true">&rarr;</span></a></li>';
?>
  </ul>
</nav>


	</body>
</html>