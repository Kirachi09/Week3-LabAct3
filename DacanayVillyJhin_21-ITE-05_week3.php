<?php
    //Base class: Vehicle
class Vehicle {
    protected $make;
    protected $model;
    protected $year;

    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    // Final method to prevent overriding
    final public function getDetails() {
        return "Make: $this->make, Model: $this->model, Year: $this->year <br>";
    }

    // This method will be overridden by child classes
    public function describe() {
        return "This is a vehicle.";
    }
}

// Derived class: Car
class Car extends Vehicle {
    protected $doors;

    public function __construct($make, $model, $year, $doors) {
        parent::__construct($make, $model, $year);
        $this->doors = $doors;
    }

    public function describe() {
        return "This is a car with $this->doors doors. <br><br>";
    }
}

// Interface for electric vehicles
interface ElectricVehicle {
    public function chargeBattery();
}

// Derived class: ElectricCar extends Car and implements ElectricVehicle
class ElectricCar extends Car implements ElectricVehicle {
    private $batteryLevel;
    private $isCharged;

    public function __construct($make, $model, $year, $doors, $batteryLevel = 100) {
        parent::__construct($make, $model, $year, $doors);
        $this->batteryLevel = $batteryLevel;
        $this->isCharged = false; // Initial state, battery not charged
    }

    public function chargeBattery() {
        $this->batteryLevel = 100;
        $this->isCharged = true; // Battery is now charged
        echo "Battery has been fully charged.\n <br>";
    }

    public function describe() {
        if ($this->isCharged) {
            // After charging, only display the battery status
            return "Battery is at $this->batteryLevel%.<br>";
        } else {
            // Before charging, display the full description
            return "This is an electric car with $this->doors doors.<br>Battery is at $this->batteryLevel%.<br>";
        }
    }
}

// Final class: Motorcycle
final class Motorcycle extends Vehicle {
    private $uniqueCharacteristic;

    public function __construct($make, $model, $year) {
        parent::__construct($make, $model, $year);
        // Define the unique characteristic for the motorcycle
        $this->uniqueCharacteristic = "90° V-twin engine in a trellis frame";
    }

    public function describe() {
        return "This is a motorcycle. <br>Its unique characteristic is its {$this->uniqueCharacteristic}.<br><br>";
    }
}

// Test the classes

// Create a Car object
$car = new Car("Chevrolet", "Camaro", 1977, 2);
echo $car->getDetails() . "\n";
echo $car->describe() . "\n\n";

// Create a Motorcycle object
$motorcycle = new Motorcycle("Ducati", "916", 1998);
echo $motorcycle->getDetails() . "\n";
echo $motorcycle->describe() . "\n\n";

// Create an ElectricCar object
$electricCar = new ElectricCar("Tesla", "Cybertruck", 2022, 4, 20);
echo $electricCar->getDetails() . "\n";
echo $electricCar->describe() . "\n";
$electricCar->chargeBattery();
echo $electricCar->describe() . "\n";
?>