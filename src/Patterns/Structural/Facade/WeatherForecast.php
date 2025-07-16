<?php

namespace App\Patterns\Structural\Facade;

final class WeatherForecast
{
    public function __construct(
        private readonly WeatherApi $weatherApi
    )
    {
    }

    public function getCurrentTemperature(string $city, string $lang = 'fr'): float
    {
        $temperature = $this->weatherApi->getCurrentTemperature($city, $lang);

        if (null === $temperature) {
            throw new \RuntimeException(sprintf('Could not retrieve temperature for city "%s".', $city));
        }

        return $temperature;
    }

    public function getForecast(string $city, string $lang = 'fr'): array
    {
        $forecast = $this->weatherApi->getForecast($city, $lang);

        if (empty($forecast)) {
            throw new \RuntimeException(sprintf('Could not retrieve forecast for city "%s".', $city));
        }

        return $forecast;
    }
}
