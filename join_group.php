<!DOCTYPE html>
<html>
<head>
<title>
  SHARE Ur FARE
 </title>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet">
    <link href="welcome.css" rel="stylesheet">
    
<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
$session=$_SESSION['loggedin'];
?>
<style type="text/css">
h1{ font-family: Magneto;
  color:teal;}
  b.red{
    color:red;
  }
  .my{color: red; font-size: 15pt;}
  .col{
    color: #6600FF;
    font-family: "Lucida Handwriting";
  }
  }
  hr{color:blue;}
  body {background-image:url("b1.jpg");}

</style>
</head>
<body style="background-color:lavender;">
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Welcome <?php echo $_SESSION['userlogin']?> !</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="welcome.php"><span class="glyphicon glyphicon-home"></span>  Home</a></li>
            <li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
             <li><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span>  Your Group</a></li>
            <li><a href="#about"><span class="glyphicon glyphicon-phone-alt"></span>  Contacts</a></li>
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>  Profile</a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-th-list"></span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Notifications</a></li>
                <li><a href="http://www.facebook.com">Help</a></li>
                
                <li class="divider"></li>
                <li class="dropdown-header">Account</li>
                <li><a href="#">About Us</a></li>
                
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Help</a></li>
            <li><a href="navbar-static-top/">About Us</a></li>
            <li class="active"><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span>  Sign-out</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

<h1 style="text-align:Center;"><b><font class="id2"><ins>Share Ur Fare</ins></font></b></h1>

<marquee><b class=red>Disclaimer:</b><i>If any person in your group fails to come for the journey,then the site would not be responsible. Hence, user discretion is adviced.</i></marquee>
<span class=align><h1>Group Members</h1></span>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $number=$_POST['number'];
  $book_no=$_POST['book_no'];
if($number>$_POST['limit'])
{
  $message = "Sorry! Cannot join.Group limit exceeded.";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
     exit;
}
$connect=mysql_connect("localhost","root","pcp10");
if(!$connect)
{
  die("Failed to connect: " . mysql_error());
}
if(!mysql_select_db("iitk")){
die("Failed to select DB:" .mysql_error());
}
$key=$_POST['group'];
$res_users=mysql_query("SELECT * FROM users WHERE `key`=$key");
echo '<span class =my>';
$i=1;
$sql1=mysql_query("SELECT gender FROM users WHERE `username`=$session");
$row_gen=mysql_fetch_assoc($sql1);
if($row_gen['gender']!=$_POST['gender']&&$_POST['gender']!="B")
{
$message = "Sorry!.Not allowed due to Gender conflicts.";
echo "<script type='text/javascript'>alert('$message');</script>";
     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=welcome.php">';
     exit;
}
while($row_users=mysql_fetch_assoc($res_users))
{
echo $i.") ".$row_users['name']."(seats booked: ".$row_users['book_no'].")<br><br>";
  $i++;
}
echo "</span>";
echo "<form action='confirm_group.php' method='post'>" ."<input type='hidden' name='username' value='$session'>".
  "<input type='hidden' name='group' value='$key'>"."<input type='hidden' name='number' value='$number'>".
  "<input type='hidden' name='book_no' value='$book_no'>".
  "<input type='submit' name='confirm_group'value='Confirm Group'>"
."</form>";
}
 ?>
</body>
</html>
