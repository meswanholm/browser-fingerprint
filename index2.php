<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('library/src/facebook.php');
  //Objekt der Klasse ServiceRoutines wird erzeugt
  require_once 'serviceRoutines.php';
  $serviceRoutines = new ServiceRoutines();

  $config = array(
    'appId' => '294040014004290',
    'secret' => '942bf9f89444df74c4dd36701a24e25a',
  );
  
  $permissions = "user_birthday, user_interests, user_photos, user_groups, user_likes, email, user_about_me, user_hometown, user_work_history";
  $logout_url = "http://www.einfach-wir.net/daniel/fb/index2.php";
  
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
		$access_token = $facebook->getAccessToken();
		
		//http://developers.facebook.com/docs/reference/api/user/
		$user_profile = $facebook->api("/" . $user_id, "GET");
		print '<pre>' . print_r($user_profile, true) . '</pre>'; 
		//ID
		echo "ID: " . $user_profile['id'];
		echo "</br>";
		//NAME
		echo "Name: " . $serviceRoutines->convertSpecialSign($user_profile['name']);
		echo "</br>";
		//HOCHSCHULE/SCHULE
		if ($user_profile['education']['0']['school']['name'] != "")
		{
			echo $serviceRoutines->convertSpecialSign($user_profile['education']['0']['type']) . ": " . $serviceRoutines->convertSpecialSign($user_profile['education']['0']['school']['name']);
			echo "</br>";
		}
		//GESCHLECHT
		if ($user_profile['gender'] != "")
		{
			if ($user_profile['gender'] == 'male')
				echo "Geschlecht: m&aumlnnlich"; 
			else
				echo "Geschlecht: weiblich";
			echo "</br>";
		}
		//GEBURTSTAG
		if ($user_profile['birthday'] != "")
		{
			$birthday = $user_profile['birthday'];
			echo "Geburtstag: " . $birthday[3] . $birthday[4] . "." . $birthday[0] . $birthday[1] . "." . $birthday[6] . $birthday[7] . $birthday[8] . $birthday[9];
		}
		//PROFILBILD
		echo "<img src=\"http://graph.facebook.com/" . $user_id . "/picture?type=large\" />";
		echo "</br>";
		//E-MAIL
		if ($user_profile['email'])
		{
			echo $user_profile['email'];
			echo "</br>";
		}
		//STADT
		if ($user_profile['hometown'] != "")
		{
			echo $serviceRoutines->convertSpecialSign($user_profile['hometown']);
			echo "</br>";
		}
		//ARBEIT
		if ($user_profile != "")
		{
			echo $serviceRoutines->convertSpecialSign($user_profile['work']);
			echo "</br>";
		}
		
		
		
		
		
		
		
		//FREUNDE
		$friends = $facebook->api("/" . $user_id . "/friends", "GET"); 
		$friendsData = $friends['data'];
		$friendsSize = sizeof($friendsData);
		//print '<pre>' . print_r($friendsData, true) . '</pre>'; 
		//Anzahl Freunde
		if ($friendsSize > 0)
		{
			echo "Anzahl Freunde: " . $friendsSize;
			echo "</br>";
		
			for ($i = 0; $i < $friendsSize; $i++) 
			{ 
				$friend = $friendsData[$i]; 
                echo $serviceRoutines->convertSpecialSign($friend['name']);
				echo "</br>";
			};
		}
		//GRUPPEN
		$groups = $facebook->api("/" . $user_id . "/groups", "GET"); 
		$groupsData = $groups['data'];
		$groupsSize = sizeof($groupsData);
		//Anzahl Gruppen
		if ($groupsSize > 0)
		{
			echo "Anzahl Gruppen: " . $groupsSize;
			echo "</br>";
		
			for ($i = 0; $i < $groupsSize; $i++) 
			{ 
				$group = $groupsData[$i]; 
                echo $serviceRoutines->convertSpecialSign($group['name']);
				echo "</br>";
			}; 
		}
		//SPRACHEN
		$languages = $user_profile['languages'];
		for ($i = 0; $i < sizeof($languages); $i++) 
		{ 
           $language = $languages[$i]; 
                     echo $serviceRoutines->convertSpecialSign($language['name']);
					 echo "</br>";
        }; 
		//SPIELE
		$games = $facebook->api("/" .  $user_id . "/games", "GET");
		$gamesData = $games['data'];
		$gamesSize = sizeof($gamesData);
		if ($gamesSize > 0)
		{
			for ($i = 0; $i < $gamesSize; $i++) 
			{ 
				$games = $games[$i]; 
				echo $serviceRoutines->convertSpecialSign($games['name']);
				echo "</br>";
			}; 
		}
		//LIKES
		$likes = $facebook->api("/" .  $user_id . "/likes", "GET");
		$likesData = $likes['data'];
		$likesSize = sizeof($likesData);
		if ($likesSize > 0)
		{
			for ($i = 0; $i < $likesSize; $i++) 
			{ 
				$likes = $likes[$i]; 
				echo $serviceRoutines->convertSpecialSign($likes['name']);
				echo "</br>";
			}; 
		}
	
	
		//Logout-Button Generierung
		$params = array( 'next' => $logout_url); //Wo geht es hin nach dem Logout?
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
			'scope' => $permissions,
		);

		// No user, print a link for the user to login
		$login_url = $facebook->getLoginUrl($params);
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
		'scope' => $permissions,
	  );

      // No user, print a link for the user to login
      $login_url = $facebook->getLoginUrl($params);
	  //echo '<a href="' . $login_url . '">Login</a>';
	  print '<script>top.location.href = "' . $login_url . '"</script>'; // Weiterleitung zum Anfordern der Autorisierung
    }
  ?>

  </body>
</html>