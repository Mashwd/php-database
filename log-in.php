<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>log-in</title>
</head>
<body style="background: #F3F3F3;">
	<?php 
		define("filepath", "data.txt");

        $userName = $password = $email = "";
        $userNameErr = $passwordErr = "";
        $successfulMessage = $errorMessage = "";
        $flag = false;
        $logFlag = false;

        if($_SERVER['REQUEST_METHOD'] === "POST") {
	        $userName = $_POST['username'];
	        $password = $_POST['password'];

	        if(empty($userName)) {
		        $userNameErr = "Username can not be empty!";
		        $flag = true;
	        }
	        if(empty($password)) {
		        $passwordErr = "Password can not be empty!";
		        $flag = true;
	        }
	        if(!$flag)
	        {
	        	 $userName = test_input($userName);
	        	 $password = htmlspecialchars($password);

	        	 $fileData = read();
	    		 $fileDataExplode = json_decode($fileData,true);
	    		 
		    	foreach((object)$fileDataExplode as $candidate) {
				    if($candidate['userName'] === $userName and $candidate['password'] === $password)
				    {
				    	$logFlag = True;
				    	header('Location: \log in\welcomePage.html ');
				    }
			    }

			    if(!$logFlag)
			    {
			    	$errorMessage = "log-in failed";
			    }
			    
	        }
	    }

        function test_input($data) {
	        $data = trim($data);
	        $data = stripslashes($data);
	        $data = htmlspecialchars($data);
	        return $data;
        }

        function read() {
		    $resource = fopen(filepath, "r");
		    $fz = filesize(filepath);
		    $fr = "";
		    if($fz > 0) {
		    	$fr = fread($resource, $fz);
	    	}
		    fclose($resource);
		    return $fr;
		}
	    
    ?>

	<div style = "position: absolute; top: 40%; left: 50%; transform: translate(-49%, -49%);">

		<h2 style="text-align:center; font-size: 30px;font-family:optima;">Please log-in!</h2> 

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete = 'off'>
			<fieldset style = "background: lightslategray;">

				
				<label for="username" style="float: left;">Username <span style="color: red;">*</span>: </label>
				
				<input type="text" name="username" id="username" style = "float: right;" value="<?php echo $userName; ?>">
				<span style="color: red; float: right;"><?php echo $userNameErr; ?></span>
				
				

				<br><br>

				
				<label for="password" style="float: left;">Pasword <span style="color: red;">*</span>: </label>
				 
				<input type="password" name="password" id="password" style = "float: right;">
				<br><br>
				<span style="color: red;float: right;"><?php echo $passwordErr; ?></span>

			</fieldset>
			<input type="submit" name="submit" value="log in" style="background: ghostwhite; font-family: Times roman;  float: right;">
		</form>
		<button style="color: lightslategray;" onclick="document.location.href='createAccount.php'">Register</button>
		<br>

		<!--<span style="color: green;"><?php /*echo $successfulMessage;*/ ?></span> -->
		<span style="color: red; text-align: center;"><?php echo $errorMessage; ?></span>


	</div>

</body>
</html>