<?php
	class FacebookTracking
	{	
		private $serviceRoutines = null;
		private $config = array
		(
			'appId' => '294040014004290',
			'secret' => '942bf9f89444df74c4dd36701a24e25a',
		);
		
		private $facebook = null;
		private $permissions = "user_birthday, user_interests, user_photos, user_groups, user_likes, email, user_about_me, user_hometown, user_work_history";
		private $logout_url = "http://www.einfach-wir.net/daniel/fb/index3.php"; //-> Ist der Sprung zu einer Seite wenn der Benutzer sich ausgeloggt hat.
		private $user_id = null;
		private $access_token = null;
		private $params = null;
		private $login_url = null;
		//Benutzerinformationen
		private $user_profile = null;
		
		
		public function __construct($facebook_PHP, $serviceRoutines_PHP)
		{
			require_once $facebook_PHP;
			require_once $serviceRoutines_PHP;
			$this->serviceRoutines = new ServiceRoutines();
			$this->facebook = new Facebook($this->config);
			$this->params = array
					(
						'fbconnect' => 0,
						'canvas' => 1,
						'scope' => $this->permissions,
					);
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
		
		public function getUser_College()
		{//Hochschule
			if ($this->user_profile['education']['0']['school']['name'] != "")
				return $this->serviceRoutines->convertSpecialSign($this->user_profile['education']['0']['type']) . ": " . $this->serviceRoutines->convertSpecialSign($this->user_profile['education']['0']['school']['name']);
			else
				return "";
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
		}
		
		public function getUser_PictureSource()
		{//Profilbild Quelle
			return "http://graph.facebook.com/" . $this->user_id . "/picture?type=large\" />";
		}
		
		public function getUser_EMail()
		{//E-Mail
			if ($this->user_profile['email'])
				return $this->user_profile['email'];
		}
		
		public function getUser_Town()
		{//Stadt
			if ($this->user_profile['hometown'] != "")
				$this->serviceRoutines->convertSpecialSign($this->user_profile['hometown']);
		}
		
		public function getUser_Work()
		{//Arbeit
			if ($this->user_profile != "")
				$this->serviceRoutines->convertSpecialSign($this->user_profile['work']);
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
			$groups = $facebook->api("/" . $this->user_id . "/groups", "GET"); 
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
			$groups = $facebook->api("/" . $this->user_id . "/groups", "GET"); 
			$groupsData = $groups['data'];
			
			return sizeof($groupsData);
		}
		
		public function getUser_Languages()
		{//Sprachen
			$languages = $this->user_profile['languages'];
			$languagesSize = sizeof($languages);
			$allLanguages = array();
			
			if ($languagesSize > 0)
			{
				for ($i = 0; $i < languagesSize; $i++) 
				{
					$language = $languages[$i]; 				
					$allLanguages[] = $this->serviceRoutines->convertSpecialSign($languages['name']);
				}; 
			}
			
			return $allLanguages;
		}
		
		public function getUser_NumberOfLanguages()
		{//Anzahl Sprachen
			$languages = $this->user_profile['languages'];
			
			return sizeof($languages);
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
					$game = $games[$i]; 
					$allGames[] = $this->serviceRoutines->convertSpecialSign($game['name']);
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
			$likes = $facebook->api("/" .  $this->user_id . "/likes", "GET");
			$likesData = $likes['data'];
			$likesSize = sizeof($likesData);
			$allLikes = array();
			
			if ($likesSize > 0)
			{
				for ($i = 0; $i < $likesSize; $i++) 
				{
					$like = $likes[$i]; 
					$allLikes[] = $this->serviceRoutines->convertSpecialSign($like['name']);
				}; 
			}
			
			return $allLikes;
		}
		
		public function getUser_NumberOfLikes()
		{//Anzahl Likes
			$likes = $facebook->api("/" .  $this->user_id . "/likes", "GET");
			$likesData = $likes['data'];
			return sizeof($likesData);
		}
		
		
		
		
		public function __destruct()
		{
			//$params = array( 'next' => $this->logout_url); //Wo geht es hin nach dem Logout?
			//$logout_url = $this->facebook->getLogoutUrl($this->params); // $params is optional. 
			//echo '<p><a href="' . $logout_url . '">Logout</a></p>';
		}
	}
?>