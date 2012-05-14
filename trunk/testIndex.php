<?php
	session_start(); //SONST 'Warning: session_start() [function.session-start]: Cannot send session cache limiter'
	print ("<html>");
	print ("<head>");
	print ("</head>");
	print ("<body>");
	
	require_once 'facebookTracking.php';

	$facebook2 = new FacebookTracking("facebook.php", "serviceRoutines.php", "http://www.einfach-wir.net/daniel/fb2/testIndex.php", "294040014004290", "942bf9f89444df74c4dd36701a24e25a");
	
	//Name
	print ("<b>Name:</b> " . $facebook2->getUser_Name());
	print ("</br>");
	print ("</br>");
	
	//Profilbild
	print ("<img src=\"" . $facebook2->getUser_PictureSource() . "\" />");
	print ("</br>");
	
	//College
	$colleges = $facebook2->getUser_Colleges();
	print ("</br>");
	print ("<b>Colleges:</b>");
	print ("</br>");
	foreach ($colleges as $college)
	{
		print ($college);
		print ("</br>");
	}
	print ("<b>Anzahl Colleges: </b>" . $facebook2->getUser_NumberOfColleges());
	print ("</br>");
	
	//Geschlecht
	print ("</br>");
	print ("<b>Geschlecht: </b>" . $facebook2->getUser_Gender());
	print ("</br>");
	
	//Beziehungsstatus
	print ("</br>");
	print ("<b>Beziehung: </b>" . $facebook2->getUser_RelationshipStatus());
	print ("</br>");
	
	//Geburtstag
	print ("</br>");
	print ("<b>Geburtstag: </b>" . $facebook2->getUser_Birthday());
	print ("</br>");
	
	//E-Mail
	print ("</br>");
	print ("<b>E-Mail: </b>" . $facebook2->getUser_EMail());
	print ("</br>");
	
	//Stadt
	print ("</br>");
	print ("<b>Stadt: </b>" . $facebook2->getUser_Town());
	print ("</br>");
	
	//Arbeit
	$works = $facebook2->getUser_Works();
	print ("</br>");
	print ("<b>Arbeiten:</b>");
	print ("</br>");
	foreach ($works as $work)
	{
		print ($work);
		print ("</br>");
	}
	print ("<b>Anzahl Arbeiten: </b>" . $facebook2->getUser_NumberOfWorks());
	print ("</br>");
	
	//Webseite
	print ("</br>");
	print ("<b>Webseite: </b>" . $facebook2->getUser_Website());
	print ("</br>");
	
	//Politik
	print ("</br>");
	print ("<b>Politik: </b>" . $facebook2->getUser_Political());
	print ("</br>");
	
	//Religion
	print ("</br>");
	print ("<b>Relgion: </b>" . $facebook2->getUser_Religion());
	print ("</br>");
	
	//Sprachen
	$languages = $facebook2->getUser_Languages();
	print ("</br>");
	print ("<b>Sprachen:</b>");
	print ("</br>");
	foreach ($languages as $language)
	{
		print ($language);
		print ("</br>");
	}
	print ("<b>Anzahl Sprachen: </b>" . $facebook2->getUser_NumberOfLanguages());
	print ("</br>");	
	
	//Spiele
	$games = $facebook2->getUser_Games();
	print ("</br>");
	print ("<b>Spiele:</b>");
	print ("</br>");
	foreach ($games as $game)
	{
		print ($game);
		print ("</br>");
	}
	print ("<b>Anzahl Spiele: </b>" . $facebook2->getUser_NumberOfGames());
	print ("</br>");
	
	//Gruppen
	$groups = $facebook2->getUser_Groups();
	print ("</br>");
	print ("<b>Gruppen:</b>");
	print ("</br>");
	foreach ($groups as $group)
	{
		print ($group);
		print ("</br>");
	}
	print ("<b>Anzahl Gruppen: </b>" . $facebook2->getUser_NumberOfGroups());
	print ("</br>");
	
	//Likes
	$likes = $facebook2->getUser_Likes();
	print ("</br>");
	print ("<b>Likes:</b>");
	print ("</br>");
	foreach ($likes as $like)
	{
		print ($like);
		print ("</br>");
	}
	print ("<b>Anzahl Likes: </b>" . $facebook2->getUser_NumberOfLikes());
	print ("</br>");
	
	//Freunde
	$friends = $facebook2->getUser_Friends();
	print ("</br>");
	print ("<b>Freunde:</b>");
	print ("</br>");
	foreach ($friends as $friend)
	{
		print ($friend);
		print ("</br>");
	}
	print ("<b>Anzahl Freunde: </b>" . $facebook2->getUser_NumberOfFriends());
	
	//Interessen
	$interests = $facebook2->getUser_Interests();
	print ("</br>");
	print ("<b>Interessen:</b>");
	print ("</br>");
	foreach ($interests as $interest)
	{
		print ($interest);
		print ("</br>");
	}
	print ("<b>Anzahl Interessen: </b>" . $facebook2->getUser_NumberOfInterest());
	
	//Aktivitäten
	$activities = $facebook2->getUser_Activities();
	print ("</br>");
	print ("<b>Aktivitäten:</b>");
	print ("</br>");
	foreach ($activities as $activity)
	{
		print ($activity);
		print ("</br>");
	}
	print ("<b>Anzahl Aktivitäten: </b>" . $facebook2->getUser_NumberOfActivities());
	
	//Bücher
	$books = $facebook2->getUser_Books();
	print ("</br>");
	print ("<b>Bücher:</b>");
	print ("</br>");
	foreach ($books as $book)
	{
		print ($book);
		print ("</br>");
	}
	print ("<b>Anzahl Bücher: </b>" . $facebook2->getUser_NumberOfBooks());
	
	//Events
	$events = $facebook2->getUser_Events();
	print ("</br>");
	print ("<b>Events:</b>");
	print ("</br>");
	foreach ($events as $event)
	{
		print ($event);
		print ("</br>");
	}
	print ("<b>Anzahl Events: </b>" . $facebook2->getUser_NumberOfEvents());
	
	//Interessen an
	$interests = $facebook2->getUser_InterestsIn();
	print ("</br>");
	print ("<b>Interests:</b>");
	print ("</br>");
	foreach ($interests as $interest)
	{
		print ($interest);
		print ("</br>");
	}
	print ("<b>Anzahl Interesse: </b>" . $facebook2->getUser_NumberOfInterestIn());
	
	
	print ("<b>Anzahl Interesse: </b>" . $facebook2->getUser_Checkins_FQL());
	
	
    //User-Checkins
	$checkins = $facebook2->getUser_Checkins();
	print ("</br>");
	print ("<b>User-Checkins:</b>");
	print ("</br>");
	foreach ($checkins as $check)
	{
		print ($check);
		print ("</br>");
	}
	print ("<b>Anzahl User-Checkins: </b>" . $facebook2->getUser_NumberOfCheckins());*/
	
	
	
	print ("</body>");
	print ("</html>");
?>