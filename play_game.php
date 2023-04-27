<?php

// These are the guts to the wrestling dice game.
// This file should not be called directly; it is launched by index.php.

// Check if form was submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // Get selected wrestler options from form
 $wrestler1file = $_POST["wrestler1"];
 $wrestler2file = $_POST["wrestler2"];
 $wrestler3file = $_POST["wrestler3"];
 $wrestler4file = $_POST["wrestler4"];

 // Load wrestler attribute files

 include_once("wrestlers/" . $wrestler1file);
 $wrestler1 = array (
  "name" => $stats['name'],
  "hitpoints" => $stats['hitpoints'],
  "offense" => $stats['offense'],
  "defense" => $stats['defense'],
  "pin_range" => $stats['pin_range'],
  "dq_range" => $stats['dq_range'],
  "finisher1" => $stats['finisher1'],
  "finisher2" => $stats['finisher2'],
  "finisher3" => $stats['finisher3']
 );

 include_once("wrestlers/" . $wrestler2file);
 $wrestler2 = array (
  "name" => $stats['name'],
  "hitpoints" => $stats['hitpoints'],
  "offense" => $stats['offense'],
  "defense" => $stats['defense'],
  "pin_range" => $stats['pin_range'],
  "dq_range" => $stats['dq_range'],
  "finisher1" => $stats['finisher1'],
  "finisher2" => $stats['finisher2'],
  "finisher3" => $stats['finisher3']
 );
 $howmany = 2;

 if ($wrestler3file != "none") {
  include_once("wrestlers/" . $wrestler3file);
  $wrestler3 = array (
   "name" => $stats['name'],
   "hitpoints" => $stats['hitpoints'],
   "offense" => $stats['offense'],
   "defense" => $stats['defense'],
   "pin_range" => $stats['pin_range'],
   "dq_range" => $stats['dq_range'],
   "finisher1" => $stats['finisher1'],
   "finisher2" => $stats['finisher2'],
   "finisher3" => $stats['finisher3']
  );
  $howmany++;
  } else {
   $wrestler3 = "";
  }

 if ($wrestler3file != "none" && $wrestler4file != "none") {
  include_once("wrestlers/" . $wrestler4file);
  $wrestler4 = array (
   "name" => $stats['name'],
   "hitpoints" => $stats['hitpoints'],
   "offense" => $stats['offense'],
   "defense" => $stats['defense'],
   "pin_range" => $stats['pin_range'],
   "dq_range" => $stats['dq_range'],
   "finisher1" => $stats['finisher1'],
   "finisher2" => $stats['finisher2'],
   "finisher3" => $stats['finisher3']
  );
  $howmany++;
  } else {
   $wrestler4 = "";
  }

}

// Other initializations

$num_rounds = 0;
$damage = 0;
$offender = "";
$prev_winner = "";
$end_match = 0;

//Let's run the match now.

while ($end_match == 0) {
 $roll['wrestler1'] = rand(1, 6);
 $roll['wrestler2'] = rand(1,6);
 if ($howmany == 3) { $roll['wrestler3'] = rand(1,6);}
 if ($howmany == 4) { $roll['wrestler4'] = rand(1,6); }

 arsort($roll);
 $r_winner = key ($roll);
 end ($roll);
 $r_loser = key($roll);
 reset($roll);

 switch ($r_winner) {
  case "wrestler1":
   $damage = $wrestler1['offense'];
   $partdamage = floor($wrestler1['offense'] / 2);
    switch ($r_loser) {
     case "wrestler4":
       $def = $wrestler4['defense'];
       if ($prev_winner == "wrestler1") {
        if ($def > $damage) { $wrestler4['hitpoints'] -= $damage; }
        else {$wrestler4['hitpoints'] -= ($damage - $def); }
       } else {
      if ($def > $partdamage) { $wrestler4['hitpoints'] -= $damage; }
       else {$wrestler4['hitpoints'] -= ($partdamage - $def); }
      }
     break;
     case "wrestler3":
     $def = $wrestler3['defense'];
     if ($prev_winner == "wrestler1") {
      if ($def > $damage) { $wrestler3['hitpoints'] -= $damage; }
       else {$wrestler3['hitpoints'] -= ($damage - $def); }
     } else {
      if ($def > $partdamage) { $wrestler3['hitpoints'] -= $damage; }
       else {$wrestler3['hitpoints'] -= ($partdamage - $def); }
      }
     break;
     case "wrestler2":
     $def = $wrestler2['defense'];
     if ($prev_winner == "wrestler1") {
      if ($def > $damage) { $wrestler3['hitpoints'] -= $damage; }
       else {$wrestler2['hitpoints'] -= ($damage - $def); }
     } else {
      if ($def > $partdamage) { $wrestler2['hitpoints'] -= $damage; }
       else {$wrestler2['hitpoints'] -= ($partdamage - $def); }
     break;
    } //End r_winner=wrestler1, r_loser=2,3,4
 break;
 case "wrestler2":
   $damage = $wrestler2['offense'];
   $partdamage = floor($wrestler2['offense'] / 2);
    switch ($r_loser) {
     case "wrestler4":
       $def = $wrestler4['defense'];
       if ($prev_winner == "wrestler2") {
        if ($def > $damage) { $wrestler4['hitpoints'] -= $damage; }
        else {$wrestler4['hitpoints'] -= ($damage - $def); }
       } else {
      if ($def > $partdamage) { $wrestler4['hitpoints'] -= $damage; }
       else {$wrestler4['hitpoints'] -= ($partdamage - $def); }
      }
     break;
     case "wrestler3":
     $def = $wrestler3['defense'];
     if ($prev_winner == "wrestler2") {
      if ($def > $damage) { $wrestler3['hitpoints'] -= $damage; }
       else {$wrestler3['hitpoints'] -= ($damage - $def); }
     } else {
      if ($def > $partdamage) { $wrestler3['hitpoints'] -= $damage; }
       else {$wrestler3['hitpoints'] -= ($partdamage - $def); }
      }
     break;
     case "wrestler1":
     $def = $wrestler1['defense'];
     if ($prev_winner == "wrestler2") {
      if ($def > $damage) { $wrestler1['hitpoints'] -= $damage; }
       else {$wrestler1['hitpoints'] -= ($damage - $def); }
     } else {
      if ($def > $partdamage) { $wrestler1['hitpoints'] -= $damage; }
       else {$wrestler1['hitpoints'] -= ($partdamage - $def); }
     break;
     }
 break;
 case "wrestler3":
   $damage = $wrestler3['offense'];
   $partdamage = floor($wrestler3['offense'] / 2);
    switch ($r_loser) {
     case "wrestler4":
       $def = $wrestler4['defense'];
       if ($prev_winner == "wrestler3") {
        if ($def > $damage) { $wrestler4['hitpoints'] -= $damage; }
        else {$wrestler4['hitpoints'] -= ($damage - $def); }
       } else {
      if ($def > $partdamage) { $wrestler4['hitpoints'] -= $damage; }
       else {$wrestler4['hitpoints'] -= ($partdamage - $def); }
      }
     break;
     case "wrestler2":
     $def = $wrestler2['defense'];
     if ($prev_winner == "wrestler3") {
      if ($def > $damage) { $wrestler2['hitpoints'] -= $damage; }
       else {$wrestler2['hitpoints'] -= ($damage - $def); }
     } else {
      if ($def > $partdamage) { $wrestler2['hitpoints'] -= $damage; }
       else {$wrestler2['hitpoints'] -= ($partdamage - $def); }
      }
     break;
     case "wrestler1":
     $def = $wrestler1['defense'];
     if ($prev_winner == "wrestler3") {
      if ($def > $damage) { $wrestler1['hitpoints'] -= $damage; }
       else {$wrestler1['hitpoints'] -= ($damage - $def); }
     } else {
      if ($def > $partdamage) { $wrestler1['hitpoints'] -= $damage; }
       else {$wrestler1['hitpoints'] -= ($partdamage - $def); }
     break;
     }
 break;
 case "wrestler4":
   $damage = $wrestler4['offense'];
   $partdamage = floor($wrestler4['offense'] / 2);
    switch ($r_loser) {
     case "wrestler3":
       $def = $wrestler3['defense'];
       if ($prev_winner == "wrestler4") {
        if ($def > $damage) { $wrestler3['hitpoints'] -= $damage; }
        else {$wrestler3['hitpoints'] -= ($damage - $def); }
       } else {
      if ($def > $partdamage) { $wrestler3['hitpoints'] -= $damage; }
       else {$wrestler3['hitpoints'] -= ($partdamage - $def); }
      }
     break;
     case "wrestler2":
     $def = $wrestler2['defense'];
     if ($prev_winner == "wrestler4") {
      if ($def > $damage) { $wrestler2['hitpoints'] -= $damage; }
       else {$wrestler2['hitpoints'] -= ($damage - $def); }
     } else {
      if ($def > $partdamage) { $wrestler2['hitpoints'] -= $damage; }
       else {$wrestler2['hitpoints'] -= ($partdamage - $def); }
      }
     break;
     case "wrestler1":
     $def = $wrestler1['defense'];
     if ($prev_winner == "wrestler4") {
      if ($def > $damage) { $wrestler1['hitpoints'] -= $damage; }
       else {$wrestler1['hitpoints'] -= ($damage - $def); }
     } else {
      if ($def > $partdamage) { $wrestler1['hitpoints'] -= $damage; }
       else {$wrestler1['hitpoints'] -= ($partdamage - $def); }
     break;
     }
 break;
  }
  }
 } //End round
$num_rounds ++;
$end_match = 1;
 }
}


// Let's create the page header before writing the output.
if ($howmany == 4) {
 $title = $wrestler1['name'] . " vs. " . $wrestler2['name'] . " vs. " . $wrestler3['name'] . " vs. " . $wrestler4['name'];
 } elseif ($howmany == 3) {
 $title = $wrestler1['name'] . " vs. " . $wrestler2['name'] . " vs. " . $wrestler3['name'];
 } elseif ($howmany == 2) {
 $title = $wrestler1['name'] . " vs. " . $wrestler2['name'];
 } else {
 $title = "Match Error";
 }
}

//Page output

?>

<html>
<head>
<title><?php echo $title ?> (Match Result)</title>
</head>
<body>
<center><h1><?php echo $title ?></h1></center>
<p>
<?php echo '<pre>' . print_r(get_defined_vars(), true) . '</pre>'; ?>

</body></html>
