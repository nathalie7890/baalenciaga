<?php
session_start();

//delete all senssion varaibles
session_unset();
//destroy all data registered in the session
session_destroy();

header('Location: /');