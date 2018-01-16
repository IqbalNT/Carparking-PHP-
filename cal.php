

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

            <?php
           $link = mysqli_connect("localhost", "root", "", "carparking");
            if($link === false){
                 die("ERROR: Could not connect. " . mysqli_connect_error());
                    }

        $userid=0;
    if (isset($_GET['print'])) {
        $userid= (int)$_GET['print'];

    }
                $sql = "SELECT ctime,ltime FROM carentry_table WHERE id='5'";

                $result=mysqli_query($link,$sql);
                $row=mysqli_fetch_array($result);
                $time=$row['ctime'];
                echo("Your Entry Time Is : $time<br>");
                $time1=$row['ltime'];
                echo("Your Leaving Time Is : $time1 <br>");
                $sub=$time1-$time;
                echo("Your Total Time Is : $sub Hour <br>");
                $f=$sub*100;
                echo "your bill is :$f taka <br>";


mysqli_close($link);
?>

 


        </div>

<?php
    include 'inc/footer.php';
?>