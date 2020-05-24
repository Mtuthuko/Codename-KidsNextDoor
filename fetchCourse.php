<?php
require 'conn.php'



$mysql_qry="select * from Course where course_code ;";
$result = mysqli_query($conn,$mysql_qry);

if ( mysqli_num_rows( $result ) > 0 )
{
	while($row = $result->fetch_assoc()) {
        echo "course_code: " . $row["course_code"]. " - no_of_students: " . $row["no_of_students"]. ;
      }

}
else
{

echo 'error'
}

$conn->close();
?>