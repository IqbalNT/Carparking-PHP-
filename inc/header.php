<?php
	$filepath=realpath(dirname(__FILE__));
	include_once $filepath.'/../lib/Session.php';
	Session::int();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Paeking Page</title>
	<link rel="stylesheet" href="inc/bootstrap.min.css"/>
	<script src="inc/jquery.min.js"></script>
	<script src="inc/bootstrap.min.js"></script>


	<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

</head>
<?php
	if (isset($_GET['action']) && $_GET['action']=="logout") {

		Session::destroy();
	}
?>
<body>
	<div class="container">
		<nav class="navbar navbar-defult">
				<div class="container-fluid well">
						<div class="navbar-header">
							<a class="navbar-brand" href="index.php">Car Parking  System</a>
						</div>
						<ul class="nav navbar-nav pull-right">
							
							<?php
							$id=Session::get("id");
							$userlogin=Session::get("login");
							if ($userlogin==true) {

							?><li>
							<form action="search.php" method="POST">
              			    <input type="text" style="margin:13px 0 0 0 ;"value="Type Here" name="q" size="16"id="searchfield" title="searchfield" onfocus="clearText(this)" onblur="clearText(this)" />
               			    <input type="submit" name="Search" value="Search"id="searchbutton" title="Search" style=""/></form>
            				</li>
							<li><a href="add.php?id<?php echo $id;?>">Add Vichle </a></li>
							<li><a href="index.php ?id<?php echo $id;?>">Show Entry List</a></li>
							<li><a href="?action=logout">Logout</a></li>

							<?php
						}
						else{
							?>
							<li><a href="login.php">Login</a></li>
							<li><a href="register.php">Register</a></li>
							<?php } ?>

						</ul>
				</div>
		</nav>
