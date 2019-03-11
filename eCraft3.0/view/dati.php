<?
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
				<form action="index.php?comando=cerca" method="POST">
				<input type="search" name="ricerca" placeholder="Cerca nel sito">
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
			<form action="index.php" method="POST">
			<p>I miei dati</p>
			<hr>
		<?php 
		while($mieiDati = mysql_fetch_array($dati)){
			echo "{$mieiDati['nome']} {$mieiDati['cognome']}<br>";
			echo "{$mieiDati['indirizzo']} , {$mieiDati['civico']}<br>";
			echo "{$mieiDati['citta']} , {$mieiDati['cap']}, {$mieiDati['provincia']}<br>";
			echo "{$mieiDati['nazione']}<br>";
			echo "{$mieiDati['email']}<br>";
			echo "<br>";
			echo "<br><input type=\"submit\" name=\"comando\" value=\"Elimina account\" class=\"acquista\">";
		}
	?>
			</tr>
			</table>
		</form>
		</div>
		<div id="right"> 
			<?php
			echo $html;
		?>
		 </div>
		<div id="bottom">
			<span class="bottom"><a href="index.php?comando=privacy">Informativa sulla privacy </a>&nbsp;
			&nbsp;&copy 2013, eCraft.it</span>
		</div>
	</div>
	</body>
</html>