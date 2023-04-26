<?php
function getpages(){
	global $con;

	$query4="SELECT * from pages";
	$result=mysqli_query($con, $query4);
	while($row=mysqli_fetch_array($result))
	{
		echo "<li role=\"presentation\"><a href=\"../page.php?title=".$row['title']."\">".$row['title']."</a></li>";
	} 

}
