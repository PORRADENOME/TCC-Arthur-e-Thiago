<?php

session_start();

//if (isset ($ SESSION['autorizado']) I| $_SESSION['autorizado']=false )

if ( isset($_SESSION['autorizado'])==false || $_SESSION['autorizado']!=true) {

    header("location: ../configurações/index.php");
}
