<?php

include 'dbvars.php';

$hours = 24;

$sth = $pdo->prepare("SELECT dateandtime FROM temperaturedata WHERE sensor = 'Senzor1' AND dateandtime > now() - interval :hours hour");
$sth->bindValue('hours', $hours);
$sth->execute();
$r = $sth->fetch(PDO::FETCH_ASSOC);
$rows = array();
$rows['name'] = 'dateandtime';
while($r = $sth->fetch(PDO::FETCH_ASSOC)) {
    $rows['data'][] = $r['dateandtime'];
}

$sth = $pdo->prepare("SELECT temperature FROM temperaturedata WHERE sensor = 'Senzor1' AND dateandtime > now() - interval :hours hour");
$sth->bindValue('hours', $hours);
$sth->execute();
$r = $sth->fetch(PDO::FETCH_ASSOC);
$rows1 = array();
$rows1['name'] = 'temperature';
while($r = $sth->fetch(PDO::FETCH_ASSOC)) {
    $rows1['data'][] = $r['temperature'];
}

$sth = $pdo->prepare("SELECT humidity FROM temperaturedata WHERE sensor = 'Senzor1' AND dateandtime > now() - interval :hours hour");
$sth->bindValue('hours', $hours);
$sth->execute();
$rows2 = array();
$rows2['name'] = 'humidity';
while($r = $sth->fetch(PDO::FETCH_ASSOC)) {
    $rows2['data'][] = $r['humidity'];
}

// 

$sth = $pdo->prepare("SELECT dateandtime FROM temperaturedata WHERE sensor = 'Senzor2' AND dateandtime > now() - interval :hours hour");
$sth->bindValue('hours', $hours);
$sth->execute();
$rows3 = array();
$rows3['name'] = 'dateandtime';
while($r = $sth->fetch(PDO::FETCH_ASSOC)) {
    $rows3['data'][] = $r['dateandtime'];
}

$sth = $pdo->prepare("SELECT temperature FROM temperaturedata WHERE sensor = 'Senzor2' AND dateandtime > now() - interval :hours hour");
$sth->bindValue('hours', $hours);
$sth->execute();
$rows4 = array();
$rows4['name'] = 'temperature';
while($r = $sth->fetch(PDO::FETCH_ASSOC)) {
    $rows4['data'][] = $r['temperature'];
}

$sth = $pdo->prepare("SELECT humidity FROM temperaturedata WHERE sensor = 'Senzor2' AND dateandtime > now() - interval :hours hour");
$sth->bindValue('hours', $hours);
$sth->execute();
$rows5 = array();
$rows5['name'] = 'humidity';
while($r = $sth->fetch(PDO::FETCH_ASSOC)) {
    $rows5['data'][] = $r['humidity'];
}

$result = array();
array_push($result,$rows);
array_push($result,$rows1);
array_push($result,$rows2);
array_push($result,$rows3);
array_push($result,$rows4);
array_push($result,$rows5);


// 
print json_encode($result, JSON_NUMERIC_CHECK);


?>