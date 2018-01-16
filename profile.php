
<?php
	include 'lib/user.php';
	include 'inc/header.php';
	Session::checksession();


?>

<!doctype html>
<html> 
<head>
	<script>
function myFunction() {
    window.alert(11);
}
</script>
</head>

<?php
	if (isset($_GET['id'])) {
		$userid= (int)$_GET['id'];

	}
	$user =new User();
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update'])) {

		$updateusr=$user->updateuserdata($userid,$_POST);
	}

?>


	<div class="panel panel-body">
		<div class="panel-heading">
			<h2>Car Details <span class="pull-right"><a class="btn btn-primary" href="index.php">Back</a></span></h2>
		</div>


		<div class="panel-body">
			<div style="max-width:600px;margin:0 auto">

<?php
	if (isset($updateusr)) {
		echo $updateusr;
	}

?>

<?php
	$userdata=$user->getuserbyid($userid);
	if($userdata) {

?>

			<form action="" method="POST">

				<div class="form-group">
					<label for="cid">Your Car Registration Number</label>
					<input type="text" id="cid" name="cid" class="form-control" value="<?php echo $userdata->cid?>"/>
				</div>
				<div class="form-group">
					<label for="carname">Your Car Name </label>
					<input type="text" id="carname" name="carname" class="form-control" value="<?php echo $userdata->carname?>"/>
				</div>
				<div class="form-group">
					<label for="carcolor">Your Car Color </label>
					<input type="text" id="carcolor" name="carcolor" class="form-control" value="<?php echo $userdata->carcolor?>"/>
				</div>
				<div class="form-group">
					<label for="ctime">Car  Entry time </label>
					<input type="text" id="ctime" name="ctime" class="form-control"/ value="<?php echo $userdata->ctime?>">
				</div>
				<div class="form-group">
					<label for="ltime">Car  Leaving time(This part You Can Update Only) </label>
					<input type="text" id="ltime" name="ltime" class="form-control" value="<?php echo $userdata->ltime?>"/ >
				</div>

				<button type="submit" name="update" class="btn btn-success">Update</button>
			
			
			



<?php
           $link = mysqli_connect("localhost", "root", "", "carparking");
            if($link === false){
                 die("ERROR: Could not connect. " . mysqli_connect_error());
                    }

    }
                $sql = "SELECT ctime,ltime FROM carentry_table WHERE id='$userid'";

                $result=mysqli_query($link,$sql);
                $row=mysqli_fetch_array($result);
                $time=$row['ctime'];
                $time1=$row['ltime'];
                
                $sub=$time1-$time;
                echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your Total Time Is : $sub Hour &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                $f=$sub*100;
                echo "Your bill is :$f taka <br>";


mysqli_close($link);
?>

			
</form>

				
				
			

	
			</div>

		</div>
	</div>

<?php
	include 'inc/footer.php';
?>