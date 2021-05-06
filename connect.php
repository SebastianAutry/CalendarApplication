<?php
	$servername = "localhost";
  $username = "benrud_scheduleA";
  $password = "Zu=xeN{vYXkj";
  $dbname = "benrud_scheduleApp";
  
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  //TWO TABLE NAMES:
  // - users (uid, username, password, fName, lName, email)
  // - schedules (uid, userUID, per1, per2, per3, per4, per5, per6, per7, per8, per0)
  
  $inputUser = $conn->real_escape_string($_POST['inputUser']);
  $inputPass = $conn->real_escape_string($_POST['inputPass']);
  $inputFName = $conn->real_escape_string($_POST['inputFName']);
  $inputLName = $conn->real_escape_string($_POST['inputLName']);
  $inputEmail = $conn->real_escape_string($_POST['inputEmail']);
  
  $sql = "INSERT INTO null (username, password, fName, lName, email)
  VALUES ('{inputUser}', '{inputPass}', '{inputFName}', '{inputLName}', '{inputEmail}')";
  
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  
  
  mysqli_close($conn);
?>
