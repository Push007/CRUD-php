<?php
header('Access-Control-Allow-Origin: *');
mysql_connect("10.8.204.169","u1120866_root","12345");
mysql_select_db("db1120866_demo");

if(isset($_GET['type']))
{
	if($_GET['type'] == "login")
		{
		$username = $_GET['UserName'];
        $Password = $_GET['Password'];		
		
	//Create Query
	$query = "Select * from registration Where UserName='$username' and Password='$Password'";
	//Пожар вашего запроса к базе данных
	$result = mysql_query($query);
	//получить общее количество строк из базы данных в соответствии с запросом
	$totalRows = mysql_num_rows($result);
	
	//Подготовка Код для формата JSON
	if($totalRows > 0)
	{
		$recipes = array();
		while($recipe = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		$recipes[] = array('User'=> $recipe);	
		}
		
		$output = json_encode(array('Users' => $recipes));
		
		/*$output = "{LoginStatus:[{Success:true, SuccessCode:200}]}";*/
		echo $output;
		}
	}
	else if($_GET['type'] == "registration")
	{
		$username = $_GET['UserName'];
		$Password = $_GET['Password'];
		//Create Query
		$query = "Insert into registration VALUES ('','$username','$Password')";
		//Fire Query
		$result1 = mysql_query($query);
		
		if($result1)
		{
			$recipes["Success"] = true;
			$recipes["Code"] = 200;
			
			$output = json_encode(array('Users' => $recipes));
			echo $output;
		}
		else
		{
			echo "Got Error While Updating the Record.";
		}
	}
	else if($_GET['type'] == "updation")
	{
		$username = $_GET['UserName'];
		$Password = $_GET['Password'];
		//Create Query
		$query = "Update registration set Password='$Password' where UserName='$username'";
		//Fire Query
		$result1 = mysql_query($query);
		
		if($result1)
		{
			$recipes["Success"] = true;
			$recipes["Code"] = 200;
			
			$output = json_encode(array('Users' => $recipes));
			echo $output;
		}
		else
		{
			echo "Got Error While Updating the Record.";
		}
	}
	else if($_GET['type'] == "delete")
	{
		$username = $_GET['UserName'];
		
		//Create Query
		$query = "Delete from registration where UserName='$username'";
		//Fire Query
		$result1 = mysql_query($query);
		
		if($result1)
		{
			$recipes["Success"] = true;
			$recipes["Code"] = 200;
			
			$output = json_encode(array('Users' => $recipes));
			echo $output;
		}
		else
		{
			echo "Got Error While Deleting the Record.";
		}
	}
}
else
{
	echo "Invalid format";
}
 
?>