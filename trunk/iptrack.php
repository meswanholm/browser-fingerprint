<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<meta name="author" content="Till">
<meta name="editor" content="html-editor phase 5">
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<link rel="stylesheet" type="text/css" href="index.css">
<style type="text/css">
/* ... hier sind dateispezifische Formate erlaubt ... */
</style>

</head>
<body text="#000000" bgcolor="#BDBDBD" link="#FF0000" alink="#FF0000" vlink="#FF0000" >
<div id="ueberschrift">
<h1> Was wir über dich wissen... </h1>
</div>
<div id="info">
<?php
echo "<br> <strong> Angesprochener Server: </strong> ";
$host = $_SERVER["HTTP_HOST"];
$referer = $_SERVER["REFERER"];
$agent = $_SERVER["HTTP_USER_AGENT"];
$addr =$_SERVER["REMOTE_ADDR"];
echo $host;
//echo "<br>";
echo $referer;
echo "<br><strong> Deine IP Addresse: </strong> ";
echo $addr;
echo "<br>";
?>

<script type="text/javascript">
<!--
document.write('<tr class="DataTableBright"><B>Systemzeit:&nbsp;</B>' + new Date() + '&nbsp;<br>');
document.write('<tr class="DataTableDark"><B>Aufloesung:&nbsp;</B>' + screen.width + ' x ' + screen.height + '&nbsp;<br>');
document.write('<tr class="DataTableBright"><B>Farbtiefe:&nbsp;</B>' + screen.colorDepth + ' bit&nbsp;<br>');
document.write('<tr class="DataTableDark"><B>Cookies aktiviert:&nbsp;</B>');
                        if(navigator.cookieEnabled==true) document.write('ja'); else document.write('nein');
                        document.write('&nbsp;<br>');
document.write('<tr class="DataTableBright"><B>Plattform:</B>' + navigator.platform + '&nbsp;<br>');

document.write('<tr class="DataTableDark"><B>Java aktiviert:&nbsp;</B>');
                        if(navigator.javaEnabled()==true) document.write('ja'); else document.write('nein');
                        document.write('&nbsp;<br>');
document.write('<tr class="DataTableBright"><B>Installierte Browser-Plugins:&nbsp;</B>');
document.write('<ul>');
                        for(var i=0; i<navigator.plugins.length; i++)
                        {
                            document.write('<li>');
                            document.write(navigator.plugins[i].name + ' [' + navigator.plugins[i].filename + ']');
                        }
						document.write('</ul>');
                        document.write('&nbsp;<br>');
//--></script>
</div>
<div id="map">
<p> <strong> Du befindest dich in dieser Region: <br></strong></p>
<div id="pos" style="width:600px; height:400px;">
<p>Deine Position wird ermittelt...</p>
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
    
<h2><br>... und noch viel mehr - klick  <a href="http://www.einfach-wir.net/daniel/fb2/testIndex.php">hier</a> </h2> <p> (Über den Link gelangst du nach erfolgreichem Facebook Login zu einer Seite, <br> die dir Auskunft über deine Facebookaktivitäten gibt)
</div>
<div id="datenschutz">
<h3>
Informationen zum Datenschutz
</h3>
<p> 
Über die Verlinkung wirst du zum Facebook Login weitergeleitet.
<br> Nach erfolgreicher Anmeldung bekommst du eine kleine Demonstration über die Daten, die jede App über dich sammeln kann, nachdem du die Vereinbarungen akzeptiert hast. 
<br> Wir sammeln weder Daten von dir, noch werden diese in irgendeiner Form weitergegeben. Diese Demonstration soll dir lediglich einen Eindruck verschaffen, was für Daten bei Facebook im Hintergrund an fremde Firmen gelangen.
<br><br>
</p>
<p>
Diese Seite entstand im Rahmen des Multimedia Projekts 2012 des Studiengangs Online Medien Management
</p>
</div>
</body>
</html>