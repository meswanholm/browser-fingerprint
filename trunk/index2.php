<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('library/src/facebook.php');

  $config = array(
    'appId' => '294040014004290',
    'secret' => '942bf9f89444df74c4dd36701a24e25a',
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
?>
<html>
  <head>
  </head>
  <body>

  <?php
    if($user_id) //Benutzer ist eingeloggt 
	{
      try 
	  {
        //Benutzer Informationen, davor Erlaubnis erfragen
		$user_profile = $facebook->api("/" . $user_id, "GET");
		//ID
		echo "ID: " . $user_profile['id'];
		echo "</br>";
		//NAME
		echo "Name: " . $user_profile['name'];
		echo "</br>";
		//HOCHSCHULE/SCHULE
		echo $user_profile['education']['0']['type'] . ": " . $user_profile['education']['0']['school']['name'];
		echo "</br>";
		//GESCHLECHT
		if ($user_profile['gender'] == 'male')
			echo "Geschlecht: m&aumlnnlich"; 
		else
			echo "Geschlecht: weiblich";
		//PROFILBILD
		echo "<img src=\"http://graph.facebook.com/" . $user_id . "/picture?type=large\" />";
		echo "</br>";
		//FREUNDE
		$friends = $facebook->api("/" . $user_id . "/friends", "GET"); 
		$friendsData = $friends['data'];
		//Anzahl Freunde
		echo "Anzahl Freunde: " . sizeof($friendsData);
		echo "</br>";
		
		for ($i = 0; $i < sizeof($friendsData); $i++) 
		{ 
           $friend = $friendsData[$i]; 
                     echo $friend['name'];
					 echo "</br>";
        }; 
		//GRUPPEN
		$groups = $facebook->api("/" . $user_id . "/groups", "GET"); 
		$groupsData = $groups['data'];
		//Anzahl Gruppen
		echo "Anzahl Gruppen: " . sizeof($groupsData);
		echo "</br>";
		
		for ($i = 0; $i < sizeof($groupsData); $i++) 
		{ 
           $group = $groupsData[$i]; 
                     echo $group['name'];
					 echo "</br>";
        }; 
		//GEBURTSTAG
		echo "Geburtstag: " . $user_profile['birthday'];
		
			
			
			
		//Logout-Button Generierung
		$params = array( 'next' => 'http://localhost/index2.php'); //Wo geht es hin nach dem Logout?
		$logout_url = $facebook->getLogoutUrl($params); // $params is optional. 
		echo '<p><a href="' . $logout_url . '">Logout</a></p>';
      } 
	  catch(FacebookApiException $e) 
	  {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
		//Berechtigungen einholen
		$params = array(
			'fbconnect' => 0,
			'canvas' => 1,
			'req_perms' => 'user_birthday, user_interests, user_photos, user_groups',
		);

		// No user, print a link for the user to login
		$login_url = $facebook->getLoginUrl();
        echo '<a href="' . $login_url . '">Login</a>';
		echo "ERROR";
		//print '<script>top.location.href = "' . $login_url . '"</script>'; // Weiterleitung zum Anfordern der Autorisierung
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } 
	else //Benutzer ist noch nicht eingeloggt
	{
	  //Berechtigungen einholen
	  $params = array(
		'fbconnect' => 0,
		'canvas' => 1,
		'req_perms' => 'user_birthday, user_interests, user_photos, user_groups',
	  );

      // No user, print a link for the user to login
      $login_url = $facebook->getLoginUrl();
	  //echo '<a href="' . $login_url . '">Login</a>';
	  print '<script>top.location.href = "' . $login_url . '"</script>'; // Weiterleitung zum Anfordern der Autorisierung
    }
  ?>

  </body>
</html>