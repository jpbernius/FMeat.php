<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 22.11.17
 * Time: 19:13
 */

namespace JPBernius\FMeat\Services;


use GuzzleHttp\Client as HttpClient;
use JPBernius\FMeat\Entities\Week;
use JPBernius\FMeat\Utilities\UrlBuilder;
use JPBernius\FMeat\Utilities\YearWeekUtil;

class NetworkService
{

    /** @var HttpClient */
    private $httpClient;

    /** @var UrlBuilder */
    private $urlBuilder;

    /** @var YearWeekUtil */
    private $yearWeekUtil;

    public function __construct(HttpClient $httpClient, UrlBuilder $urlBuilder, YearWeekUtil $yearWeekUtil)
    {
        $this->httpClient = $httpClient;
        $this->urlBuilder = $urlBuilder;
        $this->yearWeekUtil = $yearWeekUtil;
    }

    public function getWeekWithYearAndLocation(int $week, int $year, string $location): Week
    {
        $url = $this->urlBuilder->getUrlForLocationYearWeek($location, $year, $week);
        $response = $this->httpClient->get($url);
        $jsonResponse = (string) $response->getBody();
        $jsonObject = json_decode($jsonResponse);

        return Week::fromJson($jsonObject);
    }

    public function getCurrentWeekWithLocation(string $location): Week
    {
        $currentYear = $this->yearWeekUtil->getCurrentYear();
        $currentWeek = $this->yearWeekUtil->getCurrentCalendarWeek();

        return $this->getWeekWithYearAndLocation($currentWeek, $currentYear, $location);
    }

}