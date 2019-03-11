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
			<p>Il mio carrello</p>
			<hr>
			<?php
			if(isset($_SESSION['carrello'])){
				$totale = 0;
			foreach ($_SESSION['carrello'] as $key) {
				$ref = "index.php?comando=mostraProdotto" . $key['id_p'];
				echo "ID: {$key['id_p']} Nome: ";?>
				<a href="<?php echo "$ref?" ?>">
				<?php echo "{$key['nome']} ";?></a>
				<?php echo "Prezzo: {$key['prezzo']}&#8364;<br>";
				$totale+= $key['prezzo'];
			}
			echo "<br>Prezzo totale: {$totale}&#8364;";
		}
			else echo "Nessun prodotto &egrave stato aggiunto al carrello."
			?>
			<hr>
			<input type="submit" name="comando" value="Svuota il carrello" class="acquista">
			<br>
		</form>
		<form action="index.php" method="POST">
			<p>Inserisci i dati per il pagamento</p>
			<hr>
			Numero di carta: <input type="text" name="numCard" required="required"><br>
			Scadenza:
			<select name="mese" required="required">
							<option disabled selected>--</option>
							<option value="1">01</option>
							<option value="2">02</option>
							<option value="3">03</option>
							<option value="4">04</option>
							<option value="5">05</option>
							<option value="6">06</option>
							<option value="7">07</option>
							<option value="8">08</option>
							<option value="9">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						<select name="anno" required="required">
							<option disabled selected>--</option>
							<option value="2014">2014</option>
							<option value="2015">2015</option>
							<option value="2016">2016</option>
							<option value="2017">2017</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
							<option value="2022">2022</option>
							<option value="2023">2023</option>
							<option value="2024">2024</option>
						</select><br>
			<input type="submit" name="comando" value="Acquista" class="accedi">
			</form>

		</div>
		<div id="right"> 
			<?php echo $html;
			?>
		
		 </div>
		<div id="bottom">
		<span class="bottom"><a href="index.php?comando=privacy">Informativa sulla privacy </a>&nbsp;
			&nbsp;&copy 2013, eCraft.it</span>
		</div>
	</div>
	</body>
</html>