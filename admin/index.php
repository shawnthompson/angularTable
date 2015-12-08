<?php
    require '../inc/connect.php';
// Order
$orderBy = array('Artist', 'Song', 'Genre');
$order = 'Song';
if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
    $order = $_GET['orderBy'];
}


$pdo = Database::connect();
$sql = "SELECT * FROM tracks ORDER by " . $order;

?>

<!DOCTYPE html>
<html lang="en" ng-app="sortApp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoundTraxx - Ottawa DJ - Songs</title>
    <!-- CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.2.0/sandstone/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/grayscale.min.css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/base.min.css">

    <!-- JS -->
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

<div class="container main" ng-controller="mainController">
	<h1>SoundTraxx - Ottawa DJ - Songs</h1>



<!-- Delete Modal -->

<div class="modal fade" id="deleteMessage" tabindex="-1" role="dialog" aria-labelledby="deleteMessageLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h2 class="modal-title" id="deleteMessageLabel">Delete</h2>
      </div>
      <div class="modal-body">
      	<p>Are you sure you want to delete <b><i><span class="modal-text"></span></i></b>? If you delete this song, you will have to add it again. There is no undo.</p>
      </div>
      <div class="modal-footer">
        <a href="delete.php?id=" class="btn btn-default">Yes</a>
        <button class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

<!-- / Delete Modal -->

<p><a href="create.php" class="btn btn-default btn-lg">Add song</a></p>

  <table class="table table-bordered table-striped table-responsive">
	<thead>
	  <tr>
		<th><a href="?orderBy=Song">Song</a></th>
		<th><a href="?orderBy=Artist">Artist</a></th>
		<th><a href="?orderBy=Genre">Genre</a></th>
		<th>Edit</th>
		<th>Delete</th>
	  </tr>
	</thead>
    <tbody>
	    <?php
foreach ($pdo->query($sql) as $row) {	    ?>
	<tr<?php if ($row["TopSong"] != ""){echo ' class="topSong"';}?>>
		<td><?php echo $row["Song"] ?></td>
		<td><?php echo $row["Artist"] ?></td>
		<td><?php echo $row["Genre"] ?></td>
		<td><a href="update.php?id=<?php echo $row['ID'] ?>" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a></td>
		<td><a class="btn btn-default btn-sm" data-toggle="modal" data-target="#deleteMessage" data-song="<?php echo $row['Song'] ?>" data-id="<?php echo $row['ID'] ?>"><i class="fa fa-minus"></i></a></td>
		<?php 
    }
    Database::disconnect();
		?>	
	</tr>
	</tbody>
</table>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../js/grayscale.min.js"></script>
<script>
	$('#deleteMessage').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var songTitle = button.data('song') // Extract info from data-* attributes
  var songID = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-text').text(songTitle)
  // modal.find('.modal-footer a.btn-default').text(songID)
  // modal.find('.modal-body input').val(songTitle)
  var _href = $(".modal-footer a.btn-default").attr("href");
  $(".modal-footer a.btn-default").attr("href", _href + (songID));
})
</script>

	</body>
</html>