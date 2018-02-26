<?php

namespace JPBernius\FMeat;

use JPBernius\FMeat\Configurations\Locations;
use JPBernius\FMeat\Entities\Week;
use JPBernius\FMeat\Services\CachedNetworkService;
use JPBernius\FMeat\Services\NetworkService;
use JPBernius\FMeat\Utilities\YearWeekUtil;
use DI\ContainerBuilder;

/**
 * Class FMeatClient
 * @package JPBernius\FMeat
 */
class FMeatClient
{
    /** @var NetworkService */
    private $networkService;

    /** @var YearWeekUtil */
    private $yearkWeekUtil;

    /**
     * FMeatClient constructor.
     * @param bool $useCaching
     */
    public function __construct(bool $useCaching = false)
    {
        $container = ContainerBuilder::buildDevContainer();
        $this->yearWeekUtil = $container->get(YearWeekUtil::class);

        if ($useCaching) {
            $this->networkService = $container->get(CachedNetworkService::class);
        } else {
            $this->networkService = $container->get(NetworkService::class);
        }
    }

    /**
     * @param string $location
     * @return Week
     */
    public function getCurrentWeekForLocation(string $location = Locations::FMI_BISTRO): Week
    {
        $currentWeek = $this->yearWeekUtil->getCurrentCalendarWeek();
        return $this->networkService->getWeekWithLocation($currentWeek, $location);
    }

    /**
     * @param string $location
     * @return Week
     */
    public function getNextWeekForLocation(string $location = Locations::FMI_BISTRO): Week
    {
        $nextWeek = $this->yearWeekUtil->getNextCalendarWeek();
        return $this->networkService->getWeekWithLocation($nextWeek, $location);
    }
}