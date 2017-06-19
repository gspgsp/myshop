<?php
require_once('./Archive/class/sphinxapi.php');

$sc = new SphinxClient();
$sc->setServer('localhost',9312);
// $sc->SetMatchMode(SPH_MATCH_PHRASE);
$res = $sc->Query('青岛');
var_dump($res);
// $ids = array_keys($res['words']);
// var_dump($ids);