<?php

declare(strict_types=1);

namespace App\Collection;

use Exception;
use function is_object;

abstract class AbstractCollection
{
    /**
     * Класс модели
     *
     * @var string
     */
    public const ITEM_CLASS = '';

    /**
     * Хранилище элементов коллекции
     *
     * @var array
     */
    protected array $data = [];

    /**
     * @param object $item передаваемый в коллекцию объект
     * @return object Объект который будет передан в коллекцию
     * @throws Exception
     */
    protected function checkItem(object $item): object
    {
        $class = static::ITEM_CLASS;
        if (! is_object($item) || ! $item instanceof $class) {
            throw new Exception('Item must be an instance of ' . $class);
        }
        return $item;
    }

    /**
     * @return array Массив объектов в коллекции
     */
    public function toArray(): array
    {
        $result = [];
        /** @var object $item */
        foreach ($this->data as $key => $item) {
            $result[$key] = $item;
        }

        return $result;
    }

    /**
     * @param object $value Объект для добавления в коллекцию
     * @throws Exception
     */
    public function add(object $value): void
    {
        $this->data[] = $this->checkItem($value);
    }
}
