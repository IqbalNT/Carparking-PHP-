
<?php
	include 'inc/header.php';
	include 'lib/User.php';

?>
<?php
	$user=new user();
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])) {

		$userReg=$user->CarRegistration($_POST);
	}
?>
	<div class="panel panel-body">
		<div class="panel-heading">
			<h2>User Registration </h2>
		</div>
		<div class="panel-body">
			<div style="max-width:600px;margin:0 auto">
<?php
	if (isset($userReg)) {
	echo $userReg;
	}
?>
			<form action="" method="POST">
				<div class="form-group">
					<label for="cid">Enter Car Registration Number </label>
					<input type="text" id="cid" name="cid" class="form-control" />
				</div>
				<div class="form-group">
					<label for="carname">Enter Car Name</label>
					<input type="text" id="carname" name="carname" class="form-control" />
				</div>
				<div class="form-group">
					<label for="carcolor">Enter Car Color </label>
					<input type="text" id="carcolor" name="carcolor" class="form-control" />
				</div>

				<div class="form-group">
					<label for="ctime">Enter Car Parking Time </label>
					<input type="text" id="ctime" name="ctime" class="form-control"/>
				</div>
				<button type="submit" name="register" class="btn btn-success">Submit</button>

			</form>
			</div>

		</div>
	</div>

<?php
	include 'inc/footer.php';
?>