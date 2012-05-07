<?php
 
require 'library/src/facebook.php';
 
$facebook = new Facebook(array(
  'appId'  => '294040014004290', // Anwendungs ID
  'secret' => '942bf9f89444df74c4dd36701a24e25a', // Anwendungs-Geheimcode
  'cookie' => true, // enable optional cookie support
));
 
if ($session = $facebook->getUser()) 
{// Session vorhanden?
  try 
  {
    $me = $facebook->api('/me'); // Daten üder API abfragen.
    print '<pre>' . print_r($me, true) . '</pre>'; // Ausgabe der persönlichen Daten.
    print '<pre>' . print_r($session, true) . '</pre>'; // Ausgabe der Sessiondaten.
  } 
  catch (FacebookApiException $e) 
  {
    print $e;
  }
} 
else 
{// Keine Session vorhanden.
  $params = array(
    'fbconnect' => 0,
    'canvas' => 1,
  );
 
  $loginUrl = $facebook->getLoginUrl($params); // URL zum Autorisierungsdialog erstellen.
  print '<script>top.location.href = "' . $loginUrl . '"</script>'; // Weiterleitung zum Anfordern der Autorisierung.
}
?>