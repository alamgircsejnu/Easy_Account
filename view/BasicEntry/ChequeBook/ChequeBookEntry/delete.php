<?php

include_once '../../../../vendor/autoload.php';
use App\ChequeBook\ChequeBookEntry\ChequeBookEntry;

$cheque = new ChequeBookEntry();
$delete = $cheque->prepare($_GET);
$deleted = $cheque->delete();