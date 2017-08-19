<?php


require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

use SimpleSession\Session;

$data = array('adi'    => 'Ümit',
              'soyadi' => 'Arpat',
              'deneyim' => '3 yıl +');

Session::createSession($data);
echo Session::getSession('adi')."<br>";
echo Session::getSession('soyadi')."<br>";
echo Session::getSession('deneyim')."<br>";

//Session::deleteSession('',true);