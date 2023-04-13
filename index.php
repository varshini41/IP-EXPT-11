<!DOCTYPE html>
<html>
<head>
	<title>address form</title>
</head>
<body>
	<h2>address Form</h2>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label>address:</label>
		<input type="text" name="address"><br><br>
		<label>city:</label>
		<input type="text" name="city"><br><br>
            <label>state:</label>
		<input type="text" name="state"><br><br>
		<input type="submit" name="submit" value="submit">
	</form>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$address = $_POST['address'];
			$city = $_POST['city'];
                  $state = $_POST['state'];

			// Validate input
			if (empty($address) || empty($city) || empty($state)) {
				echo "fields are required.";
			} if(strlen($state) !== 2) {
                        echo "State must be two letters";
                 } else {
				// Connect to MySQL database
				$servername = "127.0.0.1";
				$username = "root";
				$password = "";
				$dbname = "address";
				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				// Insert data into table
				$sql = "INSERT INTO addresses (address, city,state) VALUES ('$address', '$city','$state')";
				if ($conn->query($sql) === TRUE) {
					echo "insertion successful.";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			}
		}
	?>
</body>
</html>