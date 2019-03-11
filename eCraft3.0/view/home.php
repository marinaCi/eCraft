<?
session_start();
?>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<title>eCraft</title>
	</head>
	<body>
		<div id="all">
			<a href="index.php?comando=home"><div id="top">
				<img src="images/logo.png"></a>
				<div id="search">
				<form action="index.php" method="POST" style="margin-bottom: 0px;">
				<input type="search" name="ricerca" placeholder="Cerca">
				<input type="submit" name="comando" value="Cerca" class="search"><br>
				</form>
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
			<p>Prodotti in evidenza</p>
			<hr>
			<table>
				<tr>
				<?php for($i = 0; $i<2; $i++){
					if($prodotti = mysql_fetch_array($random)){
					$immagine = "images/".$prodotti['immagine'];
					$ref = "index.php?comando=mostraProdotto" . $prodotti['id_p'];
					?>
					<td>
						<a class="prodotto" href="<?php echo "$ref"?>"><img class="prodotto" src="<?php echo $immagine?>"><br><?php echo "Nome: {$prodotti['nome']}"?><br><?php echo "Prezzo: {$prodotti['prezzo']}&#8364;"?></a>
					</td>
					<?php }} ?>
				</tr>
				<tr>
				<?php 
					for($i = 0; $i<2; $i++){
					if($prodotti = mysql_fetch_array($random)){
					$ref = "index.php?comando=mostraProdotto" . $prodotti['id_p'];
					$immagine = "images/" . $prodotti['immagine'];
					?>
					<td>
						<a class="prodotto" href="<?php echo "$ref"?>"><img class="prodotto" src="<?php echo $immagine?>"><br><?php echo "Nome: {$prodotti['nome']}"?><br><?php echo "Prezzo: {$prodotti['prezzo']}&#8364;"?></a>
					</td>
				
				<?php
			}}
			?>
			</tr>
			</table>
		</div>
		<div id="right"> 
			<h4><?php
			echo $message;?></h4>
			<?php echo $html;
		?>
		 </div>
		</div>
		<div style:"clear:both";></div>
		<div id="bottom">
			<span class="bottom"><a href="index.php?comando=privacy">Informativa sulla privacy </a>&nbsp;
			&nbsp;&copy 2013, eCraft.it</span>
		</div>
	</body>
</html>