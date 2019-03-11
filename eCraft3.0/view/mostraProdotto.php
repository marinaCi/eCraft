<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/mostraProdotto.css">
		<title>eCraft</title>
	</head>
	<body>
		<div id="all">
			<a href="index.php?comando=home"><div id="top">
				<img src="images/logo.png"></a>
				<div id="search">
				<form action="index.php" method="POST">
				<input type="search" name="ricerca" placeholder="cerca">
				<input type=submit name="comando" value="Cerca" class="search"><br>
				<a href="index.php?comando=ricercaAvanzata">Ricerca avanzata</a>
			 </div>
		</div>
		<div id="left">
					<span>Categorie</span><br>
				<a class="categoria" href="index.php?comando=catalogo/bicchieri">Bicchieri</a><br>
				<a class="categoria" href="index.php?comando=catalogo/bigiotteria">Bigiotteria</a><br>
				<a class="categoria" href="index.php?comando=catalogo/gioielli">Gioielli</a><br>
				<a class="categoria" href="index.php?comando=catalogo/lampade">Lampade</a><br>
				<a class="categoria" href="index.php?comando=catalogo/mobili">Mobili</a><br>
				<a class="categoria" href="index.php?comando=catalogo/orologi">Orologi</a><br>
				<a class="categoria" href="index.php?comando=catalogo/piatti">Piatti</a><br>
				<a class="categoria" href="index.php?comando=catalogo/sedie">Sedie</a><br>
				<a class="categoria" href="index.php?comando=catalogo/statue">Statue</a><br>
				<a class="categoria" href="index.php?comando=catalogo/suppellettili">Suppelettili</a><br>
				<a class="categoria" href="index.php?comando=catalogo/tavoli">Tavoli</a><br>
				<a class="categoria" href="index.php?comando=catalogo/vasi">Vasi</a><br>
			</div>
		<div id="center">
			<form action="index.php" method="POST">
			<?php $prod = $_SESSION['prodotto'];
			$immagine = "images/" . $prod['immagine'];
			?>
			<img class="prodotto" src="<?php echo $immagine?>"><br>
			<?php echo "Nome: {$prod['nome']}"?><br>
			<?php echo "Prezzo: {$prod['prezzo']}&#8364;"?><br>
			<?php echo "Descrizione: {$prod['descrizione']}"?><br>
			<?php echo "Materiali: {$prod['materialePrimario']}"; 
			if($prod['materialeSecondario'] != null) 
				echo ", {$prod['materialeSecondario']}"?><?php
			echo "<br>Disponibilit&agrave: {$prod['disponibilita']}<br>";
			if($_SESSION['logged'] == 1 && $prod['artigiano'] == $_SESSION['username']){
			echo "<br><input type=\"submit\" name=\"comando\" value=\"Elimina\" class=\"acquista\">";
			}
			else if($_SESSION['logged'] == 1 && $_SESSION['tipo'] == "acquirente"){
				if($prod['disponibilita'] == 0){
					echo "Il prodotto non &egrave disponibile!";
				}
			else echo "<br><input type=\"submit\" name=\"comando\" value=\"Aggiungi al carrello\" class=\"acquista\">";
			}
			else{
				echo "<br>Per acquistare il prodotto devi essere registrato come acquirente!";
			}?>
			</form>

		</div>
		<div id="right"> 
			<?php echo $html;
			?>
		</form>
		 </div>
		<div id="bottom">
		<span class="bottom"><a href="index.php?comando=privacy">Informativa sulla privacy </a>&nbsp;
			&nbsp;&copy 2013, eCraft.it</span>
		</div>
	</div>
	</body>
</html>