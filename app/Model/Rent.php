<?php


namespace App\Model;


class Rent extends AModel
{
    protected static $table = 'rental';

    protected static function createObject($data): AModel
    {
        if ($carId = $data['car_id'] ?? null) {
            $car = Car::getOne('id', $carId );
            $brand = Brand::getOne('id',$carId);
            $user = User::getOne('id', $carId);
            $data['car_name'] = " {$brand->getBrand()} {$car->getCarName()}";
            $data['car_color'] = "{$car->getColor()}";
            $data['car_km'] = "{$car->getCarKm()}";
            $data['car_year'] = "{$car->getCarYear()}";
            $data['username'] = "{$user->getUserType()}";
        }
        return parent::createObject($data);
    }
}