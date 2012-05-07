<html>
    <head>
        <title>Meine ersten Ajax Erfahrungen</title>
        <script type="text/javascript">
         <!--    
              var req = null;
              
             function handleTranslation(){            
                switch(req.readyState) {
                    case 4:
                        if(req.status!=200) {
                            alert("Fehler:"+req.status); 
                        }else{    
                            //felder des formulars
                            german_field = document.getElementById("german");
                            french_field = document.getElementById("french");
                            
                            //antwort des servers
                            xml = req.responseXML;
                            german_resp = xml.getElementsByTagName("german")[0];
                            french_resp = xml.getElementsByTagName("french")[0];
                            
                            //schreiben des ergebnisses
                            german_field.value = german_resp.firstChild.nodeValue;
                            french_field.value = french_resp.firstChild.nodeValue;
                        }
                    break;
            
                    default:
                        return false;
                    break;     
                }
            }
            
             function translate(){         
                 //erstellen des requests
                 
                try{
                    req = new XMLHttpRequest();
                }
                catch (e){
                    try{
                        req = new ActiveXObject("Msxml2.XMLHTTP");
                    } 
                    catch (e){
                        try{
                            req = new ActiveXObject("Microsoft.XMLHTTP");
                        } 
                        catch (failed){
                            req = null;
                        }
                    }  
                }

                if (req == null)
                      alert("Error creating request object!");
                  
                  //anfrage erstellen (GET, url ist localhost,
                  //request ist asynchron      
                  var url = 'http://localhost/ajax-tutorial/zwei/ajax.php?translate='+
                              document.getElementById('myword').value;

                  req.open("GET", url, true);

                //Beim abschliessen des request wird diese Funktion ausgeführt
                req.onreadystatechange = handleTranslation;
  
                  req.setRequestHeader("Content-Type",
                                      "application/x-www-form-urlencoded");
                req.send(null);
            }
         //-->
        </script>
    </head>
    <body>
        <div id="eins" style="width: 80%; height: 80%; border: dashed 1px;">
            englisch: <input type="text" id="myword" onchange="translate();" /><br />
            deutsch: <input type="text" id="german" /><br />
            französisch: <input type="text" id="french" /><br />
        </div>
    </body>
</html>