<?php
//host address (localhost/127.0.0.1 for self-testing, owner ip for remote connection)
$dbhost = "localhost";

//DB username
$username = "root";

//DB password
$password = "student";

//DB name
$bingeables = "bingeables";

//creating new DB connection
$mysqli = new mysqli("$dbhost", "$username", "$password", "$bingeables");

//checking if incoming request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //storing username and password from recieved data (from client: "username=user&password=pass")
    $user = $_POST["username"];
    $pass = $_POST["password"];

    //query to select password for a given username in the login_table
    $query = "SELECT Password FROM login_table WHERE Username = ?";

    //initialize statement for DB connection
    $stmt = $mysqli->stmt_init();

    //check that query is valid
    if(!$stmt->prepare($query))
    {
        echo "query failed";
    }
    else
    {
        //bind $user variable to ? in $query
        $stmt->bind_param("s", $user);

        //execute query statement
        $stmt->execute();

        //store result as object
        $result = $stmt->get_result();

        //collect result array from object
        $row = $result->fetch_array(MYSQLI_ASSOC);

        //test DB password with sent password and echo result
        if ($row["Password"] == $pass) {
            echo "true";
        } else {
            echo "false";
        }
    }
  }
?>