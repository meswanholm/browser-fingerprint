<?php
	//Objekt der Klasse ServiceRoutines wird erzeugt
	require_once 'facebookTracking.php';
	$facebook2 = new FacebookTracking("facebook.php", "serviceRoutines.php");
	
	$friends = $facebook2->getUser_Friends();
	
	foreach ($friends as $friend)
	{
		echo ($friend);
	}
	
	
	echo ($facebook2->getUser_NumberOfFriends());
?>