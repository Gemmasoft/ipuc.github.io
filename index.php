<?php
session_start();
?>

<?php require_once("includes/connection.php"); ?>
<?php include("includes/header.php"); ?>

<?php
if(isset($_SESSION["session_username"])){
// echo "Session is set"; // for testing purposes
header("Location: vistaPrincipal.php");
}

if(isset($_POST["login"])){

if(!empty($_POST['user']) && !empty($_POST['pwd'])) {
    $username=$_POST['user'];
    $password=$_POST['pwd'];


    $query =mysqli_query($con,"SELECT * FROM usuarios WHERE user='".$username."' AND pwd='".$password."'");

    $numrows=mysqli_num_rows($query);
	
    if($numrows!=0)

    {
    while($row=mysqli_fetch_assoc($query))
    {
    $dbusername=$row['user'];
    $dbpassword=$row['pwd'];

	
    }

    if($username == $dbusername && $password == $dbpassword)

    {


    $_SESSION['session_username']=$username;


    /* Redirect browser */
    header("Location: vistaPrincipal.php");
    }
    } else {

 $message =  "Nombre de usuario ó contraseña invalida!";
    }

} else {
    $message = "Todos los campos son requeridos!";
}
}
?>




    <div class="container mlogin">
            <div id="login">
    <h1>Ipuc</h1>
<form name="loginform" id="loginform" action="" method="POST">
    <p>
        <label for="user_login">Nombre De Usuario<br />
        <input type="text" name="user" id="user" class="input" value="" size="20" /></label>
    </p>
    <p>
        <label for="user_pass">Contraseña<br />
        <input type="password" name="pwd" id="pwd" class="input" value="" size="20" /></label>
    </p>
        <p class="submit">
        <input type="submit" name="login" class="button" value="Entrar" />
    </p>
</form>

    </div>

    </div>
	
	<?php include("includes/footer.php"); ?>
	
	<?php if (!empty($message)) {echo "<p class=\"error\">" . "MESSAGE: ". $message . "</p>";} ?>
	