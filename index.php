
<!DOCTYPE html>
<html>

<head>
	<title>Forum</title>
	<link href="forum.css" rel="stylesheet">
	<meta charset="UTF-8">
    <link rel="icon" href="eclair-confrontation.jpg"/>
</head>

<body class="accueil">

<header>  
<ul>
<?php

	session_start();

	$base = mysqli_connect("localhost", "root", "", "forum");
	mysqli_set_charset($base, "utf8");


	if (isset($_GET['sous-categorie']))
	{
	$caracteres="/?categorie=";
	$categorie=$_GET['numcategorie'];
	$caracteres2="/?topic=";
	$topic=$_GET['numtopic'];
	$_SESSION['categorie']=$_GET['nomcategorie'];

	$_SESSION['topic']=$_GET['nomtopic'];


	$pages=$caracteres."".$categorie."".$caracteres2."".$topic;

	header('location: forum.php'.$pages);

	}
	if(isset($_POST['deco']))
	{
	unset($_SESSION['login']);
	unset($_SESSION['password']);
	}

	if(isset($_SESSION['login']))
	{
	$login=$_SESSION['login'];
	$querygrade="SELECT grade from utilisateurs where login='$login'";
	$resultgrade=mysqli_query($base, $querygrade);
	$grade=mysqli_fetch_array($resultgrade);

	if(($grade['grade']==1)||($grade['grade']==2))
	{
?>

	<div>
	<li><a href="administration.php">Administration</a></li>
	</div>
	<?php
	}
	else
	{
	?>

	<div>
	</div>
	<?php
	}
	?>

	<div class="deco">
	<form  method="post" action="index.php">
		<input type="submit" name="deco" value="Déconnexion">
	</form>
	</div>
<?php
	}
	else
	{
?>
<header>
	<div class="tete">
        <a href="index.php"><img src="titre-rappeur.png" width="900" height="402"></a>
    </div>
	<div class="en-tete">
	<li><a href="connexion.php">Connexion</a></li>
	<li><a href="inscription.php">Inscription</a></li>
	</div>
</header>
<?php
}
?>

</ul>
</header>

<?php

$sql = 'SELECT id, titre from categories';

$query= mysqli_query($base, $sql);

?>

<main>
<section class="sectionaccueil">




<?php
while ($data=mysqli_fetch_array($query))
{
?>

	<article class="categorie">
		<span><?php echo $data['titre']; ?></span>

				<?php
				$sql2="SELECT sous_categorie.titre, sous_categorie.id  as idsous, id_categorie, categorie.id from sous_categorie, categorie where id_categorie = categorie.id";
				$query2=mysqli_query($base, $sql2);
				while($data2=mysqli_fetch_array($query2))
				{
				if($data2['id_categorie']==$data['id'])
				{
				?>

				<div>
				<form class="topic" method="get" action="index.php">
				<input type="hidden" name="numcategorie" value="<?php echo $data2['id_categorie'];?>">
				<input type="hidden" name="numtopic" value="<?php echo $data2['idsous']; ?>">
				<input type="hidden" name="nomcategorie" value="<?php echo $data['titre'];?>">
				<input type="hidden" name="nomtopic" value="<?php echo $data2['titre'];?>">
				<input type="submit" name="sous-categorie" value="<?php echo $data2['titre'];?>">
				</form><br>
				</div>
				<?php
				}
				}
				?>

	</article>
<?php
}
?>

</section>
</main>

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
