<?php

namespace JPBernius\FMeat;

use JPBernius\FMeat\Configurations\Locations;
use JPBernius\FMeat\Entities\Week;
use JPBernius\FMeat\Services\CachedNetworkService;
use JPBernius\FMeat\Services\NetworkService;
use DI\ContainerBuilder;

/**
 * Class FMeatClient
 * @package JPBernius\FMeat
 */
class FMeatClient
{
    /** @var NetworkService */
    private $networkService;

    /**
     * FMeatClient constructor.
     * @param bool $useCaching
     */
    public function __construct(bool $useCaching = false)
    {
        $container = ContainerBuilder::buildDevContainer();

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
        return $this->networkService->getCurrentWeekWithLocation($location);
    }
}