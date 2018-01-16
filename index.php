
<?php
	include 'lib/user.php';
	include 'inc/header.php';
	
	Session::checksession();
	

?>


<?php
	$loginmsg=Session::get("loginmsg");
	if (isset($loginmsg)) {
		echo $loginmsg;
	}

	Session::set("loginmsg",NULL);

?>
	<div class="panel panel-body">
		<div class="panel-heading">
			<h2>Parking Car List <span class="pull-right">Welcome <strong>
					<?php
					$name= Session::get("name");
					if (isset($name)) {
						echo $name;
					}

					?>
				!</strong></span></h2>
		</div>
		<div class="panel-body">
			<table class="table table-striped">
				<tr>
					<th >Car Registration Number</th>
					<th >Car Name</th>
					<th  >Car Color</th>
					<th >Car Entry Time</th>
					<th  >Car Leaving Time</th>
					<th >Action</th>
				</tr>

<?php
	$user=new user();
	$userdata=$user->getuserdata();
	if ($userdata) {
		$i=0;
		foreach ($userdata as $sdata) {
			$i++;
		
?>
				<tr>
					<td><?php echo $sdata['cid']; ?></td>
					<td><?php echo $sdata['carname']; ?></td>
					<td><?php echo $sdata['carcolor']; ?></td>
					<td><?php echo $sdata['ctime']; ?></td>
					<td><?php echo $sdata['ltime']; ?></td>
					<td>
						<a class="btn btn-primary" href="profile.php?id=<?php 
						echo $sdata['id']; ?>">View</a>
					</td>
				</tr>
<?php } } else{	?>

		<tr><td colspan="5"><h2>No DATA Found.....</h2></td></tr>
		<?php }?>
	


			</table>

		</div>

<?php
	include 'inc/footer.php';
?>