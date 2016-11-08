

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
global $now;
    global $pora;

    
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

function default_date(){

        $now=date('m-d');
        $birthday_day='05-08';
    
    seasonal($now,$birthday_day);
}
    
        
function seasonal_date(){
    
    $mc=substr($_POST['actual_date'],3,2);
    $day=substr($_POST['actual_date'],0,2);
    $now=$mc.'-'.$day;  
    
    $mc_birthday=substr($_POST['birthday_date'],3,2);
    $day_birthday=substr($_POST['birthday_date'],0,2);
    $birthday_day=$mc_birthday.'-'.$day_birthday;  
    
    seasonal($now,$birthday_day);
}
    
    
    
        
function seasonal($now,$birthday_day){ 
        
    $zima = '12-21'; //początek pory roku
    $wiosna = '03-22';
    $lato = '06-21';
    $jesien = '09-21';
    $pora = '';
    
    
    if(($now >=$wiosna) && ($now<$lato) && ($now != $birthday_day)){
        $pora = 'spring';
    } elseif (($now >=$lato) && ($now<$jesien) && ($now != $birthday_day)){
        $pora = 'summer';
    }elseif(($now >= $zima)||($now<$wiosna) && ($now != $birthday_day)){
        $pora = 'winter';
    }elseif($now == $birthday_day) {
        $pora = 'birthday';
    }

    
    background($pora);
}
    
    
    
function background($pora){ 
        
        
  if($pora=='winter'){
      echo 'zima';
  } else if($pora=='spring') {
      echo 'wiosna';
  } else if ($pora=='summer'){
      echo 'lato';
  } else if($pora=='birthday') {
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

<body class="tlo <?php if($start_function){seasonal_date();} if($start_default_background){default_date();}?>">

   
        <form action="" method="POST">
           <div class="form">
                <input type="text" name="actual_date" id="datepicker" class="actual_date" placeholder="Wybierz datę by zmienić tło">
                <input type="text" name="birthday_date" id="datepicker2" class="birthday_date" placeholder="Data urodzenia">
            </div>
                <input type="submit" name="form_callendar" value="Zmień">
                <?php if(isset($error['brak_dat'])){echo '<div class="errors">' . $error['brak_dat'] . '</div>';} ?>
            
        </form>
   



</body>
</html>
