<?php


$pass1 = password_hash('abc123', PASSWORD_DEFAULT);

$pass2 = password_hash('abc123', PASSWORD_DEFAULT);

echo "<pre>";

echo $pass1;
echo "<pre>";

echo $pass2;
echo "<pre>";


$res = password_verify('abc123', $pass2);

echo $res;
