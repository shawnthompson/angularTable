<?php
     
    require '../inc/connect.php';
 
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
            $songError = 'Please enter song';
            $valid = false;
        }
         
        if (empty($artist)) {
            $artistError = 'Please enter artist';
            $valid = false;
        }
         
        if (empty($genre)) {
            $genreError = 'Please enter genre';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tracks (Song,Artist,Genre,TopSong) values (?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($song,$artist,$genre,$topSong));
            Database::disconnect();
            header("Location: ../inc/convert.php");
        }
    }
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


<h1 id="addSongLabel">Add Song</h2>
<form action="create.php" method="post">

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
<input id="top-yes" type="radio" name="topSong" value="true">
<label class="radio-inline" for="top-yes">Yes</label><br>
<input id="top-no" type="radio" name="topSong" checked="checked" value="">
<label class="radio-inline" for="top-no">No</label><br>
</fieldset>


<div class="form-action mrgn-tp-lg">
<p class="btn btn-default"><a href="index.php">Cancel</a></p>
<button type="submit" class="btn btn-default">Add Song</button>
</div>
</form>
</div>


<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../js/grayscale.min.js"></script>
</body>
</html>
