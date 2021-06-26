<?php

declare(strict_types=1);

namespace App\Task;

use App\Collection\LogCollection;
use App\Validators\LogValidator;
use App\ValueObject\LogResponse;

class LogParseTask
{
    private array $logs;
    private LogCollection $logCollection;
    private LogValidator $validator;
    private LogResponse $response;

    /**
     * LogParseTask constructor.
     * @param array $logs Полученные из файла логи
     * @param LogCollection $collection Коллекция объектов Log
     * @param LogValidator $validator обработчик логов
     */
    public function __construct(array $logs, LogCollection $collection, LogValidator $validator)
    {
        $this->logs = $logs;
        $this->logCollection = $collection;
        $this->validator = $validator;
    }

    /**
     * @return array
     */
    public function getLogs(): array
    {
        return $this->logs;
    }

    /**
     * @return LogValidator
     */
    public function getValidator(): LogValidator
    {
        return $this->validator;
    }

    /**
     * @return LogCollection
     */
    public function getLogCollection(): LogCollection
    {
        return $this->logCollection;
    }

    public function setSuccess(LogResponse $response)
    {
        $this->response = $response;
    }

    /**
     * @return LogResponse
     */
    public function getResponse(): LogResponse
    {
        return $this->response;
    }



}