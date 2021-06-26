<?php

use App\Collection\LogCollection;
use App\UseCase\LogParseUseCase;
use App\Task\LogParseTask;
use App\Validators\LogValidator;

require_once 'vendor/autoload.php';


$file = file('log.log');
$validator = new LogValidator();
$collection = new LogCollection();
$useCase = new LogParseUseCase();

$respone = $useCase->handle(
    new LogParseTask(
        $file,
        $collection,
        $validator
    )
);
echo $respone;