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
		$user_profile = $facebook->api('/me','GET');
		echo "ID: " . $user_profile['id']; //ID
		echo "</br>";
		echo "Name: " . $user_profile['name']; //Name
		echo "</br>";
		echo $user_profile['education']['0']['type'] . ": " . $user_profile['education']['0']['school']['name']; //Hochschule/Schule
		echo "</br>";
		if ($user_profile['gender'] == 'male') //Geschlecht
			echo "Geschlecht: m&aumlnnlich"; 
		else
			echo "Geschlecht: weiblich";
		echo "<img src=\"http://graph.facebook.com/" . $user_id . "/picture?type=large\" />"; //Profilbild
		
		$access_token = $facebook->getAccessToken();
		echo $access_token;
		
		$data = $facebook->api("https://graph.facebook.com/" . $user_id . "/groups");
		print '<pre>' . print_r($data, true) . '</pre>';
			
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
        $login_url = $facebook->getLoginUrl();
        echo '<a href="' . $login_url . '">Login</a>';
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
      $login_url = $facebook->getLoginUrl($params);
	  print '<script>top.location.href = "' . $loginUrl . '"</script>'; // Weiterleitung zum Anfordern der Autorisierung
    }
  ?>

  </body>
</html>