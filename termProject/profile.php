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
        }
        var message = 'You picked: ' + url;
        document.getElementById('result').innerHTML = message;
      }
    </script>	

</head>
<body>
	<div id="profileHeader">
	<b id="welcome">
	
	
	<div id = "linkbox">
	<a href="setUserPrefs.php">Preferences</a>
	
	<!--set preferences should include number of fave jobs to display
	Pref should be saved as $_SESSION['faveJobCount']-->
	<!-- The Google API Loader script. -->
	<script type="text/javascript" src="https://apis.google.com/js/api.js"></script>
	
	
	<button onclick="onApiLoad()">Upload Resume</button><br>
	<a href="changePassword.php">Change Password</a>
	<a href="logout.php">Log Out</a>

	</div><!--end linkbox-->
	
	</div><!--end profile header-->
	
	<!--php script to output favorite jobs to an html table-->
	<!--settings for output can be adjusted in user preferences php page-->
	<div ="favejobsTable">
	<?php include "faveJobs.php";?>
	</div>
	
	<!--terminado-->
	
	</body>
</html>