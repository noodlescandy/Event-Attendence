# Event-Attendence
This project uses PHP and SQL queries on a database in order to allow a user to add students from a table and events from another table to an attendance table and query the results. This was created for my COS300 Database Systems class as an assignment.

Not included: credentials.php (for security reasons). 
This file contains the $host, $user, $pass, $db, and $mysqli variables necessary for connection to the SQL database. Additionally, it checks if there is a mysqli_connect_errno().
It also contains the function, written below, which is used in most of the other files:
```
// included in credentials.php -- Runs the query provided on the database and 
// processes the rows into options for a dropdown. Used in addToEvent.php and attendanceRptForm.php
function getOptions($mysqli, $query){
	if($result = $mysqli->query($query)){
		if($result->num_rows > 0){
			while($row = $result->fetch_array()){
				echo "<option value='".serialize($row)."'>".$row[1]."</option>";
			}
		}
		else{
			echo "No rows returned.";
		}
		$result->close();
	}
	else{
		echo "Error in querying: $query. ".mysqli->error;
	}
	echo "</select><br>";
}
```
