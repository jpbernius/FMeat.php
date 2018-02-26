<?php

namespace JPBernius\FMeat\Services;

use GuzzleHttp\Client as HttpClient;
use JPBernius\FMeat\Utilities\UrlBuilder;
use JPBernius\FMeat\Entities\{
    CalendarWeek,
    Week
};
use Stash\Driver\FileSystem as FileSystemDriver;
use Stash\Pool as CachePool;

/**
 * Class CachedNetworkService
 * @package JPBernius\FMeat\Services
 */
class CachedNetworkService extends NetworkService
{
    /** @var CachePool */
    private $pool;

    /**
     * CachedNetworkService constructor.
     * @param HttpClient $httpClient
     * @param UrlBuilder $urlBuilder
     * @param FileSystemDriver $fileSystemDriver
     * @param CachePool $pool
     */
    public function __construct(HttpClient $httpClient, UrlBuilder $urlBuilder,
                                FileSystemDriver $fileSystemDriver, CachePool $pool)
    {
        parent::__construct($httpClient, $urlBuilder);

        $pool->setDriver($fileSystemDriver);
        $this->pool = $pool;
    }

    /**
     * @param int $week
     * @param int $year
     * @param string $location
     * @return Week
     */
    public function getWeekWithLocation(CalendarWeek $calendarWeek, string $location): Week
    {
        $cacheKey = $this->buildCacheKey($location, $calendarWeek);
        $cacheItem = $this->pool->getItem($cacheKey);

        if($cacheItem->isHit()) {
            $jsonString = $cacheItem->get();
            $jsonObject = json_decode($jsonString);

            return Week::fromJson($jsonObject);
        }

        $retrievedWeek = parent::getWeekWithLocation($calendarWeek, $location);

        $retrievedWeekJson = json_encode($retrievedWeek);
        $this->pool->save($cacheItem->set($retrievedWeekJson));

        return $retrievedWeek;
    }

    /**
     * @param string $location
     * @param int $year
     * @param int $week
     * @return string
     */
    private function buildCacheKey(string $location, CalendarWeek $calendarWeek): string
    {
        return sprintf('%s/%s/%s', $location, $calendarWeek->getYear(), $calendarWeek->getWeek());
    }
}