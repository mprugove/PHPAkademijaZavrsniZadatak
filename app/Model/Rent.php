<?php

namespace App\Model;

class Rent extends Amodel
{
    protected static $table = 'rental';


    protected static function createObject($data): AModel
    {

        if ($carId = $data['car_id'] ?? null) {
            $car = Car::getOne('id', $carId);
            $user = User::getOne('id', $carId);
            $data['car_manufacturer'] = "{$car->getManufacturer()}";
            $data['car_name'] = "{$car->getCarName()}";
            $data['car_color'] = "{$car->getColor()}";
            $data['car_km'] = "{$car->getCarKm()}";
            $data['car_year'] = "{$car->getCarYear()}";
            $data['car_id'] = "{$car->getCarId()}";
            $data['user'] = "{$user->getFirstName()} {$user->getLastName()}";

        }
        return parent::createObject($data);
    }
}
