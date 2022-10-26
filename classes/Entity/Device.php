<?php

namespace FSA\SmartHome\Entity;

use FSA\Neuron\SQL\EntityInterface;

class Device implements EntityInterface
{
    public $uid;
    public $description;
    public $plugin;
    public $hwid;
    public $class;
    public $properties;

    public static function getTableName(): string {
        return 'devices';
    }
    
    public static function getIndexRow(): string {
        return 'uid';
    }

    public function __construct()
    {
        if(!is_null($this->properties)) {
            $this->properties = json_decode($this->properties, true);
        }
    }

    public function getProperties(): array
    {
        $properties = get_object_vars($this);
        $properties['properties'] = json_encode($this->properties, JSON_UNESCAPED_UNICODE);
        return $properties;
    }
}
