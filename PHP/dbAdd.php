<?php

  session_start();
  require_once(__DIR__."/../webdb/vendor/autoload.php");
  require_once(__DIR__."/../webdb/generated-conf/config.php");

  date_default_timezone_set('UTC');

  $sites = array(
    "Semestr I" => "semesterI",
    "Semestr II" => "semesterII",
    "Semestr III" => "semesterIII",
    "Semestr IV" => "semesterIV",
    "Semestr V" => "semesterV",
    "Piłka Nożna" => "football",
    "Gra na gitarze" => "guitar",
    "Index" => "index"
  );
$TYPE = $_POST["TYPE"];
  if($_SESSION["RESULT"] == $_POST["SUM"]){
    $NICK = substr(trim($_POST["NICK"]),0,15);

    $INFO = $_POST["INFO"];

    $opinion = new Opinion();
    $opinion->setName($TYPE);
    $opinion->setNick($NICK);
    $opinion->setData($INFO);
    $opinion->save();
    session_destroy();
    session_unset();
    header("location: ../".$_POST["FOLD"].$sites[$TYPE].".php");
  }else{
    session_destroy();
    session_unset();
    header("location: ../".$_POST["FOLD"].$sites[$TYPE].".php?what=error");
  }

?>
