<?php

namespace App\Controller;

interface MapAddressInterface
{
    public function fetchCoords(string $address): array;
}