<!-- Classe para deslogar o usuario do sistema
authors: Andreza Raquel e Dandara Navarro
-->
<?php 
session_start(); 
session_destroy();
header('Location: paginaInicial.html');
?>