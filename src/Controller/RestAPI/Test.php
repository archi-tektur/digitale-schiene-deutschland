<?php declare(strict_types=1);

namespace App\Controller\RestAPI;


use App\DTO\Stop;
use App\Entity\Explicit\Distance;
use App\Entity\Explicit\TrackObjectType;
use App\Entity\Infrastructure\Route;
use App\Entity\Infrastructure\Station;
use App\Entity\Infrastructure\TrackObject;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test
 *
 * @package App\Controller\RestAPI
 */
class Test extends AbstractController
{

    /**
     * @param DateTime $startTime
     * @return Response
     */
    public function index(DateTime $startTime): Response
    {

        $route = new Route();
        $route->setName('Test route')
              ->setKbs(9999)
              ->setStationsName('Station A - Station C')
              ->setLength(50000)
              ->setMaxPermittedSpeed(280);

        $type = new TrackObjectType();
        $type->setName('Abstract Station')
             ->setStyleClass('css');

        $trackObjectA = new TrackObject();
        $trackObjectB = new TrackObject();
        $trackObjectC = new TrackObject();
        $stationA = new Station();
        $stationB = new Station();
        $stationC = new Station();

        $distanceAB = new Distance();
        $distanceBC = new Distance();

        $trackObjectA->setType($type)
                     ->setRoute($route)
                     ->setKilometer(0.0)
                     ->setName('Station A')
                     ->setStation($stationA);
        $stationA->setShortName('Station A')
                 ->setTrackObject($trackObjectA);

        $trackObjectB->setType($type)
                     ->setRoute($route)
                     ->setKilometer(20.0)
                     ->setName('Station B')
                     ->setStation($stationB);
        $stationB->setShortName('Station B')
                 ->setTrackObject($trackObjectB);

        $trackObjectC->setType($type)
                     ->setRoute($route)
                     ->setKilometer(50.0)
                     ->setName('Station C')
                     ->setStation($stationC);
        $stationC->setShortName('Station C')
                 ->setTrackObject($trackObjectC);

        $distanceAB->setStationA($stationA)
                   ->setStationB($stationB)
                   ->setMeters(20000)
                   ->setMinutes(10);

        $distanceBC->setStationA($stationB)
                   ->setStationB($stationC)
                   ->setMeters(30000)
                   ->setMinutes(15);

        $stop1 = new Stop();
        $stop2 = new Stop();
        $stop3 = new Stop();

        $stop1->setStation($stationA)
              ->setArrivalTime($startTime)
              ->setDepartureTime($startTime->add('10 min'));

        $stop2->setStation($stationB)
              ->setArrivalTime($arrivalTime)
              ->setDepartureTime($departureTime);

        $stop3->setStation($stationB)
              ->setArrivalTime($arrivalTime)
              ->setDepartureTime($departureTime);


    }
}
