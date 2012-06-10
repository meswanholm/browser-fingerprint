<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta name="author" content="Till">
<meta name="editor" content="html-editor phase 5">
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
</head>
<body text="#000000" bgcolor="#FFFFFF" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<h1> Was wir über dich wissen... </h1>
<a <div align="right"><img src="images\omm_orange_trans.png" border="0" Alt="Online Medien Management"></a>
<p><img src="images\omm_orange_trans.png" alt="OMM"></p>
<?php
echo "<br> Angesprochener Server: ";
$host = $_SERVER["HTTP_HOST"];
$referer = $_SERVER["REFERER"];
$agent = $_SERVER["HTTP_USER_AGENT"];
$addr =$_SERVER["REMOTE_ADDR"];
echo $host;
//echo "<br>";
echo $referer;
echo "<br> Dein System: ";
echo $agent;
echo "<br> Deine IP Addresse: ";
echo $addr;
?>
<div id="pos" style="width:600px; height:400px;">
        Deine Position wird ermittelt...
    </div>
    
    <script>
        function initialize(coords) {
            var latlng = new google.maps.LatLng(coords.latitude, coords.longitude);
            var myOptions = {
                zoom: 8,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("pos"), myOptions);
            
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: "Hier bist du :)"
            });
        }
  
        navigator.geolocation.getCurrentPosition(function(position){
            initialize(position.coords);
        }, function(){
            document.getElementById('pos').innerHTML = 'Deine Position konnte leider nicht ermittelt werden';
        });
    </script>
    
<br>... und noch viel mehr - klick  <a href="http://www.einfach-wir.net/daniel/fb2/testIndex.php">hier</a>

<h3>
Informationen zum Datenschutz
</h3>
<p> 
Über die Verlinkung wirst du zum Facebook Login weitergeleitet.
<br> Nach erfolgreicher Anmeldung bekommst du eine kleine Demonstration über die Daten, die jede App über dich sammeln kann, nachdem du die Vereinbarungen akzeptiert hast. 
<br> Wir sammeln weder Daten von dir, noch werden diese in irgendeiner Form weitergegeben. Diese Demonstration soll dir lediglich einen Eindruck verschaffen, was für Daten bei Facebook im Hintergrund an fremde Firmen gelangen.
<br> Viel Spass
</p>
<p>
Diese Seite entstand im Rahmen des Multimedia Projekts 2012
</p>
</body>
</html>