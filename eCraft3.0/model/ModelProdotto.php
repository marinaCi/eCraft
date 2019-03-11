<?php
session_start(); // inizio della sessione

//connessione al database
include 'connection/connection.php';

    /**
    * Classe Prodotto
    * Descrizione: Classe Model del prodotto
    */

class ModelProdotto{

    /**
    * Metodo di ricerca per nome prodotto
    */

	public function search(){

        $key = $_REQUEST['ricerca'];
        $_SESSION['cerca'] = $key;


        $result = mysql_query("SELECT * FROM prodotto WHERE nome LIKE '%$key%' OR descrizione LIKE '%$key%'") or die(mysql_error());

    	$num_rows = mysql_num_rows($result); 

			if ( $num_rows == 0 )
				return $result = "false";
			else
                return $result;
				
    }	

    /**
    * Metodo di ricerca per categoria del prodotto
    */

    public function search_categoria($categoria){

    	$result = mysql_query("SELECT * FROM prodotto WHERE categoria = '$categoria'")
    		or die(mysql_error()); 	

    	$num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 )
                return $result = "false";
            else
                return $result;

    }

    /**
    * Metodo che restituisce i prodotti in evidenza nella home
    */

    public function random(){

        $result = mysql_query("SELECT * FROM prodotto ORDER BY RAND() LIMIT 0,4") or die(mysql_error()); 
        return $result;
    }

    /**
    * 
    */

    public function anteprimaProdotto(){

    
        $_SESSION['nome_p'] =  $_REQUEST['nome'];
        $_SESSION['prezzo_p'] = $_REQUEST['prezzo'];
        $_SESSION['descrizione_p'] = $_REQUEST['descrizione'];
        $_SESSION['immagine_p'] = $_SESSION['username'].$_SESSION['nome_p'].".jpg";
        $materiali_p = $_REQUEST['materiali'];
        $_SESSION['ambiente_p'] = $_REQUEST['ambiente'];
        $_SESSION['categoria_p'] = $_REQUEST['categoria'];
        $_SESSION['disponibilita'] = $_REQUEST['disponibilita'];
        //chmod($tmp_name, 0777);
        $_SESSION['file_p'] = $_FILES['immagine']['tmp_name'];
         //$cartella = "/membri/ecraft/images";
        //$crea_cartella = mkdir($cartella);
        $file = '/membri/ecraft/images/'.$_SESSION['immagine_p'];
        move_uploaded_file($_SESSION['file_p'], $file);
        $_SESSION['materialePrimario_p'] = $materiali_p[0];
        if(isset($materiali_p[1])){
            $_SESSION['materialeSecondario_p'] = $materiali_p[1];
            return;
        }
    }

    /**
    * Metodo di inserimento prodotto
    */

    public function insertProdotto(){

        $nome = $_SESSION['nome_p'];
        $prezzo = $_SESSION['prezzo_p'];
        $descrizione = $_SESSION['descrizione_p'];
        $immagine = $_SESSION['immagine_p'];
        $ambiente = $_SESSION['ambiente_p'];
        $categoria = $_SESSION['categoria_p'];
        $disponibilita = $_SESSION['disponibilita'];
       

        $nome = mysql_real_escape_string($nome);
        $prezzo = mysql_real_escape_string($prezzo);
        $descrizione = mysql_real_escape_string($descrizione);
        $immagine = mysql_real_escape_string($immagine);
        $ambiente = mysql_real_escape_string($ambiente);
        $categoria = mysql_real_escape_string($categoria);
        $disponibilita = mysql_real_escape_string($disponibilita);
        $artigiano = $_SESSION['username'];
        $materialePrimario = $_SESSION['materialePrimario_p'];



        if(isset($SESSION['materialeSecondario_p'])){

            $materialeSecondario = $_SESSION['materialeSecondario_p'];
            $result = mysql_query("INSERT INTO prodotto VALUES(null, '$nome', '$prezzo', '$descrizione', '$immagine', '$materialePrimario', '$materialeSecondario', '$ambiente', '$categoria', '$artigiano', '$disponibilita')") or die(mysql_error());
        }

        else{
            $result = mysql_query("INSERT INTO prodotto VALUES(null, '$nome', '$prezzo', '$descrizione', '$immagine', '$materialePrimario', null , '$ambiente', '$categoria', '$artigiano', $disponibilita)") or die(mysql_error());
        }


      return $result;

        
    }

    /**
    * Metodo di ricerca degli acquisti dell'utente loggato
    */

    public function selectAcquisti(){

        $username = $_SESSION['username'];

        $result = mysql_query("SELECT * FROM acquisti WHERE acquirente = '$username'") or die(mysql_error());

        $num_rows = mysql_num_rows($result);

        if($num_rows != 0){
            return $result;
        }
        else {
            return $result = "false";
        }
}

    /**
    * Metodo che cerca restituisce gli attributi del prodotto passato come paramentro
    */

    public function selectProdotto($prodotto){
        $result = mysql_query("SELECT * FROM prodotto WHERE id_p = '$prodotto'") or die(mysql_error());
         $num_rows = mysql_num_rows($result);
         if($num_rows == 1){
            return $result;
         }
       
    }

    /**
    * Metodo di ricerca dei prodotti dell'utente loggato
    */

      public function mieiProdotti(){

        $username = $_SESSION['username'];
        $result = mysql_query("SELECT * FROM prodotto WHERE artigiano = '$username'") or die(mysql_error());

        return $result;
      } 

      /**
      * Metodo di ricerca avanzata tramite materiali, categoria e ambiente
      */

      public function ricercaAvanzata(){

        $key = $_REQUEST['prodotto'];
        $materiali = $_REQUEST['materiali'];
        $ambiente = $_REQUEST['ambiente'];
        $categoria = $_REQUEST['categoria'];
        $materialePrimario = $materiali[0];
        $materialeSecondario = $materiali[1];

        if(isset($ambiente)&&isset($categoria)&&isset($materialePrimario)&&isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND ((materialePrimario = '$materialePrimario' AND materialeSecondario = '$materialeSecondario') OR (materialePrimario = '$materialeSecondario' AND materialeSecondario = '$materialePrimario')) AND categoria = '$categoria' AND ambiente = '$ambiente'") or die(mysql_error());
           $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 )
                return $result = "false";
            else
                return $result;
        }

        else if(isset($ambiente)&&isset($categoria)&&isset($materialePrimario)&&!isset($materialeSecondario)){
             $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND (materialePrimario = '$materialePrimario' OR materialeSecondario = '$materialePrimario') AND categoria = '$categoria' AND ambiente = '$ambiente'") or die(mysql_error());
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 )
                return $result = "false";
            else
                return $result;
        }

        else if(isset($ambiente)&&isset($categoria)&&!isset($materialePrimario)&&!isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND categoria = '$categoria' AND ambiente = '$ambiente'") or die(mysql_error());
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 )
                return $result = "false";
            else
                return $result;

        }

        else if(!isset($ambiente)&&isset($categoria)&&isset($materialePrimario)&&isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND ((materialePrimario = '$materialePrimario' AND materialeSecondario = '$materialeSecondario') OR (materialePrimario = '$materialeSecondario' AND materialeSecondario = '$materialePrimario')) AND categoria = '$categoria'") or die(mysql_error());
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 )
                return $result = "false";
            else
                return $result;
        }

        else if(!isset($ambiente)&&!isset($categoria)&&isset($materialePrimario)&&isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND ((materialePrimario = '$materialePrimario' AND materialeSecondario = '$materialeSecondario') OR (materialePrimario = '$materialeSecondario' AND materialeSecondario = '$materialePrimario'))") or die(mysql_error());
           $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 )
                return $result = "false";
            else
                return $result;
        }

        else if(!isset($ambiente)&&!isset($categoria)&&isset($materialePrimario)&&!isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND (materialePrimario = '$materialePrimario' OR materialeSecondario = '$materialePrimario')") or die(mysql_error());
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 )
                return $result = "false";
            else
                return $result;
        }

        else if(!isset($ambiente)&&isset($categoria)&&!isset($materialePrimario)&&!isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%')  AND categoria = '$categoria'") or die(mysql_error());
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 )
                return $result = "false";
            else
                return $result;
        }

        else if(isset($ambiente)&&!isset($categoria)&&!isset($materialePrimario)&&!isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND ambiente = '$ambiente'") or die(mysql_error());
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 ){
                                return $result = "false";
                            }
            else
                return $result;
        }

          else if(isset($ambiente)&&!isset($categoria)&&isset($materialePrimario)&&!isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND ambiente = '$ambiente' AND (materialePrimario = '$materialePrimario' OR materialeSecondario = '$materialePrimario')") or die(mysql_error());
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 ){
                                return $result = "false";
                            }
            else
                return $result;
        }

             else if(!isset($ambiente)&&isset($categoria)&&isset($materialePrimario)&&!isset($materialeSecondario)){
            $result = mysql_query("SELECT * FROM prodotto WHERE (nome LIKE '%$key%' OR descrizione LIKE '%$key%') AND categoria = '$categoria' AND (materialePrimario = '$materialePrimario' OR materialeSecondario = '$materialePrimario')") or die(mysql_error());
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 ){
                                return $result = "false";
                            }
            else
                return $result;
        }


             else if(!isset($ambiente)&&!isset($categoria)&&!isset($materialePrimario)&&!isset($materialeSecondario)){
           $result = mysql_query("SELECT * FROM prodotto WHERE nome LIKE '%$key%' OR descrizione LIKE '%$key%'");
            $num_rows = mysql_num_rows($result); 

            if ( $num_rows == 0 ){
                                return $result = "false";
                            }
            else
                return $result;
        }
}

        /**
        * Metodo di cancellazione prodotto
        */

        public function eliminaProdotto($prodotto){

            $result = mysql_query("DELETE FROM prodotto WHERE id_p = '$prodotto'") or die(mysql_error());
            return $message = "Prodotto eliminato.";
        }

      }


	


?>