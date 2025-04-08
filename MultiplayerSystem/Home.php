<form method="POST" action="CreaStanza.php">
stanza: <input type="text" name="tipo" placeholder='crea'> 
nome: <input type="text" name="nome"> 
gioco: <input type="text" name="gioco"> 
num: <input type="text" name="numero"> 
    <input type="submit" value="crea stanza"> 
</form>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};
$_SESSION["nome"] = "nome"
?>