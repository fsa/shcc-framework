<?php

namespace FSA\SmartHome\Capability;

interface PowerInterface
{
    function setPowerOn(int $line = 0);
    function setPowerOff(int $line = 0);
    function setPower(bool $value, int $line = 0);
    function getPower(int $line = 0): bool;
}
