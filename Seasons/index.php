

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Seasons</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:400,300,500,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/queries.css">
    <script src="js/script.js"></script>
</head>

<?php

$start_function=false;
$start_default_background=false; 

    
if(isset($_POST['form_callendar'])){
    $error=array();
    if(($_POST['actual_date']=='') || ($_POST['birthday_date']=='')){
        $error['brak_dat']="Uzupełnij daty!";
        $start_default_background=true;   
        
    }elseif(($_POST['actual_date']!='') && ($_POST['birthday_date']!='')){
        $start_function = true;
    }
}else {
    $start_default_background=true;   
}

function default_background(){
        $zima = '12-21'; //początek pory roku
        $wiosna = '03-22';
        $lato = '06-21';
        $jesien = '09-21';

        $teraz=date('m-d');
        $urodziny='05-08';
        $spring = ($teraz >=$wiosna) && ($teraz<$lato) && ($teraz != $urodziny);
        $summer = ($teraz >=$lato)&&($teraz<$jesien) && ($teraz != $urodziny);
        $winter = ($teraz >= $zima)||($teraz<$wiosna) && ($teraz != $urodziny);
        $birthday = ($teraz == $urodziny);

      if($winter){
          echo 'zima';
      } else if($spring) {
          echo 'wiosna';
      } else if ($summer){
          echo 'lato';
      } else if($birthday) {
          echo 'urodziny';
      } else {
          echo 'jesien';
        } 
    } 
        
function tlo(){
    
    $mc=substr($_POST['actual_date'],3,2);
    $day=substr($_POST['actual_date'],0,2);
    
    $correct_format_date=$mc.'-'.$day;  
    $mc_birthday=substr($_POST['birthday_date'],3,2);
    $day_birthday=substr($_POST['birthday_date'],0,2);
    
    $correct_format_birthday_date=$mc_birthday.'-'.$day_birthday;   
        
    $zima = '12-21'; //początek pory roku
    $wiosna = '03-22';
    $lato = '06-21';
    $jesien = '09-21';
    
    $spring = ($correct_format_date >=$wiosna) && ($correct_format_date<$lato) && ($correct_format_date != $correct_format_birthday_date);
    $summer = ($correct_format_date >=$lato)&&($correct_format_date<$jesien) && ($correct_format_date != $correct_format_birthday_date);
    $winter = ($correct_format_date >= $zima)||($correct_format_date<$wiosna) && ($correct_format_date != $correct_format_birthday_date);
    $birthday = ($correct_format_date == $correct_format_birthday_date);
    
  if($winter){
      echo 'zima';
  } else if($spring) {
      echo 'wiosna';
  } else if ($summer){
      echo 'lato';
  } else if($birthday) {
      echo 'urodziny';
  } else {
      echo 'jesien';
  }
}

/*function filter(){
    //$teraz=date('H:i');
    $teraz='23:15';
    $start_dzien = '07:00';
    $start_noc = '19:00';
    $dzien = ($teraz>$start_dzien) && ($teraz<$start_noc);
    
    if(!$dzien){
        echo 'night'; //noc
    } else {
        echo 'day'; //dzień
    }  
}*/
?>

<body class="tlo <?php if($start_function){tlo();} if($start_default_background){default_background();}?>">

   
        <form action="" method="POST">
           <div class="form">
                <input type="text" name="actual_date" id="datepicker" class="actual_date" placeholder="Wybierz datę">
                <input type="text" name="birthday_date" id="datepicker2" class="birthday_date" placeholder="Data urodzenia">
            </div>
                <input type="submit" name="form_callendar" value="Zmień">
                <?php if(isset($error['brak_dat'])){echo '<div class="errors">' . $error['brak_dat'] . '</div>';} ?>
            
        </form>
   



</body>
</html>
