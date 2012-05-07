<!--
/**********************************************************************************************/
/*			                  Source History									              */
/*--------------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Stellt den JQuery Login Dialog zur Verfügung.            					  */
/*				Lädt einzelne Elemente '#refresh' neu, sowie beim Logout die 'logout.php'     */
/*				Blendet Login/Logout Button ein/aus											  */
/*--------------------------------------------------------------------------------------------*/
/*2011-11-18|TF+DW: Erste Version												              */
/*2012-01-31|TF: Enter Schaltfläche implementiert								              */
/*			|TF: Dialog resize auf false										              */
/**********************************************************************************************/
-->

<!--Man kann falls Clienseitig kein JavaScript aktiviert sein sollte einen-->
<!--<noscript>-->
<!--</noscript>-->
<!--Bereich erstellen-->

<link rel="stylesheet" type="text/css" href="login_popup.css" />
<!--Link zum Stylesheet von JQuery-->
<link rel="stylesheet" type="text/css" href="jquery/development-bundle/themes/base/jquery.ui.all.css" />
<!--Kern von JQuery muss hinzugefÃ¼gt werden-->
<script type="text/javascript" src="jquery/development-bundle/jquery-1.6.2.js"></script>
<script type="text/javascript" src="jquery/development-bundle/external/jquery.bgiframe-2.1.2.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.button.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.resizable.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="jquery/development-bundle/ui/jquery.effects.core.js"></script>
<script type="text/javascript">
	$(function() 
	{
		$("#dialog:ui-dialog").dialog("destroy");
		
		var user = $("#user"), password = $("#password"), allFields = user.add(user).add(password), tips = $( ".validateTips" );	
	
		$("#dialog_form").dialog({
			autoOpen: false,
			modal: true,
			resizable: false,
			buttons: {
				"anmelden": function() 
				{
					//Methodenaufruf														
					loginProcess();		
				},
				"abbrechen": function() 
				{
					$(this).dialog("close");	
				}
			}
		});
		//Beim Drücken des Enter Buttons
		$("#dialog_form")
			.keyup(function(e) 
			{
    			if (e.keyCode == 13) 
    			{
      				//Methodenaufruf
        			loginProcess();
    			}
    		});
		//Beim Drücken des Login Button
		$("#login_Button")
			.button()
			.click(function() 
			{
				$("#dialog_form").dialog("open");
			});
		//Beim Drücken des Logout Button
		$("#logout_Button")			
			.button()
			.click(function() 
			{
				$("#user").val("");
				$("#password").val("");
				$('#logout_Button').hide();
				$('#login_Button').show();
				$("#refresh").load('logout.php');
			});
	});
	//Login Funktion
	function loginProcess() 
	{
		//Das Ergebnis der Auswertung inc.php wird im div Element #refresh ausgegeben.
		$("#refresh").load('inc.php', { user: $("#user").val(), password: $("#password").val() });
		$("#dialog_form").dialog("close");	
	}
</script>