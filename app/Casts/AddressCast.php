<?php

namespace App\Casts;

use App\Address;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class AddressCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return App\Models\Address
     */
    public function get($model, $key, $value, $attributes)
    {
        return new Address(
            $attributes['street'],
            $attributes['city'],
            $attributes['state'],
            $attributes['zip'],
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  App\Models\Address  $value
     * @param  array  $attributes
     * @return array
     */
    public function set($model, $key, $value, $attributes)
    {
        if (! $value instanceof Address) {
            throw new InvalidArgumentException('The given value is not an Address instance.');
        }

        return [
            'street' => $value->street,
            'city' => $value->city,
            'state' => $value->state,
            'zip' => $value->zip,
        ];
    }
}
