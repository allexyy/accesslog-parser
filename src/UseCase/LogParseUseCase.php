<?php

declare(strict_types=1);

namespace App\UseCase;

use App\Exceptions\ValidatorException;
use App\Task\LogParseTask;
use App\ValueObject\LogResponse;
use JsonException;

class LogParseUseCase
{

    /**
     * @throws ValidatorException
     * @throws JsonException
     */
    public function handle(LogParseTask $task): string
    {
        $logs = $task->getLogs();
        $collection = $task->getLogCollection();


        foreach ($logs as $log){
            $logModel = $task->getValidator()->validate($log);
            $collection->add($logModel);
        }

        $reponse = new LogResponse($collection);

        $task->setSuccess($reponse);

        return json_encode($reponse->toArray(), JSON_THROW_ON_ERROR);

    }

}