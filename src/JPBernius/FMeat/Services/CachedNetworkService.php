<?php

namespace JPBernius\FMeat\Services;

use GuzzleHttp\Client as HttpClient;
use JPBernius\FMeat\Utilities\UrlBuilder;
use JPBernius\FMeat\Utilities\YearWeekUtil;
use JPBernius\FMeat\Entities\Week;
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
     * @param YearWeekUtil $yearWeekUtil
     * @param FileSystemDriver $fileSystemDriver
     * @param CachePool $pool
     */
    public function __construct(HttpClient $httpClient, UrlBuilder $urlBuilder, YearWeekUtil $yearWeekUtil,
                                FileSystemDriver $fileSystemDriver, CachePool $pool)
    {
        parent::__construct($httpClient, $urlBuilder, $yearWeekUtil);

        $pool->setDriver($fileSystemDriver);
        $this->pool = $pool;
    }

    /**
     * @param int $week
     * @param int $year
     * @param string $location
     * @return Week
     */
    public function getWeekWithYearAndLocation(int $week, int $year, string $location): Week
    {
        $cacheKey = $this->buildCacheKey($location, $year, $week);
        $cacheItem = $this->pool->getItem($cacheKey);

        if($cacheItem->isHit()) {
            $jsonString = $cacheItem->get();
            $jsonObject = json_decode($jsonString);

            return Week::fromJson($jsonObject);
        }

        $retrievedWeek = parent::getWeekWithYearAndLocation($week, $year, $location);

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
    private function buildCacheKey(string $location, int $year, int $week): string
    {
        return sprintf("%s/%s/%s", $location, $year, $week);
    }
}