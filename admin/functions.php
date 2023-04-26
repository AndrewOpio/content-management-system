<?php
function getsocials(){
	global $con;

	$query2="SELECT * from socials";
	$result=mysqli_query($con, $query2);
	while($row=mysqli_fetch_array($result))
	{
		echo "<li><a href=".$row['url']."><img class='card-img' height='30px' width='30px' src='images/".$row['image']."'></a></li>";
	}

}
