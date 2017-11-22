<?php

namespace JPBernius\FMeat;

use JPBernius\FMeat\Configurations\LocationsConfiguration;
use JPBernius\FMeat\Entities\Week;
use JPBernius\FMeat\Services\NetworkService;
use DI\ContainerBuilder;

class FMeatClient
{
    /** @var NetworkService */
    private $networkService;

	public function __construct()
    {
        $container = ContainerBuilder::buildDevContainer();

        $this->networkService = $container->get(NetworkService::class);
    }

    public function getCurrentWeek(): Week
    {
        return $this->networkService->getCurrentWeekWithLocation(LocationsConfiguration::FMI_BISTRO);
    }
}