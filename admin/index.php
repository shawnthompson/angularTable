<?php
include_once "../inc/connect.php";

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
$sql = "SELECT ID, Artist, Song, Genre FROM tracks LIMIT $startrow, 30";
$result = $conn->query($sql);



?>
<!-- index.html -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoundTraxx - Ottawa DJ - Songs</title>
    <!-- CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/sandstone/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap-switch.min.css">
    <link rel="stylesheet" href="../css/grayscale.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <style>
        .main { margin-top: 7em; }
        td.ng-binding { line-height: 2em;}
        .table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th { background-color: #333;}
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {vertical-align: middle;}
		#editSong {color: #000;}
    </style>

    <!-- JS -->
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.23/angular.min.js"></script>
    <script src="js/dirPagination.js"></script>
    <script src="js/app.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">


    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">SoundTraxx</span>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../index.html#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../index.html#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="../index.html#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<div class="container main" ng-app="sortApp" ng-controller="mainController">
	<h1>SoundTraxx - Ottawa DJ - Songs</h1>

<!-- Edit Modals -->


<div class="modal fade" id="editSong" tabindex="-1" role="dialog" aria-labelledby="editSongID">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editSongID">Edit song</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="song" class="control-label">Song:</label>
            <input type="text" class="form-control" id="song">
          </div>
          <div class="form-group">
            <label for="artist" class="control-label">Artist:</label>
            <input type="text" class="form-control" id="artist">
          </div>
          <div class="form-group">
            <label for="genre" class="control-label">Genre:</label>
            <input type="text" class="form-control" id="genre">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>


	
<!-- / Edit Modals -->

  <table class="table table-bordered table-striped table-responsive">
	<thead>
	  <tr>
		<th><a href="#">Song</a></th>
		<th><a href="#">Artist</a></th>
		<th><a href="#">Genre</a></th>
		<th>Edit</th>
		<th>Delete</th>
	  </tr>
	</thead>
    <tbody>
	    <?php
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
	    ?>
	<tr>
		<td><?php echo $row["Song"] ?></td>
		<td><?php echo $row["Artist"] ?></td>
		<td><?php echo $row["Genre"] ?></td>
		<td><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#editSong" data-whatever="title"><i class="fa fa-pencil"></i></a></td>
		<td><a class="btn btn-default btn-sm" href="#"><i class="fa fa-minus"></i></a></td>
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
		$prev = $startrow - 30;
		//only print a "Previous" link if a "Next" was clicked
		if ($prev >= 0)
		    echo '<li class="previous"><a class="btn btn-default" href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'"><span aria-hidden="true">&larr;</span> Previous</a></li>';
	?>
<?PHP
	echo '<li class="next"><a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow + 30).'">Next <span aria-hidden="true">&rarr;</span></a></li>';
?>
  </ul>
</nav>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../js/grayscale.min.js"></script>
	</body>
</html>