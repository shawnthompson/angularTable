<?php
require '../inc/connect.php';
$title = "Administration of tracks";
$path = "../";
// Order
$orderBy = array('Artist', 'Song', 'Genre');
$order = 'ID';
if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)) {
		$order = $_GET['orderBy'];
}

$customScript = "
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
	var _href = $('.modal-footer a.btn-default').attr('href');
	$('.modal-footer a.btn-default').attr('href', _href + (songID));
})
	$(document).ready(function () {
		var now = (new Date()).getTime();

		$('a.force-reload').prop('href', function () {
				return $(this).data('href') + '?' + now;
		});
});
</script>
";

$pdo = Database::connect();
$sql = "SELECT * FROM tracks ORDER by " . $order;
include "../inc/head.php";
?>

<main class="main col-xs-12">
	<h1><?php echo $title; ?></h1>
    <p>Songs in <strong class="topSong">orange</strong> are in the top 200 requested songs</p>
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

<p class="pull-left"><a class="force-reload" data-href="../index.php"><i class="fa fa-chevron-circle-left"></i> Back to App</a></p>
<p class="pull-right"><a href="create.php" class="btn btn-default">Add song</a></p>

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
</main>
<?php include "../inc/foot.php";?>




