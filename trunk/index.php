<!--http://www.abouttheweb.de/tutorials/facebook/die-bibliotheken-fuer-facebook-anwendungen-->
<!--http://www.abouttheweb.de/tutorials/facebook/die-facebook-javascript-sdk-eine-einfuehrung-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Was wir über Dich erfahren können</title>
    <script src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
  </head>
  <body>
	<!--Javascript SDK wird asynchron geladen-> Empfehlung Facebook direkt nach dem <body> tag-->

    <!-- Login/Logout --> 
	<div id="fb-root"></div>
    <script src="http://connect.facebook.net/de_DE/all.js"></script>
    <script>
      FB.init({
        appId  : '294040014004290', // Anwendungs ID
		secret : '942bf9f89444df74c4dd36701a24e25a',
        status : true, // Login Status prüfen
        cookie : true, // Cookies nutzen
        xfbml  : true  // XFBML parsen
      });
    </script>
	
	<fb:login-button size="large" autologoutlink="true"></fb:login-button>
  </body>
</html>