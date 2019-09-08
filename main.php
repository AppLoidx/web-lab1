<?php

$start = microtime(true);
$ajaxRequest = $_GET;
$x = $ajaxRequest["x"];
$y = $ajaxRequest["y"];
$z = $ajaxRequest["z"];

if (
  ( $x <= 0 && $y<= 0 && $x >= -$z && $y >= -$z) || // нижний квадрат
  ( $x >= 0 && $y<= 0 && $y >= $x - $z) || // нижний треугольник
  ( $x <= 0 && $y>=0 && ($x**2 + $y**2 <= $z ** 2) ) //верхний полукруг
){
  $res = "yes";
} else {
  $res = "no";
}
$output = array(
  "x" => $x,
  "y" => $y,
  "R" => $z,
  "res" => $res,
  "time" => date("d.m.Y H:i"),
  "bancmark" => round(microtime(true) - $start, 5),
);
//echo json_encode($output);

$time = date("d.m.Y H:i");
$bancmark = round(microtime(true) - $start, 5);

echo "{";
echo "'x':$x,";
echo "'y':$y,";
echo "'R':$z,";
echo "'time': '"$time"',";
echo "'bancmark':$bancmark";
echo "}";

?>
