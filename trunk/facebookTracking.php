<!--********************************SOURCE CODE HISTORY**********************************!>
<!Coypright Till Klassen, Timo Friepes, Daniel Willinger								 !>
<!---------------------------------------------------------------------------------------!>
<!2012-05-30: Limitation of datasets    												 !>
<!                        																 !>
<!																					     !>
<***************************************************************************************-->


<?php
	class FacebookTracking
	{	
		private $serviceRoutines = null;
		private $config = null;		
		private $facebook = null;
		//Rechte testweise hinzugefügt: publish_checkins, friends_checkins, user_online_presence, user_status
		//Aufgrund eines Bugs in der Facebook API müssen die "user_checkins" Rechte auf der App Developer Seite eingetragen werden.
		private $permissions = "user_birthday, user_activities, user_interests, user_photos, user_groups, user_events, user_likes, email, user_about_me, user_hometown, user_work_history, user_checkins, publish_checkins, friends_checkins, user_online_presence, user_status, friends_status, user_relationship_details,user_relationships";
		private $logout_url = ""; //-> Ist der Sprung zu einer Seite wenn der Benutzer sich ausgeloggt hat. Sollte in diesem Fall die OMM Startseite sein.
		private $user_id = null;
		private $access_token = null;
		private $params = null;
		private $login_url = null;
		//Benutzerinformationen
		private $user_profile = null;
		private $user_fields = "id,name,gender,birthday,email,hometown,political,relationship_status,religion,bio,website,languages,interested_in,work,education";
		//Freunde
		private $user_friends = null;
		private $user_friendsFields = "name";
		//Gruppen
		private $user_groups = null;
		private $user_groupsNum = null;
		private $user_groupsFields = "name";
		//Games
		private $user_games = null;
		private $user_gamesFields = "name,category,created_time"; //BUG behauptet Feld sei nicht da, hole ich mir alle Alle Feld ist das Feld "created_time" dabei.
		//Likes
		private $user_likes = null;
		private $user_likesFields = "name,category,create_time"; //GLEICH Games
		//Interessen
		private $user_interest = null;
		private $user_interestFields = "name,category,create_time"; //GLEICH Games
		//Aktivitäten
		private $user_activities = null;
		private $user_activitiesFields = "name,category,create_time"; //GLEICH Games
		//Bücher
		private $user_books = null;
		private $user_booksFields = "name,category,create_time"; //GLEICH Games
		//Veranstaltungen
		private $user_events = null;
		private $user_eventsFields = "name,start_time,end_time,location,rsvp_status"; //GLEICH Games
		//Checkins
		private $user_checkins = null;
		private $user_checkinsFields = "";
		
		
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
					$this->user_profile = $this->facebook->api("/" . $this->user_id . "?fields=" . $this->user_fields, "GET");
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
		{//Politik
			if ($this->user_profile['political'] != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['political']);
			
			return "";		
		}
		
	    public function getUser_RelationshipStatus()
		{//Beziehungsstatus
			if ($this->user_profile['relationship_status'] != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['relationship_status']);
			
			return "";		
		}
		
		public function getUser_Religion()
		{//Religion
			if ($this->user_profile['religion'] != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['religion']);
			
			return "";
		}
		
		public function getUser_Biographie()
		{//Biografie
			if ($this->user_profile['bio'] != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['bio']);
			
			return "";
		}
		
		public function getUser_Website()
		{//Webseite
			if ($this->user_profile['website'] != "")
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
		
		public function getUser_InterestsIn($number)
		{//Interesse an -> MUSS NOCH GETESTET WERDEN WAS FÜR EINTRÄGE GIBT ES?
			$interests = $this->user_profile['interested_in'];
			
			if ($number > 0)
				$interestSize = $number;
			else
				$interestSize = sizeof($interests);
				
			$allInterest = array();
			
			if ($interestSize > 0)
			{
				for ($i = 0; $i < $interestSize; $i++) 
				{
					$interest = $interests[$i]; 
					$allInterest[] = $this->serviceRoutines->convertSpecialSign($interest['name']);
				}; 
			}
			
			return $allInterest;
		}
		
		public function getUser_NumberOfInterestIn()
		{//Anzahl Interesse an -> MUSS NOCH GETESTET WERDEN WAS FÜR EINTRÄGE GIBT ES?
			$interests = $this->user_profile['interested_in'];
			
			return sizeof($interests);
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
			$collegesSize = sizeof($colleges);
			$allColleges = array();
			
			if ($collegesSize > 0)
			{
				for ($i = 0; $i < $collegesSize; $i++) 
				{
					$college = $colleges[$i]; 
					$allColleges[] = $this->serviceRoutines->convertSpecialSign($college['type'] . "|" . $college['school']['name']);		
				};
			}
			
			return $allColleges;
		}
		
		public function getUser_NumberOfColleges()
		{//Anzahl Hochschule/Schule/Bildungseinrichtung
			$colleges = $this->user_profile['education'];
			
			return sizeof($colleges);
		}
		
		public function getUser_Friends($number)
		{//Freunde
			if ($this->user_friends == null)
				$this->user_friends = $this->facebook->api("/" . $this->user_id . "/friends?fields=" . $this->user_friendsFields, "GET");
			
			$friendsData = $this->user_friends['data'];		
			
			if ($number > 0)
				$friendsSize = $number;
			else
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
			if ($this->user_friends == null)
				$this->user_friends = $this->facebook->api("/" . $this->user_id . "/friends?fields=" . $this->user_friendsFields, "GET"); 
			
			$friendsData = $this->user_friends['data'];
			
			return sizeof($friendsData);
		}
		
		public function getUser_Groups($number)
		{//Gruppen
			if ($this->user_groups == null)
				$this->user_groups = $this->facebook->api("/" . $this->user_id . "/groups?fields=" . $this->user_groupsFields, "GET"); 
			
			$groupsData = $this->user_groups['data'];
			
			if ($number > 0)
				$groupsSize = $number;
			else
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
			if ($this->user_groups == null)
				$this->user_groups = $this->facebook->api("/" . $this->user_id . "/groups?fields=" . $this->user_groupsFields, "GET"); 
			
			$groupsData = $this->user_groups['data'];
			
			return sizeof($groupsData);
		}
		
		public function getUser_Games($number)
		{//Spiele
			if ($this->user_games == null)
				$this->user_games = $this->facebook->api("/" .  $this->user_id . "/games", "GET");
			
			$gamesData = $this->user_games['data'];
			
			if ($number > 0)
				$gamesSize = $number;
			else
				$gamesSize = sizeof($gamesData);
				
			$allGames = array();
		
			if ($gamesSize > 0)
			{
				for ($i = 0; $i < $gamesSize; $i++) 
				{ 
					$game = $gamesData[$i]; 
					//FORMAT: name|category|created_time
					$allGames[] = $this->serviceRoutines->convertSpecialSign($game['name'] . "|" . $game['category'] . "|" . $game['created_time']); // 
				}; 
			}
			
			return $allGames;
		}
		
		public function getUser_NumberOfGames()
		{//Anzahl Spiele
			if ($this->user_games == null)
				$this->user_games = $this->facebook->api("/" .  $this->user_id . "/games", "GET");
			
			$gamesData = $this->user_games['data'];
			
			return sizeof($gamesData);
		}
		
		public function getUser_Likes($number)
		{//Likes
			if ($this->user_likes == null)
				$this->user_likes = $this->facebook->api("/" .  $this->user_id . "/likes", "GET");
				
			$likesData = $this->user_likes['data'];
			
			if ($number > 0)
				$likesSize = $number;
			else
				$likesSize = sizeof($likesData);
				
			$allLikes = array();
			
			if ($likesSize > 0)
			{				
				for ($i = 0; $i < $likesSize; $i++) 
				{
					$like = $likesData[$i]; 
					//FORMAT: name|category|create_time
					$allLikes[] = $this->serviceRoutines->convertSpecialSign($like['name'] . "|" . $like['category'] . "|" . $like['create_time']);
				}; 
			}
			
			return $allLikes;
		}
		
		public function getUser_NumberOfLikes()
		{//Anzahl Likes
			if ($this->user_likes == null)
				$this->user_likes = $this->facebook->api("/" .  $this->user_id . "/likes", "GET");
				
			$likesData = $this->user_likes['data'];
			
			return sizeof($likesData);
		}
		
		public function getUser_Interests($number)
		{//Interessen
			if ($this->user_interest == null)
				$this->user_interest = $this->facebook->api("/" . $this->user_id . "/interests", "GET");
				
			$interestsData = $this->user_interest['data'];
			
			if ($number > 0)
				$interestsSize = $number;
			else
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
		{//Anzahl Interessen
			if ($this->user_interest == null)
				$this->user_interest = $this->facebook->api("/" . $this->user_id . "/interests", "GET");
				
			$interestsData = $this->user_interest['data'];
			
			return sizeof($interestsData);
		}
		
		public function getUser_Activities($number)
		{//Aktivitäten
			if ($this->user_activities == null)
				$this->user_activities = $this->facebook->api("/" . $this->user_id . "/activities", "GET");
			
			$activitiesData = $this->user_activities['data'];
			
			if ($number > 0)
				$activitiesSize = $number;
			else
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
		{//Anzahl Aktivitäten
			if ($this->user_activities == null)
				$this->user_activities = $this->facebook->api("/" . $this->user_id . "/activities", "GET");
			
			$activitiesData = $this->user_activities['data'];
			
			return sizeof($activitiesData);
		}
		
		public function getUser_Books($number)
		{//Bücher
			if ($this->user_books == null)
				$this->user_books = $this->facebook->api("/" . $this->user_id . "/books", "GET");
			
			$booksData = $this->user_books['data'];
			
			if ($number > 0)
				$booksSize = $number;
			else
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
		{//Anzahl Bücher
			if ($this->user_books == null)
				$this->user_books = $this->facebook->api("/" . $this->user_id . "/books", "GET");
			
			$booksData = $this->user_books['data'];
			
			return sizeof($booksData);
		}
		
		public function getUser_Events($number)
		{//Events
			if ($this->user_events == null)
				$this->user_events = $this->facebook->api("/" . $this->user_id . "/events", "GET");
				
			$eventsData = $this->user_events['data'];
			
			if ($number > 0)
				$eventsSize = $number;
			else
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
		{//Anzahl Events
			if ($this->user_events == null)
				$this->user_events = $this->facebook->api("/" . $this->user_id . "/events", "GET");
				
			$eventsData = $this->user_events['data'];
			
			return sizeof($eventsData);
		}
		
		public function getUser_Checkins($number)
		{//Checkins
			if ($this->user_checkins == null);
				$this->user_checkins = $this->facebook->api("/" . $this->user_id . "/checkins?access_token=" . $this->facebook->getAccessToken(), "GET"); //ENTSPRECHENDE FELDER RAUSHOLEN
			
			$checkinsData = $this->user_checkins['data']['place']['0'];
			
			if ($number > 0)
				$checkinsSize = $number;
			else
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
			if ($this->user_checkins == null);
				$this->user_checkins = $this->facebook->api("/" . $this->user_id . "/checkins?access_token=" . $this->facebook->getAccessToken(), "GET"); //ENTSPRECHENDE FELDER RAUSHOLEN
				
			$checkinsData = $this->user_checkins['data']['place'];
			
			return sizeof($checkinsData);
		}
		
		public function getUser_Checkins_FQL()
		{//Checkins
		 // Testlauf
		  $fql_query_checkins_all = 'SELECT+checkin_id,+author_uid,+page_id,+app_id,+post_id,+tagged_uids,+message+FROM+checkin+WHERE+author_uid=me()';
		  $fql_query_checkins_place = 'SELECT+name+FROM+place+WHERE+page_id+IN+(SELECT+page_id+FROM+#fql_query_checkins_all)';
		  $fql_test = 'SELECT+name+FROM+user+WHERE+uid+=me()';
		  $fql_query_url = 'https://graph.facebook.com/fql?q='.$fql_query_checkins_all.'&access_token='.$this->facebook->getAccessToken();
		  $fql_query_result = file_get_contents($fql_query_url);
		  $fql_query_obj = json_decode($fql_query_result, true);
			
		  //display results of fql query
		  echo '<pre>';
		  print_r("query results:");
		  print_r($fql_query_obj);
		  echo '</pre>';
		  }
		

		public function __destruct()
		{//SOLL ES DIE MÖGLICHKEIT GEBEN?
			$params = array( 'next' => $this->logout_url); //Wo geht es hin nach dem Logout?
			$logout_url = $this->facebook->getLogoutUrl($this->params); // $params is optional. 
			echo '<p><a href="' . $logout_url . '">Logout</a></p>';
		}
	}
?>