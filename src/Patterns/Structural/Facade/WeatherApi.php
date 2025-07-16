<?php

namespace App\Patterns\Structural\Facade;

use DateTimeImmutable;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\JsonPath\JsonCrawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherApi
{
    public function __construct(
        #[Autowire(env: 'WEATHER_API_KEY')]
        private string              $apiKey,
        #[Autowire(env: 'WEATHER_API_URL')]
        private string              $apiUrl,
        private HttpClientInterface $httpClient
    )
    {
    }

    public function getCurrentTemperature(string $city, string $lang): ?float
    {
        $response = $this->httpClient->request(
            'GET',
            $this->apiUrl . '/weather',
            [
                'query' => [
                    'q' => $city,
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                    'lang' => $lang,
                ],
            ]
        );

        $jsonPath = new JsonCrawler($response->getContent());
        $temp = $jsonPath->find('$.main.temp');

        return $temp[0] ?? null;
    }

    public function getForecast(string $city, string $lang): array
    {
        $response = $this->httpClient->request(
            'GET',
            $this->apiUrl . '/forecast',
            [
                'query' => [
                    'q' => $city,
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                    'lang' => $lang,
                ],
            ]
        );

        $jsonPath = new JsonCrawler($response->getContent());
        $forecast = [];
        foreach ($jsonPath->find('$.list')[0] as $item) {
            $forecast[] = [
                'date' => new DateTimeImmutable($item['dt_txt'])->format('d/m/Y H:i'),
                'temperature' => $item['main']['temp'],
                'weather' => $item['weather'][0]['description'],
            ];
        }
        
        return $forecast;
    }
}
