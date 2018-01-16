
<?php
	include 'inc/header.php';

?>


<?php
	$loginmsg=Session::get("loginmsg");
	if (isset($loginmsg)) {
		echo $loginmsg;
	}


?>
	<div class="panel panel-body">
		<div class="panel-heading">
			<h2>Your Parking Details</h2>
		</div>
		<div class="panel-body">
			<table class="table table-striped">
				<tr>
					<th >Car Registration Number</th>
					<th >Car Name</th>
					<th  >Car Color</th>
					<th >Car Entry Time</th>
					<th  >Car Leaving Time</th>
				</tr>

<?php
$link = mysqli_connect("localhost", "root", "", "carparking");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$userid=0;
if (isset($_POST['q'])) {
		$userid= (int)$_POST['q'];

	}

$sql = "SELECT * FROM carentry_table WHERE cid=$userid";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['cid'] . "</td>";
                echo "<td>" . $row['carname'] . "</td>";
                echo "<td>" . $row['carcolor'] . "</td>";
                echo "<td>" . $row['ctime'] . "</td>";
                echo "<td>" . $row['ltime'] . "</td>";
        }
        mysqli_free_result($result);
    } else{
        echo "Opppss!!!! No records found ";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>

			</table>

		</div>

<?php
	include 'inc/footer.php';
?>