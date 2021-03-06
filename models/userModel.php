<?php
class userModel{
	//un and pass will come from the form
	public function checkUser($email, $password){
				
		$db = new PDO("mysql:hostname=localhost;dbname=ssl_note","root","root");
		$sql = "select * 
				from user
				where email=:email and password=:password";
		$st = $db->prepare($sql);
		$st -> execute(array(":email"=>$email, ":password"=>md5($password)));
		$row = $st -> fetch();
		
		return $row;
	}
	
	public function createUser($username, $email, $password, $firstname, $lastname){
		$db = new PDO ("mysql:hostname=localhost;dbname=ssl_note","root","root");
		//Make a variable for the sql query
		$sql = "insert into user(
				username,
				email,
				password,
				firstname,
				lastname)
				values(:username, :email, :password, :firstname, :lastname)";
		//Prepare the statement - store it in a variable
		$statement = $db -> prepare($sql);
		//Execute the statement - passing all the values to the query that we received when the function is called
		$obj = $statement -> execute(array(":username" => $username, ":email" => $email, ":password" => md5($password), ":firstname" => $firstname, ":lastname" => $lastname ));

		$user['userId'] = $db -> lastInsertId();
		$user['username'] = $username;
		$user['password'] = $password;
		$user['email'] = $email;
		$user['firstname'] = $firstname;
		$user['lastname'] = $lastname;
		
		
		
		$sql = "insert into category(
				categoryUserId,
				categoryTitle
				)
				Values(:categoryUserId, :categoryTitle)";
		//Prepare the statement - store it in a variable
		$statement = $db -> prepare($sql);
		//Execute the statement - passing all the values to the query that we received when the function is called
		$obj = $statement -> execute(array(":categoryUserId" => $user['userId'], ":categoryTitle" => "Notes"));
		
		
		return $user;
	}
	
	public function updateUser($id = '', $username = '', $email = '', $password = '', $firstname = '', $lastname = ''){
		$db = new PDO ("mysql:hostname=localhost;dbname=ssl_note","root","root");

		$sql = "update user set
				username = :username,
				email = :email,
				password = :password,
				firstname = :firstname,
				lastname = :lastname
				where
				userId = :userId";
		$statement = $db -> prepare($sql);
	
		$statement -> execute(array(":userId"=>$id, ":username" => $username, ":email" => $email, ":password" => md5($password), ":firstname" => $firstname, ":lastname" => $lastname));
				
		$user['userId'] = $id;
		$user['username'] = $username;
		$user['password'] = $password;
		$user['email'] = $email;
		$user['firstname'] = $firstname;
		$user['lastname'] = $lastname;
		
		return $user;
	}

}