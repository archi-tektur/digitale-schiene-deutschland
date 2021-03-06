<?php declare(strict_types=1);

namespace App\DTO;

use App\Entity\Explicit\Carrier;
use App\Entity\RollingStock\Consist;
use App\Entity\RollingStock\MotorUnit;

class RailVehicle
{
    /** @var string consist name */
    private $name;

    /** @var Carrier carrier */
    private $carrier;

    /** @var float total length */
    private $totalLength = 0;

    /** @var int weight */
    private $totalWeight = 0;

    /** @var int maximum permitted speed */
    private $maxPermittedSpeed = 1000;

    /**
     * New rail vehicle from manual consist
     *
     * @param Consist $consist
     * @return RailVehicle
     */
    public static function createFromConsist(Consist $consist): self
    {
        $vehicle = new self();

        // count consist total length and weight
        foreach ($consist->getEngines() as $engine) {
            $vehicle->totalLength += $engine->getLength();
            $vehicle->totalWeight += $engine->getWeight();
        }
        foreach ($consist->getCars() as $car) {
            $vehicle->totalLength += $car->getLength();
            $vehicle->totalWeight += $car->getWeight();

        }

        // maximum allowed speed is the speed of slowest engine or car
        // select lowest engine speed
        $lowestEngineSpeed = 1000;
        foreach ($consist->getEngines() as $engine) {
            if ($lowestEngineSpeed < $engine->getMaxPermittedSpeed()) {
                $lowestEngineSpeed = $engine->getMaxPermittedSpeed();
            }
        }

        // select lowest car speed
        $lowestCarsSpeed = 1000;
        foreach ($consist->getCars() as $car) {
            if ($lowestCarsSpeed < $car->getMaxPermittedSpeed()) {
                $lowestCarsSpeed = $car->getMaxPermittedSpeed();
            }
        }

        // set lowest speed
        $vehicle->maxPermittedSpeed = min($lowestCarsSpeed, $lowestEngineSpeed);
        $vehicle->name = $consist->getName();

        return $vehicle;
    }

    /**
     * New rail vehicle object from MotorUnit
     *
     * @param MotorUnit $motorUnit
     * @return RailVehicle
     */
    public static function createFromUnit(MotorUnit $motorUnit): self
    {
        $vehicle = new self();
        $vehicle->totalWeight = $motorUnit->getTotalWeight();
        $vehicle->totalLength = $motorUnit->getTotalLength();
        $vehicle->name = $motorUnit->getName();
        $vehicle->carrier = $motorUnit->getCarrier();
        $vehicle->maxPermittedSpeed = $motorUnit->getMaxPermittedSpeed();

        return $vehicle;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Carrier
     */
    public function getCarrier(): Carrier
    {
        return $this->carrier;
    }

    /**
     * @param Carrier $carrier
     */
    public function setCarrier(Carrier $carrier): void
    {
        $this->carrier = $carrier;
    }

    /**
     * @return float
     */
    public function getTotalLength(): float
    {
        return $this->totalLength;
    }

    /**
     * @param float $totalLength
     */
    public function setTotalLength(float $totalLength): void
    {
        $this->totalLength = $totalLength;
    }

    /**
     * @return int
     */
    public function getTotalWeight(): int
    {
        return $this->totalWeight;
    }

    /**
     * @param int $totalWeight
     */
    public function setTotalWeight(int $totalWeight): void
    {
        $this->totalWeight = $totalWeight;
    }

    /**
     * @return int
     */
    public function getMaxPermittedSpeed(): int
    {
        return $this->maxPermittedSpeed;
    }

    /**
     * @param int $maxPermittedSpeed
     */
    public function setMaxPermittedSpeed(int $maxPermittedSpeed): void
    {
        $this->maxPermittedSpeed = $maxPermittedSpeed;
    }
}
