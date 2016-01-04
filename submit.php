<?php
$email_message = "";
$email_from = $_POST['email']; // required
$songs = isset($_POST['selectedSongForm']) ? $_POST['selectedSongForm'] : '';

function listSongs($songs) { //Undefined index
     $fullList = "";
     foreach ($songs as $selected) { //Invalid argument supplied for foreach() in
        $fullList .= "<li>".$selected."</li>";
    }
    return $fullList;
}

if(isset($_POST['email'])) {
    $error_message = "";

    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }

    // $email_to = "martinrobitaille_@hotmail.com";
    $email_to = "plansmash@me.com";
    $email_subject = "Requested songs by: " . $email_from;

    // validation expected data exists
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp,$email_from)) {
		$error_message .= '<p>The Email Address you entered does not appear to be valid.</p><p>Please return back to the <a href="index.html?'. rand() .'">list of songs</a> and supply an valid email address</p>';
	}
    //Email message
    $email_message = "<html><body><h1>List of songs</h1>";
    $email_message .= "<ol>".listSongs($songs)."</ol>";
    $email_message .= "<p>Email: ".clean_string($email_from)."</p></body></html>";

    // create email headers
    $headers = "From: " . strip_tags($_POST['email']) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
    $headers .= "CC: plansmash@me.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

	@mail($email_to, $email_subject, $email_message, $headers);

    echo "<h1>Thank you for submitting us your requested songs. We will be in touch with you very soon.</h1>";
    echo $email_message;
    echo '<p><a href="index.html?'.rand().'">Back</a></p>';
}
?>
