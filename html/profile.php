<?php
include "dbvars.php";
	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['submitbutton']))
{


	$chgpasswd = $_POST['chgpasswd'];
	$chgpasswd2 = $_POST['chgpasswd2'];


	if($chgpasswd=="" || $chgpasswd2=="")	{
		$error[] = "Password or Confirmation Password are no the same!";
	}
	else if(strlen($chgpasswd) < 6 || strlen($chgpasswd2) < 6){
		$error[] = "Password must be a least 6 characters.";
	}

	else if($_POST['chgpasswd']!= $_POST['chgpasswd2'])
	{
		$error[] = "Password and Confirmation Password are no the same!";
	}

	else if($_POST['chgpasswd'] === $_POST['chgpasswd2']) {

		$user_pass = $_POST['chgpasswd'];
		$user_pass = password_hash($user_pass, PASSWORD_DEFAULT);


	$sql = "UPDATE `users`
  				 SET `user_pass` = :user_pass
 							WHERE `user_id` = :user_id
			   ";

		$prep = $pdo->prepare($sql);
	$prep->bindParam(':user_pass', $user_pass);
	$prep->bindParam(':user_id', $user_id);
	$prep->execute();

		$_SESSION['message'] = 'Status: Password has updated.';

	}


}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>DataCenter Room Status</title>
</head>

<body>


		<?php include_once('menu.php'); ?>

	<div class="clearfix"></div>
	
    <div class="container-fluid" style="margin-top:80px;">
	
    <div class="container">

		<?php
		$sql = "SELECT * from users where user_id = $user_id";
		$prep = $pdo->prepare($sql);
		$prep->execute();
		$results = $prep->fetchAll();



		?>

        <p class="h2">Profil <?php echo "#".$results[0]['user_id']; ?></p>
		<br />
		<div class="statusedit-bg"><div class="statusedit">
				<?php if(isset($_SESSION['message'])) {
					print $_SESSION['message']; $_SESSION['message'] = null;
				}
				?>
			</div></div>
		<br />
		<div class="profil-edit">
<h4>Username: <?php echo $results[0]['user_name']; ?></h4>
		<h4>Name: <?php echo $results[0]['full_name']; ?></h4>
		<h4>E-mail: <?php echo $results[0]['user_email']; ?></h4>
<br /><br />
		<h4>Istoric</h4>
		<div>Register Date: <?php echo $results[0]['joining_date']; ?></div>

		</div>

		<div class="profil-edit">
<p><strong>Change Password</strong></p>

			<form method="post" class="form-passwd">

			<div class="changepass">
				<input type="password" class="passwd" name="chgpasswd" id="chgpasswd" placeholder="Enter the Password" />
			</div>

			<div class="changepass">
				<input type="password" class="passwd" name="chgpasswd2" id="chgpasswd2" placeholder="Enter the Password Again" />
			</div>
			<br />
			<div class="text-center">
				<input type="submit" id ='submitbutton' name='submitbutton' class="btn btn-md btn-default btn_verde" value="UPDATE DATA">
			</div>


			<div class="clearfix"></div><hr />

		</form>


		</div>



    </div>




</div>


		<script type='text/javascript'>

			$('#submitbutton').on('click',function(e){
				var error = false;
				var msg = "Please solve the error(s):  \n";


				if($("#chgpasswd").val().length < 6 || $("#chgpasswd2").val().length < 6){
					msg += "- Password must be a least 6 characters! \n";
					error = true;
				}

				if($("#chgpasswd").val() !== $("#chgpasswd2").val()){
					msg += "- Password and Confirmation Password are no the same! \n";
					error = true;
				}

				if(error){
					alert(msg);
					e.preventDefault();
					return false;

				}


			});

		</script>



		<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>