<?php 

	function connect()
	{
		$conn = new mysqli("localhost", "tester", "123", "wtk");
		if($conn->connect_errno)
		{
			die("failed connection.. ". $conn->connect_errno);
		}
		return $conn;
	}

	function register($firstName, $lastName, $gender, $birthday, $religion, $email, $userName, $password, $pAddress, $perAddress, $phone, $weblink)
	{
		$conn = connect();
		$sql = $conn->prepare("INSERT INTO users(firstname, lastname, gender, birthday, religion, email, userName, password, pAddress, perAddress, phone, weblink) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$sql->bind_param("ssssssssssss", $firstName, $lastName, $gender, $birthday, $religion, $email, $userName, $password, $pAddress, $perAddress, $phone, $weblink);
		return $sql->execute();
	}

	function login($userName, $password)
	{
		$conn = connect();
		$sql = $conn->prepare("SELECT * FROM users WHERE userName = ? and password = ?");
		$sql->bind_param("ss", $userName, $password);
		$sql->execute();
		$res = $sql->get_result();
		return $res->num_rows === 1;
	}

	function findUser($userName)
	{
		$conn = connect();
		$sql = $conn->prepare("SELECT * FROM users WHERE userName = ?");
		$sql->bind_param("s", $userName);
		$sql->execute();
		$res = $sql->get_result();
		return $res->num_rows === 1;
	}

	function setAI()
	{
		$conn = connect();
		$sql = $conn->prepare("ALTER TABLE users id = start_value;");
		$sql->bind_param("s", $userName);
		return $sql->execute();
		$res = $sql->get_result();
		return $res->num_rows === 1;
	}

?>