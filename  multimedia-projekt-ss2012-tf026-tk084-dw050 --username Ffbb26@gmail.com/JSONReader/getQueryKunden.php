<?php
	mysql_connect("localhost","root","");
    mysql_select_db("androidkunden");
    $q=mysql_query("SELECT * FROM kunden WHERE isgrosskunde='".$_REQUEST['isgrosskunde']."'");
    while($e=mysql_fetch_assoc($q))
        $output[]=$e;
	print(json_encode($output));
	mysql_close();
?>
