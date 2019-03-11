<?php
session_start(); //inisio della sessione

include_once("model/ModelUtente.php");
include_once("model/ModelProdotto.php");


/**
* Classe Controller
* Descrizione: Controller dell'applicazione
*/

class Controller{

   /**
   * Dichiarazione delle variabili
   */

	public $modelUtente;
   public $modelProdotto;

   /**
   * Costruttore
   */

	public function __construct(){

		$this->modelUtente = new ModelUtente();
      $this->modelProdotto = new ModelProdotto();
	}


   /**
   * Funzione che gestisce l'applicazione tramite i comandi
   */

	public function invoke(){

		 // leggo il comando, per default "home"
      $comando = isset($_REQUEST["comando"])?
                 $_REQUEST["comando"] : "home";
      $random = $this->modelProdotto->random();
      isset($_SESSION['logged'])?
                  $_SESSION['logged'] : 0;
      isset($_SESSION['tipo'])?
                  $_SESSION['tipo'] : 0; 
      
      if(!isset($message)){
         $message = null;
      }


       function artigiano_form(){
         $html = "
         <form action=\"index.php\" method=\"POST\">
         <fieldset>
            <legend>Benvenuto ". $_SESSION['username'] . "</legend>
            <a href=\"index.php?comando=visualizzaDati\">Gestisci profilo</a><br>
            <a href=\"index.php?comando=inserimento\">Inserisci prodotto</a><br>
            <a href=\"index.php?comando=mieiProdotti\">Visualizza i miei prodotti</a><br>
            <br><input type=\"submit\" name=\"comando\" class=\"accedi\" value=\"Logout\">
         </fieldset>
      </form>";
      return $html;
      }

      function acquirente_form(){
            $html = "
             <form action=\"index.php\" method=\"POST\">
         <fieldset>
            <legend>Benvenuto ". $_SESSION['username'] . "</legend>
            <a href=\"index.php?comando=visualizzaDati\">Gestisci profilo</a><br>
            <a href=\"index.php?comando=visualizzaAcquisti\">Visualizza i miei acquisti</a><br>
            <a href=\"index.php?comando=carrello\">Carrello</a><br>
            <input type=\"submit\" name=\"comando\" class=\"accedi\" value=\"Logout\">
         </fieldset>
      </form>";
      return $html;
      }

      function login_form(){
         $html = "
            <form action=\"index.php\" method=\"POST\">
         <fieldset>
            <legend>Login</legend>
            Username<br>  <input type=\"text\" name=\"username\"><br>
            Password<br>  <input type=\"password\" name=\"password\"><br>
            <br>Non sei registrato? <a href=\"index.php?comando=registrazione\">Registrati</a><br>
            <br><input type=\"submit\" name=\"comando\" class=\"accedi\" value=\"Accedi\">
         </fieldset>
      </form>";
      return $html;
       }



      if ($comando == "home"){
         // passo il controllo alla vista "home.php"
         if($_SESSION['logged'] == 0){
            $html = login_form();
         include("view/home.php");
         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/home.php");
            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/home.php");
            }
         }
      }
  

      else if($comando == "Accedi"){
      	
      	$message = $this->modelUtente->login(); //chiama la funzione login dalla classe ModelUtente e ritorna il valore nella variabile $message


		if($message == "artigiano"){
         $message = null;
         $html = artigiano_form();
			include("view/home.php");
      }

      else if($message == "acquirente"){
         $message = null;
         $html = acquirente_form();
         include("view/home.php");
      }
		else if($message == "Username o password errata."){
         $html = login_form();
			include("view/home.php");
      }

		
      }

      else if($comando == "registrazione"){
      	include("view/registrazione.php");
      }

      else if($comando == "Registrati"){

		$message = $this->modelUtente->insert();

      	if($message == "Registrazione avvenuta con successo!"){
      		include("view/operazioneOK.php");
         }
      	else{
      		include("view/registrazione.php");
         }
      }

      else if($comando == "Cerca"){

               
               $prodotti = $this->modelProdotto->search();
            
         if($_SESSION['logged'] == 0){
            $html = login_form();
            include("view/ricerca.php");

         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/ricerca.php");

            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/ricerca.php");

            }

                     
         }
      }

      else if(substr($comando, 0, 8) == "catalogo"){

            $categoria = substr($comando, 9);

            $prodotti = $this->modelProdotto->search_categoria($categoria);

                              if($_SESSION['logged'] == 0){
            $html = login_form();
        include("view/ricerca.php");

         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/ricerca.php");

            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/ricerca.php");

            }

                     
         }

      }

      else if($comando == "inserimento"){
         include("view/inserisciProdotto.html");
      }

      else if($comando == "Inserisci"){

         $sql = $this->modelProdotto->insertProdotto();

         if($sql == "true"){
            $message = "Prodotto inserito con successo!";
            include("view/operazioneOK.php");
         }

         else{
            include("view/inserisciProdotto.html");
         }
      }

      else if($comando == "Logout"){

         $message = $this->modelUtente->logout();
         if($message == "home"){
            $message = null;
            $html = login_form();
            include("view/home.php");
         }
      }

      else if($comando == "visualizzaAcquisti"){

         $acquisti = $this->modelProdotto->selectAcquisti();
         if($_SESSION['logged'] == 0){
            $html = login_form();
          include("view/mostraAcquisti.php");

         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
                include("view/mostraAcquisti.php");

            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
                include("view/mostraAcquisti.php");

            }
         }

      }

      else if($comando == "Elimina account"){

         $username = $_SESSION['username'];

         $message = $this->modelUtente->logout();
         if($message == "home"){
            $message = $this->modelUtente->eliminaAccount($username);
            $message = "Il tuo account &egrave stato cancellato da sistema.";
            include("view/operazioneOK.php");
        }   
      }

      else if(substr($comando, 0, 14) == "mostraProdotto"){

         $prodotto = substr($comando, 14);
         $prodotto = $this->modelProdotto->selectProdotto($prodotto);
         $_SESSION['prodotto'] = mysql_fetch_array($prodotto);
              if($_SESSION['logged'] == 0){
            $html = login_form();
         include("view/mostraProdotto.php");
         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/mostraProdotto.php");
            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/mostraProdotto.php");
            }
      }
   }

      else if($comando == "Acquista"){
         if(isset($_SESSION['carrello'])){
         foreach ($_SESSION['carrello'] as $key){
         $sql = $this->modelUtente->acquista($key['id_p']);
      }
        unset($_SESSION['carrello']);
         
         if($sql == "true"){
            $message = "Acquisto effettuato!";
            include("view/operazioneOK.php");
         }  
         else{
            $message = "Acquisto non avvenuto, riprova!";
            include("view/operazioneOK.php");
         }
   }
   else{
       $message = "Non hai aggiunto alcun prodotto al carrello.";
            include("view/operazioneOK.php");
   }
      
         }

      else if($comando == "ricercaAvanzata"){
         include("view/ricercaAvanzata.html");
      }

     else if($comando == "mieiProdotti"){

         $mieiProdotti = $this->modelProdotto->mieiProdotti();
          $html = artigiano_form();
         include("view/mieiProdotti.php");
      }

      else if($comando == "Applica"){

         $prodotti = $this->modelProdotto->ricercaAvanzata();
                         if($_SESSION['logged'] == 0){
            $html = login_form();
        include("view/ricerca.php");

         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/ricerca.php");

            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/ricerca.php");

            }

                     
         }
      }  

      else if($comando == "visualizzaDati"){

         $dati = $this->modelUtente->visualizzaDati();

         if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/dati.php");
            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/dati.php");
      }
   }

   else if($comando == "Elimina"){

      $prod2 = $_SESSION['prodotto'];
         $p = $prod2['id_p'];


      $message = $this->modelProdotto->eliminaProdotto($p);
      include("view/operazioneOK.php");
   }

   else if($comando == "privacy"){
      include("view/privacy.html");
   }

   else if($comando == "Anteprima"){
      $this->modelProdotto->anteprimaProdotto();
      if($_SESSION['logged'] == 0){
            $html = login_form();
         include("view/anteprimaProdotto.php");
         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/anteprimaProdotto.php");
            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/anteprimaProdotto.php");
            }
         }
   }

   else if($comando == "Annulla"){
      if($_SESSION['logged'] == 0){
            $html = login_form();
         include("view/home.php");
         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/home.php");
            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/home.php");
            }
         }

   }

   else if($comando == "Aggiungi al carrello"){

      $_SESSION['carrello'][] = $_SESSION['prodotto'];
      if($_SESSION['logged'] == 0){
            $html = login_form();
         include("view/carrello.php");
         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/carrello.php");
            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/carrello.php");
            }
         }
     
   }

   else if($comando == "carrello"){
      if($_SESSION['logged'] == 0){
            $html = login_form();
         include("view/carrello.php");
         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/carrello.php");
            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/carrello.php");
            }
         }
   }

   else if($comando == "Svuota il carrello"){
      unset($_SESSION['carrello']);
          if($_SESSION['logged'] == 0){
            $html = login_form();
         include("view/carrello.php");
         }
         else{
            if($_SESSION['tipo'] == "artigiano"){
               $html = artigiano_form();
               include("view/carrello.php");
            }
            else if($_SESSION['tipo'] == "acquirente"){
               $html = acquirente_form();
               include("view/carrello.php");
            }
         }
   }

   else if(substr($comando, 0, 6) == "attiva"){

      $account = substr($comando, 6);
      $message = $this->modelUtente->attivaAccount($account);
      include("view/operazioneOK.php"); 
}
}
}


?>