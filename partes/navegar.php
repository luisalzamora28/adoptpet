<div id="menu">
    <ul>
        <li>  <a href="index.php">Pagina principal </a> </li>
        <li> <a href="adopta.php"> Catalogo</a> </li>
        <li> <a href="Nosotros.php"> Sobre Nosotros</a> </li>
        <li> <a href="contacto.php"> Contacto</a> </li>
        <?php if (isset($_SESSION["nombre"])) { ?>
        <li><a href="admin/index.php"> Dashboard</a></li>
        <?php } else { ?>
        <li> <a href="login.php"> Iniciar Sesion</a> </li>
        <?php } ?>   
        

    </ul>

</div> 