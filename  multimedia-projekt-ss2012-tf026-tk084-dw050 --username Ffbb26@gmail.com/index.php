
<?php
    
    // Pruefen ob der Browser Cookies akzeptiert
    if(isset($_COOKIE['browser_check'])) {
        $browser_check = true;
    }elseif($_GET['check'] != 1) {
        
        @setcookie("browser_check","set",time()+3600);
        header("Location: index.php?check=1");
                
                    
    }
            
    include("inc.php");
    
    // Wenn $_GET['logout'] gesetzt ist dann loesche $_SESSION['success']
    if(isset($_GET['logout'])) {
        
        // Wenn $_COOKIE['login_cookie'] gesetzt ist dann loesche Cookie
        if(isset($_COOKIE['login_cookie'])) @setcookie("login_cookie",0,time()-3600);
        
        // Loesche SESSION['success']
        unset($_SESSION['success']);
        
        //Leite weiter zur index.php
        header("Location: index.php");
        
    }
    
    // Wenn $_COOKIE['login_cookie'] gesetzt ist dann ueberpruefe den Inhalt und fuehre ggf. den auto login aus
    if(isset($_COOKIE['login_cookie']) AND !isset($_POST['sender']) AND !isset($_GET['logout'])) {
        
        // Hole den Inhalt aus dem Cookie
        $cookie_inhalt = $_COOKIE['login_cookie'];
        
        // Trenne benutzername und kennwort anhand des Trennzeichens @
        $cookie_inhalt = explode("@",$cookie_inhalt);
        
        // Gehe mit Cookiedaten in die login funktion
        login($cookie_inhalt[0],$cookie_inhalt[1],1,2);
        
    }
        
    // Wenn Sumbit gepostet wurde    
     if(isset($_POST['sender'])) {
     
         // Wenn Cookie setzen "aktiv"
         if($_POST['co'] == 'on') {
                 
             if(login($_POST['username'],$_POST['password']) == false) {
                 
                 echo "Sry da hat was nicht geklappt";
                 
             }
                     
         }else {
                 
             if(login($_POST['username'],$_POST['password'],2,1) == false) {
                 
                 echo "Sry da hat was nicht geklappt";
                 
             }
                 
         } else {
         	echo "WAt";
         	}    
     }
    
     

?>


<html>
<head>
    <title>test</title>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" >
<?php 

if(isset($_SESSION['success'])) {
        
    echo "drin<br><a href='index.php?logout=true'>Logout</a>";

    
}else {
    
?>

<form target="_self" method="post" name="main">
<?php if(!isset($browser_check)) echo "Ihr Browser akzeptiert keine Cookies, daher wird dieses Feld deaktiviert<br><br>"; ?>
User : <input type="text" name="username"><br>
Pass : <input type="text" name="password"><br>
Cookie (ja/nein) : <input type="checkbox" name="co" <?php if(!isset($browser_check)) echo "disabled";?>><br>
<input type="submit" name="sender">

</form>

<?php } ?>

</body>
</html>