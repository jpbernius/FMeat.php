<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 22.11.17
 * Time: 19:13
 */

namespace JPBernius\FMeat\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;
use JPBernius\FMeat\Entities\{
    CalendarWeek,
    Week
};
use JPBernius\FMeat\Exeptions\NetworkingException;
use JPBernius\FMeat\Utilities\UrlBuilder;

/**
 * Class NetworkService
 * @package JPBernius\FMeat\Services
 */
class NetworkService
{

    /** @var HttpClient */
    private $httpClient;

    /** @var UrlBuilder */
    private $urlBuilder;

    /**
     * NetworkService constructor.
     * @param HttpClient $httpClient
     * @param UrlBuilder $urlBuilder
     */
    public function __construct(HttpClient $httpClient, UrlBuilder $urlBuilder)
    {
        $this->httpClient = $httpClient;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param CalendarWeek $calendarWeek
     * @param string $location
     * @return Week
     * @throws NetworkingException
     */
    public function getWeekWithLocation(CalendarWeek $calendarWeek, string $location): Week
    {
        $url = $this->urlBuilder->getUrlForLocationYearWeek($location, $calendarWeek);
        try {
            $response = $this->httpClient->get($url);
            $jsonResponse = (string)$response->getBody();
            $jsonObject = json_decode($jsonResponse);

            return Week::fromJson($jsonObject);
        } catch (RequestException $requestException) {
            throw new NetworkingException();
        }
    }

}