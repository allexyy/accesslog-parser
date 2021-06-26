<?php

declare(strict_types=1);

namespace App\ValueObject;

class Log
{
    /**
     * @var string|mixed Url на который обращаются к нам в сервис
     */
    private string $requestUrl;
    /**
     * @var string|mixed Код ответа сервиса
     */
    private string $responseCode;
    /**
     * @var string|mixed кол-во отданных сервером байт
     */
    private string $responseTraffic;
    /**
     * @var string|mixed HTTP заголовки
     */
    private string $userAgent;

    /**
     * Log constructor.
     * @param array $log Полученный лог из списка логов
     */
    public function __construct(array $log)
    {
        $this->requestUrl      = $log[8];
        $this->responseCode    = $log[10];
        $this->responseTraffic = $log[11];
        $this->userAgent       = $log[13];

    }


    /**
     * @return string|null Поисковик если входит в список используемых нами
     */
    private function getCrawler(): ?string
    {
        $matches = preg_grep('/(bot|spider|Bot)/', explode(' ', $this->userAgent));
        if(count($matches) > 0){
            foreach ($matches as $crawlerName){
                if (preg_match('/(google)/i', $crawlerName)) {
                   return 'Google';
                }

                if (preg_match('/(bing)/i', $crawlerName)) {
                    return 'Bing';
                }

                if (preg_match('/(baidu)/i', $crawlerName)) {
                    return 'Baidu';
                }

                if(preg_match('/(yandex)/i', $crawlerName)) {
                    return 'Yandex';
                }
            }
        }
        return null;
    }



    /**
     * @return mixed|string Выбранная из лога информация
     */
    public function getResponseData(): array
    {
        return [
            'url' => $this->requestUrl,
            'code' => $this->responseCode,
            'traffic' => $this->responseTraffic,
            'crawler' => $this->getCrawler()
        ];
    }



}