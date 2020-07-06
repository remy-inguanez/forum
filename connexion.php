
<!DOCTYPE html>
<html>

<head>
	<link href="forum.css" rel="stylesheet">
	<title>Connexion-Forum</title>
	<meta charset="UTF-8">
    <link rel="icon" href=""/>
</head>

<body class="connexion">

<header>
<div class="tete">
        <a href="index.php"><img src="titre-rappeur.png" width="900" height="402"></a>
    </div>

				<li><a href="index.php">Accueil</a></li>
				<li><a href="inscription.php">Inscription</a></li>		
</header>

<?php	

session_start();

if(!isset($_SESSION['login']))
{
if((isset($_POST['Valider']))&&(isset($_POST['field1']))&&(isset($_POST['field2'])))
{

	$connexion= mysqli_connect("localhost", "root", "", "forum"); 
	$login=$_POST['field1'];
	$query="SELECT *from utilisateurs WHERE login='$login'";
	$result= mysqli_query($connexion, $query);
	$row = mysqli_fetch_array($result);
	
	if(password_verify($_POST['field2'],$row['password'])) 
	{
	$_SESSION['login'] = $_POST['field1'];
	$_SESSION['password'] = $_POST['field2'];
	header ('location: profil.php');
	}
	else
	{	
	?>

	<div class="erreur">
	<img src="erreur.jpg" width="2%">
	<div class="affichage">
	<?php
	echo "*Login ou mot de passe incorrect";	
	?>

	</div>
	</div>
	<?php
	}
}

?>
	
<section>
	<div class="form-style-5">
		<form method="post" action="connexion.php">
		<legend>Connexion</legend>	
		<div class="input">
		<input type="text" name="field1" placeholder="Login *">
		</div>
		<div class="input">
		<input type="password" name="field2" placeholder="Password *">
		</div>
		<div class="inputvalider">
		<input type="submit" name="Valider" value="Se connecter"/>
		</div>
		</form>
	</div>
</section>				

<?php
}
else
{
	header('location: profil.php');
}
?>	

<div class="page">
	<div class="FooterBottom">
		<div class="FooterBottomInfo">
			<div class="FooterBottomCopyright">
				<div class="FooterCopyrightBottom">
					Charte de confidentialité &emsp;
					Mentions Légales &emsp;
						Forum Contenders © &emsp; Remy.I  Adam.T ©  &emsp; 2020  &emsp; Tous droits réservés.
				</div>
			</div>
			<div class="Footerparentaladvisory">
			<img src="1200px-Parental_Advisory_label.svg.png" width="150" height="95">
			</div>
		</div>
	</div>
</div>

</body>

</html>
