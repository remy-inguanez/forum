
<!DOCTYPE html>
<html>

<?php
session_start();

if(!isset($_SESSION['login']))
{
?>

<head>
	<link href="forum.css" rel="stylesheet">
	<title>Inscription-Forum</title>
	<meta charset="UTF-8">
    <link rel="icon" href=""/>
</head>

<body class="inscription">

<header>
<div class="tete">
        <a href="index.php"><img src="titre-rappeur.png" width="900" height="402"></a>
    </div>
		<li><a href="index.php">Accueil</a></li>
		<li><a href="connexion.php">Connexion</a></li>			
</header>

<?php


if(!empty($_POST['Valider']))
{
	$connexion= mysqli_connect("localhost", "root", "", "forum"); 
	$login=$_POST['field1'];
	$req="SELECT  *from utilisateurs WHERE login='$login'";
    $query=mysqli_query($connexion, $req) or die(mysqli_error($connexion));
    $result=mysqli_num_rows($query);
		
	if((($_POST['field2']!=$_POST['field3'])||($result>0))||(strlen($_POST['field2'])< 5))
	{
		if(($_POST['field2']!=$_POST['field3'])&&($result>0))
		{
			?>

			<div class="erreur">
			<img src="erreur.jpg" width="2%">
			<div class="affichage">
			<?php
			echo"*Mots de passes rentrés différents";
			?>

			</div>
			<div class="affichage">
			<?php
			echo"*Veuillez renseigner un autre login";
			mysqli_close($connexion);
			?>

			</div>
			</div>
			<?php
		}
		else if((strlen($_POST['field2'])< 5)&&($result>0))
		{  
			?>

			<div class="erreur">
			<img src="erreur.jpg" width="2%">
			<div class="affichage">
			<?php
			echo"*Veuillez renseigner un autre login";
			?>

			</div>
			<div class="affichage">
			<?php
			echo"*Mots de passes trop courts";
			echo" 5 caractères minimum";
			mysqli_close($connexion);
			?>

			</div>
			</div>
			<?php			
		}	
		else if($result>0)
		{	  
			?>

			<div class="erreur">
			<img src="erreur.jpg" width="2%">
			<div class="affichage">
			<?php
			echo "*Veuillez renseigner un autre login";
			?>

			</div>
			</div>
			<?php
			mysqli_close($connexion);	
		}
		else if($_POST['field2']!=$_POST['field3'])
		{  
			?>

			<div class="erreur">
			<img src="erreur.jpg" width="2%">
			<div class="affichage">
			<?php
			echo"*Mots de passes rentrés différents";
			mysqli_close($connexion);
			?>

			</div>
			</div>
			<?php			
		}
		else if(strlen($_POST['field2']< 5))
		{  
			?>

			<div class="erreur">
			<img src="erreur.jpg" width="2%">
			<div class="affichage">
			<?php
			echo"*Mots de passes trop courts";
			echo " 5 caractères minimum";
			mysqli_close($connexion);
			?>

			</div>
			</div>
			<?php			
		}	
	}	
	else
	{	

			$hash = password_hash($_POST['field2'], PASSWORD_BCRYPT, ['cost' => 12]);					
			$connexion= mysqli_connect("localhost", "root", "", "forum"); 
			$req2 = 'INSERT INTO `utilisateurs`(`login`,`password`)VALUES
			("'.$_POST['field1'].'", "'.$hash.'");';		
			mysqli_query($connexion, $req2);		 
			mysqli_close($connexion);
			header('Location: connexion.php');	
			
			
	}
}

?>


<section>
	<div class="form-style-5">
		<form method="post" action="inscription.php">
		<legend>Inscrivez-vous</legend>
		

		<div class="input">
		<input type="text" name="field1" placeholder="Login *">
		</div>
		<div class="input">
		<input type="password" name="field2" placeholder="Password *">
		</div>
		<div class="input">
		<input type="password" name="field3" placeholder="Confirm Password *">
		</div>
		<div class="inputvalider">
		<input type="submit" name="Valider" value="S'inscrire"/>
		</div>
		</form>
	</div>
</section>				

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

<?php
}
else
{
	header('location:index.php');
}
?>

</html>
