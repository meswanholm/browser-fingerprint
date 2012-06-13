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
						echo '<div id="profileInfoTop">';
							//Name
							echo '<p id="fbName">' . $facebook->getUser_Name() . '</p>';
							
							
							//Profilbild
							echo '<div id="image">';
								echo '<img src=' . $facebook->getUser_PictureSource() . ' />';
							echo '</div>'; //endtag - image
						echo '</div>'; //endtag - profileInfoTop
						echo '<div id="profileInfoBottom">';
							
							//Kopfgeld
							$friendsFactor = array(0, 100, 300);	//Anzahl Freunde
							$likesFactor = array(0, 50, 365);		//Anzahl Likes
							$gamesFactor = array(0, 1);				// Anzahl Spiele
							if ($friendsSize >= $friendsFactor[2] && $likesSize >= $likesFactor[2] && $gamesSize >= $gamesFactor[1])
							{
								echo '<p id="fbReward">319 $ Kopfgeld</p>';							
							}
							else if ($friendsSize <= $friendsFactor[1] && $likesSize <= $likesFactor[1] && $gamesSize <= $gamesFactor[0])
							{
								echo '<p id="fbReward">59 $ Kopfgeld</p>';	
							}
							else 
							{
								echo '<p id="fbReward">219 $ Kopfgeld</p>';	
							}
							//echo ', Angaben in Anlehnung nach: https://goprivate.abine.com';
							
							
							
							
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
									$replaceCollege = str_replace('=|=', '|', $colleges[$i]);
									$splitCollege = explode("|", $replaceCollege);
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
							$number = 10;
							
							if ($groupsSize < $number)
								$number = $groupsSize;
						
							if ($groupsSize > 0)
							{
								$groups = $facebook->getUser_Groups($number);
							
								if ($groupsSize == 1)
									echo '<p>gehört folgender Gruppierung an: ';
								else if ($groupsSize > 1)
									echo '<p>gehört folgenden Gruppierungen an: ';
							
								for ($i = 0; $i < $groupsSize; $i++)
								{					
									echo $groups[$i];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
							
							//E-Mail
							$email = $facebook->getUser_EMail();
							
							if ($email != "")
								echo '<p>Auch unter dem Pseudonym ' . $email . ' unterwegs</p>';
								
							//Stadt
							$town = $facebook->getUser_Town();
							
							if ($town != "")
								echo '<p>treibt sich in folgenden Bezirken rum: ' . $town . '</p>';
							
							//Arbeit
							$worksSize = $facebook->getUser_NumberOfWorks();
						
							if ($worksSize > 0)
							{
								$works = $facebook->getUser_Works();
							
								if ($worksSize == 1)
									echo '<p>verdient an folgender Machenschaft: ';
								else if ($worksSize > 1)
									echo '<p>verdient an folgenden Machenschaften: ';
							
								for ($i = 0; $i < $worksSize; $i++)
								{	
									$replaceWork = str_replace('=|=', '|', $works[$i]);
									$splitWork = explode("|", $replaceWork);
									echo $splitWork[0];
								
									if ($worksSize > 1 && ($i+1) < $worksSize)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Webseite
							$website = $facebook->getUser_Website();
							
							if ($website != "")
								echo '<p>genauere Beschreibung auf ' . $website . '</p>';
							
							//Politik
							$politican = $facebook->getUser_Political();
							
							if ($politican != "")
								echo '<p>unterstützt folgende politische Gruppen ' . $politican . '</p>';
							
							//Religion
							$religion = $facebook->getUser_Religion();
							
							if ($religion != "")
								echo '<p>glaubt an folgende Gottesvereinigung ' . $religion . '</p>';
								
							//Biografie
							$bio = $facebook->getUser_Biographie();
							
							if ($bio != "")
								echo '<p>behaupten von sich selbst ' . $bio . '</p>';
								
							//Sprachen
							$languagesSize = $facebook->getUser_NumberOfLanguages();
						
							if ($languagesSize > 0)
							{
								$languages = $facebook->getUser_Languages();
							
								if ($languagesSize == 1)
									echo '<p>kann man in folgender Sprache ansprechen: ';
								else if ($languagesSize > 1)
									echo '<p>kann man in folgenden Sprachen ansprechen: ';
							
								for ($i = 0; $i < $languagesSize; $i++)
								{									
									echo $languages[$i];
								
									if ($languagesSize > 1 && ($i+1) < $languagesSize)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Spiele
							$gamesSize = $facebook->getUser_NumberOfGames();
							$number = 10;
							
							if ($gamesSize < $number)
								$number = $gamesSize;
						
							if ($gamesSize > 0)
							{
								$games = $facebook->getUser_Games($number);
							
								if ($gamesSize == 1)
									echo '<p>verzockt sein Geld bei folgendem Spiel: ';
								else if ($gamesSize > 1)
									echo '<p>verzockt sein Geld bei folgenden Spielen: ';
							
								for ($i = 0; $i < $gamesSize; $i++)
								{									
									$splitGame = explode("|", $games[$i]);
									echo $splitGame[0];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Likes
							$likesSize = $facebook->getUser_NumberOfLikes();
							$number = 20;
							
							if ($likesSize < $number)
								$number = $likesSize;
						
							if ($likesSize > 0)
							{
								echo '<p>Mag unglaubliche ' . $likesSize . ' Dinge</p>';
								
								$likes = $facebook->getUser_Likes($number);
							
								if ($likesSize == 1)
									echo '<p>mag folgende Sache: ';
								else if ($likesSize > 1)
									echo '<p>mag folgende Dinge: ';
							
								for ($i = 0; $i < $likesSize; $i++)
								{									
									$splitLike = explode("|", $likes[$i]);
									echo $splitLike[0];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Freunde
							$friendsSize = $facebook->getUser_NumberOfFriends();
							$number = 20;
							
							if ($friendsSize < $number)
								$number = $friendsSize;
						
							if ($friendsSize > 0)
							{
								echo '<p>Besitzt Kontakte zu ' . $friendsSize . ' Personen</p>';
								
								$friends = $facebook->getUser_Friends($number);
							
								if ($friendsSize == 1)
									echo '<p>hat folgenden Freund: ';
								else if ($friendsSize > 1)
									echo '<p>hat u.a. folgende Freunde: ';
							
								for ($i = 0; $i < $number; $i++)
								{									
									echo $friends[$i];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Interesse
							$interestsSize = $facebook->getUser_NumberOfInterest();
							$number = 20;
							
							if ($interestsSize < $number)
								$number = $interestsSize;
						
							if ($interestsSize > 0)
							{
								echo '<p>Hat unglaubliche ' . $interestsSize . ' Interessen</p>';
								
								$interests = $facebook->getUser_Interests($number);
							
								if ($interestsSize == 1)
									echo '<p>hat folgendes Interesse: ';
								else if ($interestsSize > 1)
									echo '<p>hat u.a. folgende Interessen: ';
							
								for ($i = 0; $i < $number; $i++)
								{									
									$splitInterest = explode("|", $interests[$i]);
									echo $splitInterest[0];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Aktivitäten
							$activitiesSize = $facebook->getUser_NumberOfActivities();
							$number = 20;
							
							if ($activitiesSize < $number)
								$number = $activitiesSize;
						
							if ($activitiesSize > 0)
							{
								echo '<p>Hat unglaubliche ' . $activitiesSize . ' Aktivitäten</p>';
								
								$activities = $facebook->getUser_Activities($number);
							
								if ($interestsSize == 1)
									echo '<p>geht folgender Aktivität nach: ';
								else if ($interestsSize > 1)
									echo '<p>geht u.a. folgenden Aktivitäten nach: ';
							
								for ($i = 0; $i < $number; $i++)
								{									
									$splitActivity = explode("|", $activities[$i]);
									echo $splitActivity[0];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Bücher
							$booksSize = $facebook->getUser_NumberOfBooks();
							$number = 20;
							
							if ($booksSize < $number)
								$number = $booksSize;
						
							if ($booksSize > 0)
							{
								$books = $facebook->getUser_Books($number);
							
								if ($booksSize == 1)
									echo '<p>liest folgendes Buch: ';
								else if ($booksSize > 1)
									echo '<p>liest u.a. folgende Bücher: ';
							
								for ($i = 0; $i < $number; $i++)
								{									
									$splitBook = explode("|", $books[$i]);
									echo $splitBook[0];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
								
							//Veranstaltungen
							$eventsSize = $facebook->getUser_NumberOfEvents();
							$number = 20;
							
							if ($eventsSize < $number)
								$number = $eventsSize;
						
							if ($eventsSize > 0)
							{
								$events = $facebook->getUser_Events($number);
							
								if ($eventsSize == 1)
									echo '<p>wurde zu folgendem Event eingeladen: ';
								else if ($eventsSize > 1)
									echo '<p>wurde zu folgenden Events eingeladen: ';
							
								for ($i = 0; $i < $number; $i++)
								{									
									$splitEvent = explode("|", $events[$i]);
									echo $sr->translateEventTextFormEnglishToGerman($splitEvent[4]) . " an " . $splitEvent[0] . " in " . $splitEvent[3];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Interesse an
							$interestsInSize = $facebook->getUser_NumberOfInterestIn();
							$number = 20;
							
							if ($interestsInSize < $number)
								$number = $interestsInSize;
						
							if ($interestsInSize > 0)
							{
								$interestsIn = $facebook->getUser_InterestsIn($number);
							
								if ($interestsInSize == 1)
									echo '<p>Interesse an: ';
								else if ($interestsInSize > 1)
									echo '<p>Interessen an: ';
							
								for ($i = 0; $i < $number; $i++)
								{									
									echo $interestsIn[$i];
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
							
							//Checkins
							$checkinsSize = $facebook->getUser_NumberOfCheckins();
							$number = 1;
							
							if ($checkinsSize < $number)
								$number = $checkinsSize;
													
							if ($checkinsSize > 0)
							{
								$checkins = $facebook->getUser_Checkins($number);
							
								if ($checkinsSize == 1)
									echo '<p>folgendes Checkin vorhanden: ';
								else if ($checkinsSize > 1)
									echo '<p>folgende Checkins vorhanden: ';
							
								for ($i = 0; $i < $number; $i++)
								{									
									$replaceCheckins = str_replace('=|=', '|', $checkins[$i]);
									$splitCheckin = explode("|", $replaceCheckins);
									//TEST
									//echo $sr->translateEventTextFormEnglishToGerman($splitEvent[4]) . " an " . $splitEvent[0] . " in " . $splitEvent[3];
									echo $checkins[$i];
								
								
									if ($number > 1 && ($i+1) < $number)
										echo ', ';
								}
								echo '</p>';
							}
 							
						echo '</div>'; //endtag - profileInfoBottom
						
						
						
						/*
				

				/*
				
				

				

				

				

			     
				
				



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
				
 */

				//echo '</div>';		
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