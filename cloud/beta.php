<?php
	
	include_once('settings.php');
	include_once('dbLib.php');

	extract($_REQUEST);

	// If $email is not defined / does not exist, report an error!
	if(!isset($email)){

		echo "Please enter an e-mail address!\n";
		return;
	}

	// validate email using the built-in PHP function 'filter_var'
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    // echo "This ($email) email address is considered valid.\n";
	} else {
		echo "Not a legit e-mail address!\n";
		return;
	}

	// If the e-mail IS valid, how do we know
	// that this e-mail address isn't already registered?
	$sameEmails= dbMassData("SELECT * FROM betaUsers WHERE email = '$email'");

	if($sameEmails !=null){

		echo "That email address is already signed up. Good lookin' out!\n";
		return;
	}

	// Very original: dbQuery("INSERT INTO betaUsers (email) VALUES '$email'");
	// dbQuery("INSERT INTO `betaUsers` (`email`) VALUES ('$email')");
	dbQuery("INSERT INTO betaUsers (email) VALUES ('$email')");

	echo("Booya! We'll hit you up at " . $email . " as the release date approaches!");

?>