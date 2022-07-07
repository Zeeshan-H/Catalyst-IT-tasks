<?php 

         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = '';
         $dbname = 'db_users';
         $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
         
         if($mysqli->connect_errno ) {
            echo "Failed";
            exit();
         }
         printf('Connected successfully.<br />');
   	
         $sql = "CREATE TABLE users( ".
            "id INT NOT NULL AUTO_INCREMENT, ".
            "name VARCHAR(50) NOT NULL, ".
            "surname VARCHAR(50) NOT NULL, ".
            "email VARCHAR(50), ".
            "PRIMARY KEY ( id)); ";
	if ($mysqli->multi_query($sql)) {
            printf("Users table created successfully.<br />");
	      if (($open = fopen("users.csv", "r")) !== FALSE) 
  {
  
    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) 
    {        
      $array[] = $data; 
    }
  
    fclose($open);
  }
  $users = array_shift($array);	
  echo "<pre>";
  //To display array data
  var_dump($array);	
  echo "</pre>";
	foreach($array as $row)
	{
	$name = mysqli_real_escape_string($mysqli, $row[0]);
        $surname = mysqli_real_escape_string($mysqli, $row[1]);
        $email = mysqli_real_escape_string($mysqli, $row[2]);
	$name = ucfirst($name);
	$surname = ucfirst($surname);
	if(!is_valid_email($email))
	echo $email. "is in invalid format! \n";
	else 
	{
     $query ="INSERT INTO users (name, surname, email) VALUES ( '". $name."','".$surname."','".$email."' )";
	$mysqli->multi_query($query);
	}
   }

	echo "Data parsed from csv file and saved into database table! \n";

}

         if ($mysqli->errno) {
            printf("Could not create table: %s<br />", $mysqli->error);
         }
         $mysqli->close();


function is_valid_email($email)
{
  return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;	
}

?>