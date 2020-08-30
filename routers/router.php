<?php
include '../includes/connect.php';
$success=false;

$username = $_POST['username'];
$password = $_POST['password'];



$username=htmlspecialchars($_POST['username']);
$username=mysqli_real_escape_string($con, $_POST['username']);

$password=htmlspecialchars($_POST['password']);
$password=mysqli_real_escape_string($con, $_POST['password']);


$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username'  and role='Administrator'") or die(mysqli_error($con));
while($row=mysqli_fetch_array($result)){
	$dbpassword=$row['password'];
	
	if(password_verify($password, $dbpassword)){
	$success = true;
	$user_id = $row['id'];
	$name = $row['name'];
	$role= $row['role'];
	}
	else{
		echo "Wrong Username or Password, try again";
		exit();
	}
}

if($success == true)
{	
	session_start();
	$_SESSION['admin_sid']=session_id();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['role'] = $role;
	$_SESSION['name'] = $name;

	header("location: ../admin-page.php");
}
else
{
	$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' 
                                    AND role='Customer'") or die(mysqli_error($con));;
	while($row = mysqli_fetch_array($result))
	{
		$dbpassword=$row['password'];
	if(password_verify($password, $dbpassword)){
		$success = true;
		$user_id = $row['id'];
		$name = $row['name'];
		$role= $row['role'];
		}
		else{
			echo "Wrong Username or Password, try again";
			exit();
		}

	}
	if($success == true)
	{
		session_start();
		$_SESSION['customer_sid']=session_id();
		$_SESSION['user_id'] = $user_id;
		$_SESSION['role'] = $role;
		$_SESSION['name'] = $name;			
		header("location: ../index.php");
	}
	else
	{	
		?>
		<script>alert("Wrong Username or Password, try again");
		window.location.href="../login.php";
		</script>
		<?php
		// header("location: ../login.php");
	}
}
?>