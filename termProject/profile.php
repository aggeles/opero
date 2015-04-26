<!DOCTYPE html>
<html>
<?php
include "session.php";
?>
<head>
	<title>Opero Account Page</title>
	<link href="opero_style.css" rel="stylesheet" type="text/css">
	<body bgcolor="#073f40">

	<script type="text/javascript">

      // The Browser API key obtained from the Google Developers Console.
      var developerKey = 'AIzaSyCfHOYXwE1LHdZBfKLS8CgtkgRmFJaIABI';

      // The Client ID obtained from the Google Developers Console. Replace with your own Client ID.
      var clientId = "592670722460-3j1hrvco4efks1m0e021avi6gtgtm1dt.apps.googleusercontent.com"

      // Scope to use to access user's photos.
      var scope = ['https://www.googleapis.com/auth/drive'];

      var pickerApiLoaded = false;
      var oauthToken;

      // Use the API Loader script to load google.picker and gapi.auth.
      function onApiLoad() {
        gapi.load('auth', {'callback': onAuthApiLoad});
        gapi.load('picker', {'callback': onPickerApiLoad});
      }

      function onAuthApiLoad() {
        window.gapi.auth.authorize(
            {
              'client_id': clientId,
              'scope': scope,
              'immediate': false
            },
            handleAuthResult);
      }

      function onPickerApiLoad() {
        pickerApiLoaded = true;
        createPicker();
      }

      function handleAuthResult(authResult) {
        if (authResult && !authResult.error) {
          oauthToken = authResult.access_token;
          createPicker();
        }
      }

      // Create and render a Picker object for picking user Docs.
      function createPicker() {
        if (pickerApiLoaded && oauthToken) {
          var upload = new google.picker.DocsUploadView();

          var picker = new google.picker.PickerBuilder().
              addView(google.picker.ViewId.DOCS).
              addView(upload).
              setOAuthToken(oauthToken).
              setDeveloperKey(developerKey).
              setCallback(pickerCallback).
              build();
          picker.setVisible(true);
        }
      }

      // A simple callback implementation.
      function pickerCallback(data) {
        var url = 'nothing';
        if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
          var doc = data[google.picker.Response.DOCUMENTS][0];
          url = doc[google.picker.Document.URL];
          sendRequest(url);
        }
      }

      function sendRequest(url) {
   		var xmlhttp = new XMLHttpRequest();
   		xmlhttp.open("GET", "savedocument.php?url=" + url, true);
   		xmlhttp.send();
   		xmlhttp.onreadystatechange=function() {
   			window.location = "http://www.opero.us/profile.php?" + (Math.random() * 10);
   		}	
      }

      function deleteResume() {
		var table = document.getElementById('resumes');
		var checked = new Array();
		var len = table.rows.length;
		for(var i = 1; i < len; i++) {
			if(document.getElementById("resumecheck" + i).checked)
				checked[i] =  document.getElementById("resume" + i);	
		}

		var xmlhttp = new XMLHttpRequest();
		var url = "?";
		var count = 0;
		for(var i = 1; i < len; i++) {
			if(checked[i] !== undefined) {
				count++;
				url += "link" + count + "=" + checked[i] + "&";
			}	
		}	
		xmlhttp.open("GET", "deletedocument.php" + url, true);
		xmlhttp.sent();
      }            
    </script>	
</head>
<body>
	<div id="profileHeader">
	<b id="welcome">
	
	
	<div id = "linkbox">
	<a href="index.php">Home</a>
	<a href="setUserPrefs.php">Preferences</a>
	
	<!--set preferences should include number of fave jobs to display
	Pref should be saved as $_SESSION['faveJobCount']-->
	
	<!-- The Google API Loader script. -->
	<script type="text/javascript" src="https://apis.google.com/js/api.js"></script>
	
	
	<a href="changePassword.php">Change Password</a><br>
	<a href="logout.php">Log Out</a><br>
	
	</div><!--end linkbox-->
	
	</div><!--end profile header-->
	
	<!--php script to output favorite jobs to an html table-->
	<!--settings for output can be adjusted in user preferences php page-->
	<div ="favejobsTable">
	<!--include "faveJobs.php";-->
	</div>
	
	<?php 
	$user_name = "a";
	$password = "Csci4300";
	$hostname = "localhost";
	$currentuser = $_SESSION['login_user'];
	
	try {
		$db = new PDO("mysql:host=$hostname;dbname=Documents", "a", "Csci4300");
		$sql = "SELECT * FROM resumes WHERE username = '$currentuser'";
		
		$stmt = $db->query($sql);
		
		$count = 1;
		if($stmt != NULL) {
			echo "<br><br><br><table id='resumes'>";
			echo "<tr><th>Your Resumes</th></tr>";
			while($row = $stmt->fetchObject()) {
	      		echo "<tr>";
				$resumeURL = $row->url;
				echo "<td><input type='checkbox' id='resumecheck" . $count . "'>";
				echo "<td><a href='" . $resumeURL . "' id='resume" . $count . "'>Resume" . $count . "</td>";
				echo "</tr>";
				$count++;
			}
			echo "</table>";
		}
		/* foreach($db->query(sql) as $row) {
			echo $row['username'].' '.$row['url']; //etc...
		} */
		
		$db = null;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
	?>
	
	<button onclick="onApiLoad()">Upload New Resume</button>
	<button onclick="deleteResume()">Delete Selected Resume</button><br>
	
	<div id="result"></div>
	
	<!--terminado-->
	
	</body>
</html>