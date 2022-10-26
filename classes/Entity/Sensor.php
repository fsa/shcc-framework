<?php

namespace FSA\SmartHome\Entity;

use FSA\Neuron\SQL\EntityInterface;

class Sensor implements EntityInterface
{
    public $id;
    public $uid;
    public $description;
    public $property;
    public $device_property;
    public $history;

    public static function getTableName(): string
    {
        return 'sensors';
    }

    public static function getIndexRow(): string
    {
        return 'id';
    }

    public function getProperties(): array
    {
        return get_object_vars($this);
    }
}
