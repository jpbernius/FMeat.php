<?php
/**
 * Created by IntelliJ IDEA.
 * User: uni
 * Date: 22.11.17
 * Time: 20:14
 */

namespace JPBernius\FMeat\Services;

use DI\ContainerBuilder;
use JPBernius\FMeat\Configurations\LocationsConfiguration;
use PHPUnit\Framework\TestCase;

class NetworkServiceTest extends TestCase
{
    /** @var NetworkService */
    private $networkService;

    /**
     * @before
     */
    public function setupNetworkService()
    {
        $container = ContainerBuilder::buildDevContainer();
        $this->networkService = $container->get(NetworkService::class);
    }

    /**
     * @after
     */
    public function tearDownNetworkService()
    {
        $this->networkService = null;
    }

    public function testGetWeek47WithYear2017AndLocationFmiBistro()
    {
        $week = $this->networkService->getWeekWithYearAndLocation(47, 2017, LocationsConfiguration::FMI_BISTRO);
        $monday = $week->getDay(1);
        $dish1 = $monday->current();
        $monday->next();
        $dish2 = $monday->current();

        assertThat($week->getWeekNumber(), is(equalTo(47)));
        assertThat($monday->getDayOfWeek(), is(equalTo(1)));
        assertThat($dish1->getName(), is(equalTo("Karotten Erbsen Ingwergemüse mit Schupfnudeln")));
        assertThat($dish2->getName(), is(equalTo("Krautwickerl mit Specksoße und Kartoffelpürree")));
    }
}