<?php
session_start();
?>
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
			<?php
			$immagine = "images/" . $_SESSION['immagine_p'];
			?>
			<img class="prodotto" src="<?php echo $immagine?>"><br>
			<?php echo "Nome: ". $_SESSION['nome_p']?><br>
			<?php echo "Prezzo: ". $_SESSION['prezzo_p'] ."&#8364;"?><br>
			<?php echo "Descrizione: ". $_SESSION['descrizione_p']?><br>
			<?php echo "Materiali: ". $_SESSION['materialePrimario_p']; 
			if($_SESSION['materialeSecondario_p'] != null) 
				echo ", ". $_SESSION['materialeSecondario_p']?><br>
			<?php echo "Categoria: ". $_SESSION['categoria_p']?><br>
			<?php echo "Ambiente: ". $_SESSION['ambiente_p']?></a>
			<?php 
			echo "<br><input type=\"submit\" name=\"comando\" value=\"Inserisci\" class=\"annulla\">&nbsp;";
			echo "<input type=\"submit\" name=\"comando\" value=\"Annulla\" class=\"annulla\">";
			?>
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