<?php

    @session_start();    

    @mysql_connect("localhost","dw050","Uneec2ohza");
        @mysql_select_db("u-dw050");
    
    function check_string($string) {
                
        // erlaubte zeichen a-z,A-Z,0-9,-,_
                
        if((preg_match('/^[a-zA-Z0-9\-\_]+$/',$string))) return true;
                
        return false;
            
    }
    
    
    function login($benutzername,$kennwort,$modus=1,$cookie_gelesen=1) {
    
        // ############# Konfiguration start #############
    
        // ### Cookies ###
    
        // Name des Cookies
        $conf['cookie_name'] = "login_cookie";
    
        // Ablaufzeit des Cookies (1 Monat)
        $conf['cookie_zeit'] = time()+3600*24*7*4;
    
        // Inhalt des Cookies (Wird im spaeterem Verlauf festgelegt)
        $conf['cookie_inhalt'] = "";
    
        // ### Sonstiges ### 
    
        // Modus ( 1 = Session und Cookie setzen / 2 = Session ohne Cookie setzen )
        $conf['modus'] = $modus;
        
        // CookieSet ( 1 = Benutzername und Kennwort sind nicht aus einem Cookie entnommen / <1 = Benutzername und Kennwort sind einem Cookie entnommen somit ist das Kennwort schon verschluesselt )
        $conf['cookie_gelesen'] = $cookie_gelesen;
        
        // ### Variablen ###
        
        // Benutzername
        $vars['benutzername'] = htmlspecialchars(trim($benutzername));
        
        // Kennwort
        $vars['kennwort'] = htmlspecialchars(trim($kennwort));
        
        // ############# Konfiguration ende #############
        
        // Ist der Benutzername oder das Kennwort "leer" oder sind ungueltige Zeichen im String dann gib ein false wert zurueck        
        if(strlen($vars['benutzername']) == 0 OR strlen($vars['kennwort']) == 0 OR !check_string($vars['benutzername']) OR !check_string($vars['kennwort'])) {
            
            return false;
            
        }else {
            
            // Ist das Kennwort NICHT aus einem Cookie dann muss es mit md5 verschluesselt bzw. verhasht werden            
            if($conf['cookie_gelesen'] == 1) {
                
                $vars['kennwort'] = md5($vars['kennwort']);    
                
            }
            
            // SQL Abfrage ob benutzername und kennwort gleich den in der Datenbank sind            
            $sql = @mysql_query("SELECT name FROM user WHERE name = '".$vars['benutzername']."' AND pass = '".$vars['kennwort']."' ");
            
            // Ist die Abfrage erfolgreich dann check den Modus            
            if(@mysql_num_rows($sql) == 1) {
            
                
                if($conf['modus'] == 1) {
                
                    // Cookie Inhalt wird aus benutzername@kennwort zusammengebaut                    
                    $conf['cookie_inhalt'] = $vars['benutzername']."@".$vars['kennwort'];
                    
                    // Cookie wird gesetzt                    
                    @setcookie($conf['cookie_name'],$conf['cookie_inhalt'],$conf['cookie_zeit']);
                        
                    // Session fÃ¼r den login wird gesetzt                    
                    $_SESSION['success'] = true;
                        
                    return true;
                    
                }else {
                
                    // Session fÃ¼r den login wird gesetzt                    
                    $_SESSION['success'] = true;
                        
                    return true;    
                    
                }    
                    
            }else { 
            
                // SQL Abfrage hat nicht geklappt                    
                return false; 
            
            }
            
        }
        
    }