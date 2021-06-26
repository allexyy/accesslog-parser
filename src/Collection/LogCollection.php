<?php

declare(strict_types=1);

namespace App\Collection;

use App\ValueObject\Log;

class LogCollection extends AbstractCollection
{
    public const ITEM_CLASS = Log::class;

}