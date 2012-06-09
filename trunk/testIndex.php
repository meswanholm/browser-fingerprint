<?php
    session_start(); //SONST 'Warning: session_start() [function.session-start]: Cannot send session cache limiter'
    
	//HTML wird aufgebaut
	echo '<html>';
    echo '<head>';
    echo '<title>Online-Medien-Management | Facebook-Tracking</title>';
	
	echo '<link rel="stylesheet" type="text/css" href="default.css" />';
    echo '</head>';
    echo '<body>';
	
	//entsprechende Klassen werden eingebunden...
	require_once 'facebookTracking.php';
	$facebook = new FacebookTracking("facebook.php", "serviceRoutines.php", "http://www.einfach-wir.net/daniel/fb2/testIndex.php", "294040014004290", "942bf9f89444df74c4dd36701a24e25a");
	require_once 'serviceRoutines.php';
	$sr = new ServiceRoutines();
        
    echo '<table id="tab" border="0" cellpadding="0" cellspacing="0">';
		echo '<tr>';
			echo '<td>';
				echo '<div id="top">';
				echo '</div>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
			echo '<div class="contentbg">';		
				echo '<table>';
					echo '<tr>';
					echo '<td>';
						echo '<div id="contentTable">';
						
						//Name
						echo '<p id="fbName">' . $facebook->getUser_Name() . '</p>';
						
						//Profilbild
						echo '<div id="image">';
							echo '<img src=' . $facebook->getUser_PictureSource() . ' />';
						echo '</div>'; //endtag - image
						
						//Geschlecht
						$gender = $facebook->getUser_Gender();
						
						if ($gender != "")
							echo '<p>folgendes Geschlecht: ' . $sr->convertGenderFromEnglishToGerman($gender) . '</p>';
							
						//Geburtstag
						$birthday = $facebook->getUser_Birthday();
						
						if ($birthday != "")
							echo '<p>Geboren am ' . $sr->convertUtcToGermanDate($birthday) . '</p>';
						
						//College
						$collegesSize = $facebook->getUser_NumberOfColleges();
						
						if ($collegesSize > 0)
						{
							$colleges = $facebook->getUser_Colleges();
							
							if ($collegesSize == 1)
								echo '<p>vermutlich an folgenden Bildungseinrichtung anzutreffen: ';
							else if ($collegesSize > 1)
								echo '<p>vermutlich an folgenden Bildungseinrichtungen anzutreffen: ';
							
							for ($i = 0; $i < $collegesSize; $i++)
							{									
								$splitCollege = explode("|", $colleges[$i]);
								echo $splitCollege[1];
								
								if ($collegesSize > 1 && ($i+1) < $collegesSize)
									echo ', ';
							}
							echo '</p>';
						}
						
						//Beziehungsstatus --> Vl. noch etwas kreativer so nach dem Motto sein Weib brauchen wir nicht :D
						$relationShip = $facebook->getUser_RelationshipStatus();
						
						if ($relationShip != "")
							echo '<p>Beziehung: ' . $relationShip . '</p>';
							
						
						//Gruppen
						$groupsSize = $facebook->getUser_NumberOfGroups();
						
						if ($groupsSize > 0)
						{
							$groups = $facebook->getUser_Groups(0);
							
							if ($groupsSize == 1)
								echo '<p>gehört folgender Gruppierung an: ';
							else if ($groupsSize > 1)
								echo '<p>gehört folgenden Gruppierungen an: ';
							
							for ($i = 0; $i < $groupsSize; $i++)
							{					
								echo $groups[$i];
								
								if ($groupsSize > 1 && ($i+1) < $groupsSize)
									echo ', ';
							}
							echo '</p>';
						}
						
						
						
						
						/*
				print ("</br>");
				print ("<b>Gruppen:</b>");
				print ("</br>");
				foreach ($groups as $group)
				{
						print ($group);
						print (" | ");
				}
				print ("<b>Anzahl Gruppen: </b>" . $facebook->getUser_NumberOfGroups());
				print ("</br>");
				

				/*
				//E-Mail
				print ("</br>");
				print ("<b>E-Mail: </b>" . $facebook->getUser_EMail());
				print ("</br>");
				
				//Stadt
				print ("</br>");
				print ("<b>Stadt: </b>" . $facebook->getUser_Town());
				print ("</br>");
				
				//Arbeit
				$works = $facebook->getUser_Works();
				print ("</br>");
				print ("<b>Arbeiten:</b>");
				print ("</br>");
				foreach ($works as $work)
				{
						print ($work);
						print ("</br>");
				}
				print ("<b>Anzahl Arbeiten: </b>" . $facebook->getUser_NumberOfWorks());
				print ("</br>");
				
				//Webseite
				print ("</br>");
				print ("<b>Webseite: </b>" . $facebook->getUser_Website());
				print ("</br>");
				
				//Politik
				print ("</br>");
				print ("<b>Politik: </b>" . $facebook->getUser_Political());
				print ("</br>");
				
				//Religion
				print ("</br>");
				print ("<b>Relgion: </b>" . $facebook->getUser_Religion());
				print ("</br>");
				
				//Sprachen
				$languages = $facebook->getUser_Languages();
				print ("</br>");
				print ("<b>Sprachen:</b>");
				print ("</br>");
				foreach ($languages as $language)
				{
						print ($language);
						print (" | ");
				}
				print ("<b>Anzahl Sprachen: </b>" . $facebook->getUser_NumberOfLanguages());
				print ("</br>");        
				
				//Spiele
				$games = $facebook->getUser_Games();
				print ("</br>");
				print ("<b>Spiele:</b>");
				print ("</br>");
				foreach ($games as $game)
				{
						print ($game);
						print (" | ");
				}
				print ("<b>Anzahl Spiele: </b>" . $facebook->getUser_NumberOfGames());
				print ("</br>");
				

				
				//Likes
				$likes = $facebook->getUser_Likes();
				print ("</br>");
				print ("<b>Likes:</b>");
				print ("</br>");
				foreach ($likes as $like)
				{
						print ($like);
						print ("</br>");
				}
				print ("<b>Anzahl Likes: </b>" . $facebook->getUser_NumberOfLikes());
				print ("</br>");
				
				//Freunde
				$friends = $facebook->getUser_Friends();
				print ("</br>");
				print ("<b>Freunde:</b>");
				print ("</br>");
				foreach ($friends as $friend)
				{
						print ($friend);
						print (" | ");
				}
				print ("<b>Anzahl Freunde: </b>" . $facebook->getUser_NumberOfFriends());
				
				//Interessen
				$interests = $facebook->getUser_Interests();
				print ("</br>");
				print ("<b>Interessen:</b>");
				print ("</br>");
				foreach ($interests as $interest)
				{
						print ($interest);
						print (" | ");
				}
				print ("<b>Anzahl Interessen: </b>" . $facebook->getUser_NumberOfInterest());
				
				//Aktivitäten
				$activities = $facebook->getUser_Activities();
				print ("</br>");
				print ("<b>Aktivitäten:</b>");
				print ("</br>");
				foreach ($activities as $activity)
				{
						print ($activity);
						print (" | ");
				}
				print ("<b>Anzahl Aktivitäten: </b>" . $facebook->getUser_NumberOfActivities());
				
				//Bücher
				$books = $facebook->getUser_Books();
				print ("</br>");
				print ("<b>Bücher:</b>");
				print ("</br>");
				foreach ($books as $book)
				{
						print ($book);
						print (" | ");
				}
				print ("<b>Anzahl Bücher: </b>" . $facebook->getUser_NumberOfBooks());
				
				//Events
				$events = $facebook->getUser_Events();
				print ("</br>");
				print ("<b>Events:</b>");
				print ("</br>");
				foreach ($events as $event)
				{
						print ($event);
						print ("</br>");
				}
				print ("<b>Anzahl Events: </b>" . $facebook->getUser_NumberOfEvents());
				
				//Interessen an
				$interests = $facebook->getUser_InterestsIn();
				print ("</br>");
				print ("<b>Interests:</b>");
				print ("</br>");
				foreach ($interests as $interest)
				{
						print ($interest);
						print ("</br>");
				}
				print ("<b>Anzahl Interesse: </b>" . $facebook->getUser_NumberOfInterestIn());

				//User-Checkins
				$checkins = $facebook->getUser_Checkins(0);
				print ("</br>");
				print ("<b>User-Checkins:</b>");
				print ("</br>");
				foreach ($checkins as $check)
				{
						print ($check);
						print ("</br>");
				}
				print ("<b>Anzahl User-Checkins: </b>" . $sr->convertUtcToGermanDate($facebook->getUser_NumberOfCheckins()));
				
				//Biografie
				print ("</br>");
				print ("<b>Biografie: </b>" . $facebook->getUser_Biographie());
				print ("</br>"); */

				echo '</div>';		
				echo '</td>';
				echo '</tr>';
				echo '</table>';
	
			echo '</div>';
		echo '</tr>';
		echo '<tr>';
		echo '<td>';
			echo '<div id="bottom">';
			echo '</div>';
		echo '</tr>';
	echo '</table>';		
    echo '</body>';
    echo '</html>';
?>