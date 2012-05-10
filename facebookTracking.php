<!--********************************SOURCE CODE HISTORY**********************************!>
<!Coypright Till Klassen, Timo Friepes, Daniel Willinger								 !>
<!																					     !>
<!																						 !>
<!                        																 !>
<!																					     !>
<***************************************************************************************-->


<?php
	class FacebookTracking
	{	
		private $serviceRoutines = null;
		private $config = null;		
		private $facebook = null;
		private $permissions = "user_birthday, user_activities, user_interests, user_photos, user_groups, user_events, user_likes, email, user_about_me, user_hometown, user_work_history, user_checkins";
		private $logout_url = ""; //-> Ist der Sprung zu einer Seite wenn der Benutzer sich ausgeloggt hat. Sollte in diesem Fall die OMM Startseite sein.
		private $user_id = null;
		private $access_token = null;
		private $params = null;
		private $login_url = null;
		//Benutzerinformationen
		private $user_profile = null;
		
		
		public function __construct($pFacebook_PHP, $pServiceRoutines_PHP, $pLogoutUrl, $pAppID, $pAppSecret)
		{
			require_once $pFacebook_PHP;
			require_once $pServiceRoutines_PHP;
			
			$this->serviceRoutines = new ServiceRoutines();
			$this->config = array
				(
					'appId' => $pAppID,
					'secret' => $pAppSecret,
				);
			$this->facebook = new Facebook($this->config);
			$this->params = array
				(
					'fbconnect' => 0,
					'canvas' => 1,
					'scope' => $this->permissions,
				);
			$this->logout_url = $pLogoutUrl;
			$this->user_id = $this->facebook->getUser();
			$this->login_url = $this->facebook->getLoginUrl($this->params);
			
			if ($this->user_id) //Benutzer ist eingeloggt
			{
				try
				{
					$this->access_token = $this->facebook->getAccessToken();
					//Benutzerinformationen
					$this->user_profile = $this->facebook->api("/" . $this->user_id, "GET");
				}	  
				catch(FacebookApiException $e) 
				{
					print '<script>top.location.href = "' . $this->login_url . '"</script>';
					
					error_log($e->getType());
					error_log($e->getMessage());
				}  
			}	
			else //Benutzer ist nicht eingeloggt
			{
				print '<script>top.location.href = "' . $this->login_url . '"</script>';
			}
		}
		
		
		//BENUTZERINFORMATIONEN
		public function getUser_ID()
		{//ID
			return $this->user_profile['id'];
		}
		
		public function getUser_Name()
		{//Name
			return $this->serviceRoutines->convertSpecialSign($this->user_profile['name']);
		}
			
		public function getUser_Gender()
		{//Geschlecht
			if ($this->user_profile['gender'] != "")
			{
				if ($this->user_profile['gender'] == 'male')
					return "m&aumlnnlich"; 
				else
					return "weiblich";
			}
		}
		
		public function getUser_Birthday()
		{//Geburtstag
			if ($this->user_profile['birthday'] != "")
			{
				$birthday = $this->user_profile['birthday'];
				return $birthday[3] . $birthday[4] . "." . $birthday[0] . $birthday[1] . "." . $birthday[6] . $birthday[7] . $birthday[8] . $birthday[9];
			}
			
			return "";
		}
		
		public function getUser_PictureSource()
		{//Profilbild Quelle
			return "https://graph.facebook.com/" . $this->user_id . "/picture?type=large";
		}
		
		public function getUser_EMail()
		{//E-Mail
			if ($this->user_profile['email'])
				return $this->user_profile['email'];
			
			return "";
		}
		
		public function getUser_Town()
		{//Stadt
			if ($this->user_profile['hometown'] != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['hometown']);
				
			return "";
		}
		
	    public function getUser_Political()
		{//Politik -> IN DOKU
			if ($this->user_profile != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['political']);
			
			return "";		
		}
		
		public function getUser_Religion()
		{//Religion -> IN DOKU
			if ($this->user_profile != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['religion']);
			
			return "";
		}
		
		public function getUser_Website()
		{//Webseite -> IN DOKU
			if ($this->user_profile != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['website']);
				
			return "";
		}
		
		public function getUser_Languages()
		{//Sprachen
			$languages = $this->user_profile['languages'];
			$languagesSize = sizeof($languages);
			$allLanguages = array();
			
			if ($languagesSize > 0)
			{
				for ($i = 0; $i < $languagesSize; $i++) 
				{
					$language = $languages[$i]; 
					$allLanguages[] = $this->serviceRoutines->convertSpecialSign($language['name']);
				}; 
			}
			
			return $allLanguages;
		}
		
		public function getUser_NumberOfLanguages()
		{//Anzahl Sprachen
			$languages = $this->user_profile['languages'];
			
			return sizeof($languages);
		}
		
		public function getUser_Works()
		{//Arbeiten
			$works = $this->user_profile['work'];
			$worksSize = sizeof($works);
			$allWorks = array();
			
			if ($worksSize > 0)
			{
				for ($i = 0; $i < $worksSize; $i++) 
				{
					$work = $works[$i]; 
					$allWorks[] = $this->serviceRoutines->convertSpecialSign($work['employer']['name']);		
				};
			}
			
			return $allWorks;
		}
		
		public function getUser_NumberOfWorks()
		{//Anzahl Arbeiten
			$works = $this->user_profile['work'];
			
			return sizeof($works);
		}		
		
		public function getUser_Colleges()
		{//Hochschule/Schule/Bildungseinrichtung
			$colleges = $this->user_profile['education'];
			$collegesSize = sizeof($works);
			$allColleges = array();
			
			if ($collegesSize > 0)
			{
				for ($i = 0; $i < $collegesSize; $i++) 
				{
					$college = $colleges[$i]; 
					$allColleges[] = $this->serviceRoutines->convertSpecialSign($college['type'] . $college['school']['name']);		
				};
			}
			
			return $allColleges;
		}
		
		public function getUser_NumberOfColleges()
		{//Anzahl Hochschule/Schule/Bildungseinrichtung
			$colleges = $this->user_profile['education'];
			
			return sizeof($colleges);
		}
		
		public function getUser_Friends()
		{//Freunde
			$friends = $this->facebook->api("/" . $this->user_id . "/friends", "GET"); 
			$friendsData = $friends['data'];
			$friendsSize = sizeof($friendsData);
			$allFriends = array();

			if ($friendsSize > 0)
			{		
				for ($i = 0; $i < $friendsSize; $i++) 
				{ 
					$friend = $friendsData[$i];
					$allFriends[] = $this->serviceRoutines->convertSpecialSign($friend['name']); 
				};
			}
			
			return $allFriends;
		}
		
		public function getUser_NumberOfFriends()
		{//Anzahl Freunde
			$friends = $this->facebook->api("/" . $this->user_id . "/friends", "GET"); 
			$friendsData = $friends['data'];
			
			return sizeof($friendsData);
		}
		
		public function getUser_Groups()
		{//Gruppen
			$groups = $this->facebook->api("/" . $this->user_id . "/groups", "GET"); 
			$groupsData = $groups['data'];
			$groupsSize = sizeof($groupsData);
			$allGroups = array();
			
			if ($groupsSize > 0)
			{
				for ($i = 0; $i < $groupsSize; $i++) 
				{ 
					$group = $groupsData[$i]; 
					$allGroups[] = $this->serviceRoutines->convertSpecialSign($group['name']);
				}; 
			}
			
			return $allGroups;
		}
		
		public function getUser_NumberOfGroups()
		{//Anzahl Gruppen
			$groups = $this->facebook->api("/" . $this->user_id . "/groups", "GET"); 
			$groupsData = $groups['data'];
			
			return sizeof($groupsData);
		}
		
		public function getUser_Games()
		{//Spiele
			$games = $this->facebook->api("/" .  $this->user_id . "/games", "GET");
			$gamesData = $games['data'];
			$gamesSize = sizeof($gamesData);
			$allGames = array();
		
			if ($gamesSize > 0)
			{
				for ($i = 0; $i < $gamesSize; $i++) 
				{ 
					$game = $gamesData[$i]; 
					//FORMAT: name|category|created_time
					$allGames[] = $this->serviceRoutines->convertSpecialSign($game['name'] . "|" . $game['category'] . "|" . $game['created_time']);
				}; 
			}
			
			return $allGames;
		}
		
		public function getUser_NumberOfGames()
		{//Anzahl Spiele
			$games = $this->facebook->api("/" .  $this->user_id . "/games", "GET");
			$gamesData = $games['data'];
			
			return sizeof($gamesData);
		}
		
		public function getUser_Likes()
		{//Likes
			$likes = $this->facebook->api("/" .  $this->user_id . "/likes", "GET");
			$likesData = $likes['data'];
			$likesSize = sizeof($likesData);
			$allLikes = array();
			
			if ($likesSize > 0)
			{
				for ($i = 0; $i < $likesSize; $i++) 
				{
					$like = $likesData[$i]; 
					//FORMAT: name|category|create_time
					$allLikes[] = $this->serviceRoutines->convertSpecialSign($like['name'] . "|" . $like['category'] . "|" . $like['created_time']);
				}; 
			}
			
			return $allLikes;
		}
		
		public function getUser_NumberOfLikes()
		{//Anzahl Likes
			$likes = $this->facebook->api("/" .  $this->user_id . "/likes", "GET");
			$likesData = $likes['data'];
			
			return sizeof($likesData);
		}
		
		public function getUser_Interests()
		{//Interessen -> IN DOKU
			$interests = $this->facebook->api("/" . $this->user_id . "/interests", "GET");
			$interestsData = $interests['data'];
			$interestsSize = sizeof($interestsData);
			$allInterests = array();
			
			if ($interestsSize > 0)
			{
				for ($i = 0; $i < $interestsSize; $i++) 
				{
					$interest = $interestsData[$i]; 
					//FORMAT: name|category|create_time
					$allInterests[] = $this->serviceRoutines->convertSpecialSign($interest['name'] . "|" . $interest['category'] . "|" . $interest['create_time']);
				}; 
			}
			
			return $allInterests;
		}
		
		public function getUser_NumberOfInterest()
		{//Anzahl Interessen -> IN DOKU
			$interests = $this->facebook->api("/" .  $this->user_id . "/interests", "GET");
			$interestsData = $interests['data'];
			
			return sizeof($interestsData);
		}
		
		public function getUser_Activities()
		{//Aktivitäten -> IN DOKU
			$activities = $this->facebook->api("/" . $this->user_id . "/activities", "GET");
			$activitiesData = $activities['data'];
			$activitiesSize = sizeof($activitiesData);
			$allActivities = array();
			
			if ($activitiesSize > 0)
			{
				for ($i = 0; $i < $activitiesSize; $i++) 
				{
					$activity = $activitiesData[$i]; 
					//FORMAT: name|category|create_time
					$allActivities[] = $this->serviceRoutines->convertSpecialSign($activity['name'] . "|" . $activity['category'] . "|" . $activity['create_time']);
				}; 
			}
			
			return $allActivities;
		}
		
		public function getUser_NumberOfActivities()
		{//Anzahl Aktivitäten -> IN DOKU
			$activities = $this->facebook->api("/" .  $this->user_id . "/activities", "GET");
			$activitiesData = $activities['data'];
			
			return sizeof($activitiesData);
		}
		
		public function getUser_Books()
		{//Bücher -> IN DOKU
			$books = $this->facebook->api("/" . $this->user_id . "/books", "GET");
			$booksData = $books['data'];
			$booksSize = sizeof($booksData);
			$allBooks = array();
			
			if ($booksSize > 0)
			{
				for ($i = 0; $i < $booksSize; $i++) 
				{
					$book = $booksData[$i]; 
					//FORMAT: name|category|create_time
					$allBooks[] = $this->serviceRoutines->convertSpecialSign($book['name'] . "|" . $book['category'] . "|" . $book['create_time']);
				}; 
			}
			
			return $allBooks;
		}
		
		public function getUser_NumberOfBooks()
		{//Anzahl Bücher -> IN DOKU
			$books = $this->facebook->api("/" .  $this->user_id . "/books", "GET");
			$booksData = $books['data'];
			
			return sizeof($booksData);
		}
		
		public function getUser_Events()
		{//Events -> IN DOKU
			$events = $this->facebook->api("/" . $this->user_id . "/events", "GET");
			$eventsData = $events['data'];
			$eventsSize = sizeof($eventsData);
			$allEvents = array();
			
			if ($eventsSize > 0)
			{
				for ($i = 0; $i < $eventsSize; $i++) 
				{
					$event = $eventsData[$i];
					//FORMAT: name|start_time|end_time|location|rsvp_status
					$allEvents[] = $this->serviceRoutines->convertSpecialSign($event['name'] . "|" . $event['start_time'] . "|" . $event['end_time'] . "|" . $event['location'] . "|" . $event['rsvp_status']);
				}; 
			}
			
			return $allEvents;
		}
		
		public function getUser_NumberOfEvents()
		{//Anzahl Events -> IN DOKU
			$events = $this->facebook->api("/" .  $this->user_id . "/events", "GET");
			$eventsData = $events['data'];
			
			return sizeof($eventsData);
		}
		
		public function getUser_Checkins()
		{//Checkins
			$checkins = $this->facebook->api("/" . $this->user_id . "/checkins?access_token=" . $this->facebook->getAccessToken(), "POST"); 
			$checkinsData = $checkins['data']['place']['0'];
			var_dump($checkins);
			$checkinsSize = sizeof($checkinsData);
			$allCheckins = array();

			if ($checkinsSize > 0)
			{		
				for ($i = 0; $i < $checkinsSize; $i++) 
				{ 
					$checkin = $checkinsData[$i];
					$allCheckins[] = $this->serviceRoutines->convertSpecialSign($checkin['name']); 
				};
			}
			
			return $allCheckins;
		}
		
		public function getUser_NumberOfCheckins()
		{//Anzahl Checkins
			$checkins = $this->facebook->api("/" . $this->user_id . "/checkins", "GET"); 
			$checkinsData = $checkins['data']['place'];
			
			return sizeof($checkinsData);
		}
		
		
		public function __destruct()
		{//SOLL ES DIE MÖGLICHKEIT GEBEN?
			$params = array( 'next' => $this->logout_url); //Wo geht es hin nach dem Logout?
			$logout_url = $this->facebook->getLogoutUrl($this->params); // $params is optional. 
			echo '<p><a href="' . $logout_url . '">Logout</a></p>';
		}
	}
?>