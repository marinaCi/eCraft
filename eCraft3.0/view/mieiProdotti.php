<?
session_start();
?>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<title>eCraft</title>
	</head>
	<body>
			<a href="index.php?comando=home"><div id="top">
				<img src="images/logo.png"></a>
				<div id="search">
				<form action="index.php?comando=cerca" method="POST">
				<input type="search" name="ricerca" placeholder="Cerca nel sito">
				<input type="submit" name="comando" value="Cerca" class="search"><br>
				</form>
				<a href="index.php?comando=ricercaAvanzata">Ricerca avanzata</a>
			 </div>
		</div>
		
		<div id="main-content" style: relative>
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
			<p>I miei prodotti</p>
			<hr>
			<table>
				<tr>
				<?php
				if($prodotti == "false"){
						echo "Nessun prodotto corrisponde ai criteri di ricerca!"; 
					}
					else{ 
					
					/*for($i = 0; $i<2; $i++){
					if($prodotti = mysql_fetch_array($mieiProdotti)){
					$immagine = "images/" . $prodotti['immagine'];
					$ref = "index.php?comando=mostraProdotto" . $prodotti['id_p'];
					?>
					<td>
						<a class="prodotto" href="<?php echo "$ref"?>"><img class="prodotto" src="<?php echo $immagine?>"><br><?php echo "Nome: {$prodotti['nome']}"?><br></a>
					</td>
					<?php }} ?>
				</tr>
				<?php 
					for($i = 0; $i<2; $i++){
					if($prodotti = mysql_fetch_array($mieiProdotti)){
					$ref = "index.php?comando=mostraProdotto" . $prodotti['id_p'];
					$immagine = "images/" . $prodotti['immagine'];
					?>
					<td>
						<a class="prodotto" href="<?php echo "$ref"?>"><img class="prodotto" src="<?php echo $immagine?>"><br><?php echo "Nome: {$prodotti['nome']}"?><br></a>
					</td>
				
				<?php
			}}}
			?>*/
					$n = mysql_num_rows($mieiProdotti);
					$r=$n/2;

					for ($i=0;$i<$r;$i++){
						?><tr><?php
						for ($j=0;$j<2;$j++){
							if($prodotti = mysql_fetch_array($mieiProdotti)){
							$immagine = "images/" . $prodotti['immagine'];
							$ref = "index.php?comando=mostraProdotto" . $prodotti['id_p'];
							?>
							<td>
							<a class="prodotto" href="<?php echo "$ref"?>"><img class="prodotto" src="<?php echo $immagine?>"><br><?php echo "Nome: {$prodotti['nome']}"?><br></a>
							</td><?php
							}
						}
						?></tr><?php
					}
				}
			?>

			</tr>
			</table>
		</div>
		<div id="right"> 
			<?php
			echo $html;
		?>
		 </div>
		</div>
		<div id="bottom">
		<span class="bottom"><a href="index.php?comando=privacy">Informativa sulla privacy </a>&nbsp;
			&nbsp;&copy 2013, eCraft.it</span>
		</div>
	</body>
</html>