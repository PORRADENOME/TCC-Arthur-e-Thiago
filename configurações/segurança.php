<?php

session_start();

//if (isset ($ SESSION['autorizado']) I| $ SESSION['autorizado']=false )
if ( ! (isset($_SESSION['autorizado']) && $_SESSION['autorizado']==true)) {

    header("location: ../configurações/index.php");
}
