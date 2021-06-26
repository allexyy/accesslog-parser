<?php

declare(strict_types=1);

namespace App\Validators;

use App\Exceptions\ValidatorException;
use App\ValueObject\Log;

class LogValidator
{

    private const PATTERN = "/(\S+) (\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) (\".*?\") (\".*?\")/";


    /**
     * @param string $log Строка с логом из списка логов
     * @return Log Модель проаудированного лога
     * @throws ValidatorException
     */
    public function validate(string $log): Log
    {
        preg_match(self::PATTERN,$log,$matches);
        if (!$matches){
            throw new ValidatorException('Can`t parse this log');
        }
        return new Log($matches);
    }

}