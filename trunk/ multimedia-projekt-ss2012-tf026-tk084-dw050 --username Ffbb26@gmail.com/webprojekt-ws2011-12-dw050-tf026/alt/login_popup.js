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
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$("#dialog:ui-dialog").dialog("destroy");
		
		var user = $("#user"), password = $("#password"), allFields = user.add(user).add(password), tips = $( ".validateTips" );	
	
		$("#dialog_form").dialog({
			autoOpen: false,
			modal: true,
			buttons: {
				"anmelden": function() 
				{														
					//Das Ergebnis der Auswertung inc.php wird im div Element #refresh ausgegeben.
					$("#refresh").load('inc.php', { user: $("#user").val(), password: $("#password").val() });
					
					//$("#refresh").html("Veranstaltungsrückblick");				
					
					$(this).dialog("close");
								
				},
				"abbrechen": function() 
				{
					$(this).dialog("close");	
				}
			}
		});

		$("#login_Button")
			.button()
			.click(function()
			{
			.toggle(),
			.toggle();
			});

		$("#logout_Button")			
			.button()
			.click(function() 
			{
				$("#login_Logout").html("<button id=\"login_Button\">Login</button>");
				$("#refresh").load('logout.php');
			});
	});
</script>