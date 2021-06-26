<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Collection\LogCollection;

class LogResponse
{
    private int $views = 0;
    private array $urls = [];
    private int $traffic = 0;
    private array $crawlers = [
        'Google'=> 0,
        'Bing'=> 0,
        'Baidu'=> 0,
        'Yandex'=> 0
    ];
    private array $statusCodes = [];


    /**
     * LogResponse constructor.
     * @param LogCollection $collection Коллекция Log
     */
    public function __construct (LogCollection $collection)
    {
        foreach ($collection->toArray() as $data) {
            $info = $data->getResponseData();
            $this->views++;
            $this->urls [] = $info['url'];
            $this->traffic += (int)$info['traffic'];
            $this->addCrawler($info['crawler']);
            $this->addCode($info['code']);
        }

    }

    /**
     * @param string|null $crawler Поисковик из которого пришёл запрос
     */
    private function addCrawler(?string $crawler): void
    {
        if (array_key_exists($crawler,$this->crawlers) && $crawler !== null){
            $this->crawlers[$crawler]++;
        }
    }

    /**
     * @param string $code код ответа сервиса
     */
    private function addCode(string $code): void
    {
        if (array_key_exists($code,$this->statusCodes)){
            $this->statusCodes[$code]++;
        }else{
            $this->statusCodes[$code] = 1;
        }
    }

    /**
     * @return int кол-во уникальных URL
     */
    private function getUrlCount(): int
    {
       $uniqUrls = array_unique($this->urls);
       return count($uniqUrls);
    }

    /**
     * @return array Готовый к передаче массив данных
     */
    public function toArray(): array
    {
        return [
            'views'=> $this->views,
            'urls' => $this->getUrlCount(),
            'traffic' => $this->traffic,
            'crawlers' => $this->crawlers,
            'statusCodes'=> $this->statusCodes
        ];
    }

}