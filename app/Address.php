<?php

namespace App;

class Address
{
    /** @var street */
    public string $street;

    /** @var city */
    public string $city;

    /** @var state */
    public string $state;

    /** @var zip */
    public string $zip;

    /**
     * Create a new value object instance.
     *
     * @param string $street
     * @param string $city
     * @param string $state
     * @param string $zip
     */
    public function __construct(string $street, string $city, string $state, string $zip)
    {
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }
}
