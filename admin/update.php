<?php
    require '../inc/connect.php';
    $title = "Update track";
    $path = "../";

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if ( null==$id ) {
        header("Location: index.php");
    }

    if ( !empty($_POST)) {
        // keep track validation errors
        $songError = null;
        $artistError = null;
        $genreError = null;

        // keep track post values
        $song = $_POST['song'];
        $artist = $_POST['artist'];
        $genre = $_POST['genre'];
        $topSong = $_POST['topSong'];

        // validate input
        $valid = true;
        if (empty($song)) {
            $songError = 'Please enter song title';
            $valid = false;
        }

        if (empty($artist)) {
            $artistError = 'Please enter an artist';
            $valid = false;
        }

        if (empty($genre)) {
            $genreError = 'Please enter a genre';
            $valid = false;
        }

        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE tracks set Song = ?, Artist = ?, Genre =?, TopSong =? WHERE ID = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($song,$artist,$genre,$topSong,$id));
            Database::disconnect();
            header("Location: ../inc/convert.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tracks where ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $song = $data['Song'];
        $artist = $data['Artist'];
        $genre = $data['Genre'];
        $topSong = $data['TopSong'];
        Database::disconnect();
    }
include "../inc/head.php";
?>
<main class="main col-xs-12">
    <h1><?php echo $title; ?></h1>
    <form action="update.php?id=<?php echo $id?>" method="post">
        <div class="form-group <?php echo !empty($songError)?'error':'';?>">
            <label for="addSongTitle" class="control-label">Song:</label>
            <input name="song" value="<?php echo !empty($song)?$song:'';?>" placeholder="Enter song title" type="text" class="form-control" id="addSongTitle">
            <?php if (!empty($songError)): ?>
            <span class="help-block"><?php echo $songError;?></span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo !empty($artistError)?'error':'';?>">
            <label for="addSongArtist" class="control-label">Artist:</label>
            <input name="artist" value="<?php echo !empty($artist)?$artist:'';?>" placeholder="Enter artist name" type="text" class="form-control" id="addSongArtist">
            <?php if (!empty($artistError)): ?>
            <span class="help-block"><?php echo $artistError;?></span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php echo !empty($genreError)?'error':'';?>">
            <label for="addSongGenre" class="control-label">Genre:</label>
            <input name="genre" value="<?php echo !empty($genre)?$genre:'';?>" placeholder="Enter genre" type="text" class="form-control" id="addSongGenre">
            <?php if (!empty($genreError)): ?>
            <span class="help-block"><?php echo $genreError;?></span>
            <?php endif; ?>
        </div>
        <fieldset>
            <legend>Top Song:</legend>
            <input id="yes" type="checkbox" name="topSong" value="true" <?php if ($topSong != ""){ echo ' checked';}?>>
            <label class="radio-inline" for="yes">Yes</label><br>
        </fieldset>
        <div class="form-action mrgn-tp-lg">
            <p class="btn btn-default"><a href="index.php">Cancel</a></p>
            <button type="submit" class="btn btn-default">Update</button>
        </div>
    </form>
</main>
<?php include "../inc/foot.php" ?>