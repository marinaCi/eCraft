<?php

//connessione al database
include 'connection/connection.php';

  	/**
    * Classe Utente
    * Descrizione: Classe Model dell'utente
    */

class ModelUtente{

	/**
	* Metodo di login
	*/ 

	
	public function login(){
		
		$username = $_REQUEST['username'];
		$password = $_REQUEST['password'];

		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		$pass = md5($password);

		$result = mysql_query("SELECT * FROM utente WHERE username = '$username' AND password = '$pass' AND attivo = 1");
		
		$num_rows = mysql_num_rows($result); 

		if($num_rows == 1){ 

			$array = mysql_fetch_row($result);
			
			$_SESSION['logged'] = 1;
			$_SESSION['username'] = $username;
			 	if($array[15] == "artigiano"){
			 		$_SESSION['tipo'] = "artigiano";
			 		return "artigiano";
			 	}
			 	else{
			 		$_SESSION['tipo'] = "acquirente";
			 		return "acquirente";
			 	}
			}

		else{
			$_SESSION['logged'] = 0;
			$_SESSION['tipo'] = 0;
			$message = "Username o password errata.";
			return $message;
			}

			
	
}

	/**
	* Metodo di logout
	*/


	public function logout(){

			session_unset();
			session_destroy();
			return $message = "home";
		}


	
	/**
	* Metodo di inserimento di un nuovo utente
	*/

	public function insert(){

			//controllo username già esistente

			$username = $_REQUEST['username'];
			

			$result = mysql_query("SELECT username FROM utente WHERE username = '$username'") 
			or die(mysql_error());

			$num_rows = mysql_num_rows($result); 

			if ( $num_rows == 0 ) {

			$pass1 = $_REQUEST['pass1'];
			$pass2 = $_REQUEST['pass2'];

			//controllo password

			if($pass1 == $pass2){

			

			//controllo email valida o duplicata
			$email = $_REQUEST['email'];
		

			if(filter_var($email, FILTER_VALIDATE_EMAIL)){ 
    		
    		$result2 = mysql_query("SELECT email FROM utente WHERE email = '$email'")
    		or die(mysql_error()); 	

    		$num_rows2 = mysql_num_rows($result2);

    		if ( $num_rows2 == 0) {

    			$nome = $_REQUEST['nome'];
				$cognome = $_REQUEST['cognome'];
				$giorno = $_REQUEST['giorno'];
				$mese = $_REQUEST['mese'];
				$anno = $_REQUEST['anno'];
				//concateno la data
				$datanascita = $giorno."/".$mese."/".$anno;
				$indirizzo = $_REQUEST['indirizzo'];
				$civico = $_REQUEST['civico'];
				$citta = $_REQUEST['citta'];
				$cap = $_REQUEST['cap'];
				$provincia = $_REQUEST['provincia'];
				$nazione = $_REQUEST['nazione'];
				$codicefiscale = $_REQUEST['codicefiscale'];
				$partitaiva = $_REQUEST['partitaiva'];
				$telefono = $_REQUEST['telefono'];
				$tipo = $_REQUEST['tipo'];

				$pass1 = mysql_real_escape_string($pass1);
				$pass_md5 = md5($pass1);
				$username = mysql_real_escape_string($username);
				$tipo = mysql_real_escape_string($tipo);
				$nome = mysql_real_escape_string($nome);
				$cognome = mysql_real_escape_string($cognome);
				$datanascita = mysql_real_escape_string($datanascita);
				$indirizzo = mysql_real_escape_string($indirizzo);
				$civico = mysql_real_escape_string($civico);
				$citta = mysql_real_escape_string($citta);
				$cap = mysql_real_escape_string($cap);
				$provincia = mysql_real_escape_string($provincia);
				$nazione = mysql_real_escape_string($nazione);
				$codicefiscale = mysql_real_escape_string($codicefiscale);
				$partitaiva = mysql_real_escape_string($partitaiva);
				$telefono = mysql_real_escape_string($telefono);
				$tipo = mysql_real_escape_string($tipo);

	

			if ($tipo == "artigiano" && $partitaiva!= null) {
				mysql_query("INSERT INTO utente VALUES('$username', '$pass_md5', '$email', '$nome', '$cognome', STR_TO_DATE('$datanascita', '%m/%d/%Y'), '$indirizzo', '$civico', '$citta', '$cap', '$provincia', '$nazione', '$codicefiscale', '$partitaiva', '$telefono', '$tipo', 0)") or die(mysql_error());
			
			}

			else {
				mysql_query("INSERT INTO utente VALUES('$username', '$pass_md5', '$email', '$nome', '$cognome', STR_TO_DATE('$datanascita', '%m/%d/%Y'), '$indirizzo', '$civico', '$citta', '$cap', '$provincia', '$nazione', '$codicefiscale', null, '$telefono', '$tipo', 0)") or die(mysql_error());
			}

			

			//invio email di conferma
			

			$attivazione = "http://www.ecraft.altervista.org/index.php?comando=attiva". $username;
			$a= $email;
			$oggetto="Registrazione a eCraft";
			$messaggio="Sei stato registrato al sito eCraft! Clicca sul seguente link o copialo nella barra degli indirizzi per attivare l'account: " .$attivazione;
			$intestazioni= "From:";
			$intestazioni .= "NO-REPLY";
			$intestazioni .= "X-Mailer: PHP/".phpversion();
			mail($a, $oggetto, $messaggio, $intestazioni);

			
			
	} 	else{
			$message = "Indirizzo e-mail gi&agrave in uso<br>";
			return($message);
		}

	} 	else{
			$messagge = "L'indirizzo email non &egrave valido<br>";
			return($message);
		}	

	} 
		else{
			$message = "Le due password non coincidono<br>";
			return($message);
		}	

	}
		else {
			$message = "Username gi&agrave in uso<br>";
			return($message);
		}
	
            $message = "Registrazione avvenuta con successo!";
            return($message);
       }


       /**
       * Metodo di eliminazione account
       */
    
      public function eliminaAccount($username){

      	$result = mysql_query("DELETE FROM utente WHERE username = '$username'") or die(mysql_error());

      	return $result;
      }

      public function acquista($p){


      	$acquirente = $_SESSION['username'];
      	$data = date("Y-m-d");

      	
      	$result = mysql_query("INSERT INTO acquisti VALUES(null, '$acquirente', '$p', '$data')") or die(mysql_error());

      	$d = mysql_query("SELECT disponibilita FROM prodotto WHERE id_p = '$p'") or die(mysql_error());

      	$ds = mysql_fetch_array($d);

      	$nd = --$ds['disponibilita'];

      	$x = mysql_query("UPDATE prodotto SET disponibilita = '$nd' WHERE id_p = '$p'") or die(mysql_error());

      	$r = mysql_query("SELECT email FROM utente WHERE username = '$acquirente'") or die(mysql_error());

      	$m = mysql_fetch_array($r);

      		$a = $m['email'];
			$oggetto="Acquisto";
			$messaggio="Hai acquistato un prodotto su eCraft";
			$intestazioni= "From:";
			$intestazioni .= "NO-REPLY";
			$intestazioni .= "X-Mailer: PHP/".phpversion();
			mail($a, $oggetto, $messaggio, $intestazioni);

		$r = mysql_query("SELECT artigiano FROM prodotto WHERE id_p = '$p'") or die(mysql_error());

		$ar = mysql_fetch_array($r);

		$art = $ar['artigiano'];


			$r = mysql_query("SELECT email FROM utente WHERE username = '$art'");

			$m = mysql_fetch_array($r);

			$a = $m['email'];
			$oggetto="Un tuo prodotto &egrave; stato acquistato";
			$messaggio="Un tuo prodotto &egrave; stato acquistato";
			$intestazioni= "From:";
			$intestazioni .= "NO-REPLY";
			$intestazioni .= "X-Mailer: PHP/".phpversion();
			mail($a, $oggetto, $messaggio, $intestazioni);
      

      return $result;

      }

      /**
      * Metodo che restituisce i dati dell'utente loggato
      */


      public function visualizzaDati(){

      	$username = $_SESSION['username'];

      	$result = mysql_query("SELECT * FROM utente WHERE username = '$username'") or die(mysql_error());
      	return $result;
      }

      public function attivaAccount($username){
      	$result = mysql_query("UPDATE utente SET attivo=1 WHERE username = '$username'") or die(mysql_error());
      	return $message = "Account attivato";
      }

    
}


?>