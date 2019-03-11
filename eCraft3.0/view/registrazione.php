<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/registrazione.css">
		<title>eCraft</title>
	</head>
	<body>
		<div id="all">
			<a href="index.php?comando=home">
				<img src="images/logo.png"></a>
			<div id="top">
				<div id="search">
				<form action="index.php" method="POST">
				<input type="search" name="ricerca" placeholder="Cerca nel sito">
				<input type="submit" name="comando" value="Cerca" class="search" ><br>
				</form>
				<a href="index.php?comando=ricerca_avanzata">Ricerca avanzata</a>
			 </div>
		</div>
		<div id="center">
			<h3>Registrazione</h3>
			<h4><?php echo $message;?></h4>
			<form action="index.php" method="POST">
			<table>
				<tr>
					<td>
						Username
					</td>
					<td>
						<input type="text" name="username" required="required" maxlenght="14" tabindex="1">
					</td>
					<td>
						Nome
					</td>
					<td>
						<input type="text" name="nome" required="required" tabindex="5">
					</td>
				</tr>
				<tr>
					<td>
						Password
					</td>
					<td>
						<input type="password" name="pass1" required="required" maxlenght="14" tabindex="2">
					</td>
					<td>
						Cognome
					</td>
					<td>
						<input type="text" name="cognome" required="required" tabindex="6">
					</td>
				</tr>
				<tr>
					<td>
						Ripeti password
					</td>
					<td>
						<input type="password" name="pass2" required="required" maxlenght="14" tabindex="3">
					</td>
					<td>
						Data di nascita
					</td>
					<td>
						<select name="giorno" required="required" tabindex="7">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
							<option value="24">24</option>
							<option value="25">25</option>
							<option value="26">26</option>
							<option value="27">27</option>
							<option value="28">28</option>
							<option value="29">29</option>
							<option value="30">30</option>
							<option value="31">31</option>
						</select>
						<select name="mese" required="required" tabindex="8">
							<option value="1">Gennaio</option>
							<option value="2">Febbraio</option>
							<option value="3">Marzo</option>
							<option value="4">Aprile</option>
							<option value="5">Maggio</option>
							<option value="6">Giugno</option>
							<option value="7">Luglio</option>
							<option value="8">Agosto</option>
							<option value="9">Settembre</option>
							<option value="10">Ottobre</option>
							<option value="11">Novembre</option>
							<option value="12">Dicembre</option>
						</select>
						<select name="anno" required="required" tabindex="9">
							<option value="2011">2011</option>
							<option value="2010">2010</option>
							<option value="2009">2009</option>
							<option value="2008">2008</option>
							<option value="2007">2007</option>
							<option value="2006">2006</option>
							<option value="2005">2005</option>
							<option value="2004">2004</option>
							<option value="2003">2003</option>
							<option value="2002">2002</option>
							<option value="2001">2001</option>
							<option value="2000">2000</option>
							<option value="1999">1999</option>
							<option value="1998">1998</option>
							<option value="1997">1997</option>
							<option value="1996">1996</option>
							<option value="1995">1995</option>
							<option value="1994">1994</option>
							<option value="1993">1993</option>
							<option value="1992">1992</option>
							<option value="1991">1991</option>
							<option value="1990">1990</option>
							<option value="1989">1989</option>
							<option value="1988">1988</option>
							<option value="1987">1987</option>
							<option value="1986">1986</option>
							<option value="1985">1985</option>
							<option value="1984">1984</option>
							<option value="1983">1983</option>
							<option value="1982">1982</option>
							<option value="1981">1981</option>
							<option value="1980">1980</option>
							<option value="1979">1979</option>
							<option value="1978">1978</option>
							<option value="1977">1977</option>
							<option value="1976">1976</option>
							<option value="1975">1975</option>
							<option value="1974">1974</option>
							<option value="1973">1973</option>
							<option value="1972">1972</option>
							<option value="1971">1971</option>
							<option value="1970">1970</option>
							<option value="1969">1969</option>
							<option value="1968">1968</option>
							<option value="1967">1967</option>
							<option value="1966">1966</option>
							<option value="1965">1965</option>
							<option value="1964">1964</option>
							<option value="1963">1963</option>
							<option value="1962">1962</option>
							<option value="1961">1961</option>
							<option value="1960">1960</option>
							<option value="1959">1959</option>
</select>
					</td>
				</tr>
				<tr>
					<td>
						Email
					</td>
					<td>
						<input type="text" name="email" required="required" tabindex="4">
					</td>
					<td>
						Indirizzo
					</td>
					<td>
						<input type="text" name="indirizzo" required="required" tabindex="10">
					</td>
				</tr>
				<tr>
					<td>
						Scegli il tipo di utente:
					</td>
					<td>
						Artigiano<input type="radio" name="tipo" value="artigiano"/>
						Acquirente<input type="radio" name="tipo" value="acquirente" checked/>
					</td>
					<td>
						Civico
					</td>
					<td>
						<input type="text" name="civico" required="required" tabindex="11">
					</td>
				</tr>
				<tr>
					<td colspan="2" rowspan="9">
					<!--INSERIRE LA LEGGE QUI!! -->
						Informativa sulla privacy<br>
							<textarea disabled="disabled">
								Gentile Signore/a,

ai sensi del D.Lgs. 196/2003, sulla tutela delle persone e di altri soggetti rispetto al trattamento dei dati personali, il trattamento delle informazioni che La riguardano, sar&agrave improntato ai principi di correttezza, liceit&agrave e trasparenza e tutelando la Sua riservatezza e i Suoi diritti.

In particolare, i dati idonei a rivelare l'origine razziale ed etnica, le convinzioni religiose, filosofiche o di altro genere, le opinioni politiche, l'adesione a partiti, sindacati, associazioni od organizzazioni a carattere religioso, filosofico, politico o sindacale, nonch&egrave i dati personali idonei a rivelare lo stato di salute e la vita sessuale, possono essere oggetto di trattamento solo con il consenso scritto dell'interessato e previa autorizzazione del Garante per la protezione dei dati personali (articolo 26).
							</textarea>
					</td>
					<td>
					Citt&agrave
					</td>
					<td>
						<input type="text" name="citta" required="required" tabindex="12">
					</td>
				</tr>
				<tr>		
					<td>
						CAP
					</td>
					<td>
						<input type="text" name="cap" required="required" tabindex="13">
					</td>
				</tr>
				<tr>
					<td>
						Provincia
					</td>
					<td>
						<input type="text" name="provincia" required="required" tabindex="14">
					</td>
				</tr>
				<tr>
					<td>
						Nazione
					</td>
					<td>
						<input type="text" name="nazione" required="required" tabindex="15">
					</td>
				</tr>
				<tr>
					<td>
						Codice Fiscale
					</td>
					<td>
						<input type="text" name="codicefiscale" required="required" tabindex="16">
					</td>
				</tr>
				<tr>
					<td>
						Partita IVA*
					</td>
					<td>
						<input type="text" name="partitaiva" tabindex="17">
					</td>
				</tr>
				<tr>
					<td>
						Telefono
					</td>
					<td>
						<input type="text" name="telefono" tabindex="18">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						*Da compilare solo se &egrave stata scelta la voce "Artigiano".
					</td>
				<tr>
				</tr>
				<tr>
					<td colspan="3">
						<input type="checkbox" name="condizioni" required="required" tabindex="19">Dichiaro di aver letto e accetto le condizioni sulla privacy.
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="submit" name="comando" class="registrati" value="Registrati" tabindex="20">
					</td>
				</tr>
			</table>
			</form>
		</div>
		<div id="bottom">
			<span class="bottom"><a href="index.php?comando=privacy">Informativa sulla privacy </a>&nbsp;
			&nbsp;&copy 2013, eCraft.it</span>
		</div>