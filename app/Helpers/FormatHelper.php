<?php

use AddressFormat\AddressFormat;
use App\Employee;

if ( ! function_exists('formatEmployeeAddress')) {

    /**
     * Return trimmed array of employee's address parts (internationally aware, I think)
     *
     * @param Employee $employee
     *
     * @return string
     */
    function formatEmployeeAddress(Employee $employee)
    {
        $address = new AddressFormat();

        return $address->format([
                                    'address'     => $employee->Address1,
                                    'address2'    => $employee->Address2,
                                    'address3'    => $employee->Address3,
                                    'city'        => $employee->City,
                                    'subdivision' => $employee->State,
                                    'postalCode'  => $employee->Zip,
                                    'countryCode' => $employee->Country,
                                ]);
    }

}


if ( ! function_exists('formatEmployeePhone')) {

    /**
     * Return a formatted phone number from a passed in string
     *
     * @param $phone
     *
     * @return string
     */
    function formatEmployeePhone($phone)
    {
        // $phone = '';
        // $data  = $employee->HomePhone ? $employee->HomePhone : $employee->OtherPhone;

        if (preg_match('/^(\+\d)?(\d{3})(\d{3})(\d{4})$/', $phone, $matches)) {
            return $matches[2] . '-' . $matches[3] . '-' . $matches[4];
        }

        return $phone;
    }
}


if ( ! function_exists('formatCurrency')) {

    /**
     * Return a currency formatted string from a floating point value
     *
     * @param $amount
     *
     * @return string
     */
    function formatCurrency($amount)
    {
        $fmt = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        // TODO: Remove call to roundToNearest once ready to go live

        // return $fmt->formatCurrency(roundToNearest($amount), 'USD');
        return $fmt->formatCurrency($amount, 'USD');

    }

        function roundToNearest($amount)
    {
        if ($amount >= 10000) {
            $amount = ceil($amount / 100000) * 100000;
        } else if ($amount >= 1000) {
            $amount = ceil($amount / 10000) * 10000;
        } else if ($amount > 100) {
            $amount = ceil($amount / 1000) * 1000;
        } else if ($amount > 10) {
            $amount = ceil($amount / 100) * 100;
        } else if ($amount > 1) {
            $amount = ceil($amount / 10) * 10;
        } else if ($amount > 0) {
            $amount = ceil($amount / 1) * 1;
        }

        return $amount - .01;
    }
}
