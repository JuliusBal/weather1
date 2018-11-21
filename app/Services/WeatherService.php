<?php

namespace App\Services;

use App\Events\WindChanged;
use App\Parameter;
use GuzzleHttp\Client;

/**
 * Class WeatherService
 * @package App\Services
 */
class WeatherService
{
    /**
     *
     */
    const WIND_CHANGE_POINT = 10;
    /**
     * @var mixed
     */
    private $apiUrl;
    /**
     * @var mixed
     */
    private $apiAppId;
    /**
     * @var mixed
     */
    private $Town;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var ParameterService
     */
    private $parameterService;

    /**
     * @var array
     */
    private $directions = [
        [
            'from' => 0,
            'to' => 22,
            'value' => 'Siaures',
        ],
        [
            'from' => 23,
            'to' => 67,
            'value' => 'SR',
        ],
        [
            'from' => 68,
            'to' => 112,
            'value' => 'R',
        ],
        [
            'from' => 113,
            'to' => 157,
            'value' => 'PR',
        ],
        [
            'from' => 158,
            'to' => 202,
            'value' => 'P',
        ],
        [
            'from' => 203,
            'to' => 247,
            'value' => 'Siaures',
        ],
        [
            'from' => 248,
            'to' => 292,
            'value' => 'V',
        ],
        [
            'from' => 293,
            'to' => 337,
            'value' => 'SV',
        ],
        [
            'from' => 338,
            'to' => 360,
            'value' => 'Siaures',
        ],

    ];

    /**
     * WeatherService constructor.
     * @param Client $client
     */
    public function __construct(Client $client, ParameterService $parameterService)
    {
        $this->apiUrl = env('W_URL');
        $this->apiAppId = env('W_APPID');
        $this->Town = env('W_TOWN');

        $this->client = $client;

        $this->parameterService = $parameterService;
    }

    /**
     * @return \stdClass
     */
    public function getCurrent(): \stdClass
    {
        $result = $this->client->get($this->apiUrl . '/weather', [
            'query' => [
                'q' => $this->Town,
                'appid' => $this->apiAppId,
                'lang' => 'lt',
                'units' => 'metric',
            ],

        ]);

        return json_decode($result->getBody()->getContents());

    }

    /**
     * @param int|null $deg
     * @return string
     */
    public function getDirectionByDeg(int $deg = null): string
    {

        foreach ($this->directions as $direction) {
            if ($deg >= $direction['from'] && $deg <= $direction['to']) {
                return $direction['value'];
            }
        }
        return '-';
    }

    /**
     * @param int $speed
     */
    public function checkWindForEmail(float $speed): void
    {
        $oldSpeed = $this->parameterService->getValue(Parameter::PARAMETER_WIND_SPEED);
        //if($oldspeed !== null) tas pats
        if (!$oldSpeed) {
            if ($oldSpeed > self::WIND_CHANGE_POINT && $speed < self::WIND_CHANGE_POINT) {
                event(new WindChanged());
            }
            if ($oldSpeed < self::WIND_CHANGE_POINT && $speed > self::WIND_CHANGE_POINT) {
                event(new WindChanged('up'));
            }
        }

        $this->parameterService->setValue(Parameter::PARAMETER_WIND_SPEED, $speed);

    }
}