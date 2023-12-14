<?php
/**
 * Created for Transaction Types
 * User: Amburi Roy
 * Email: amburi.roy@gmail.com
 */

namespace App\Enums;

use ReflectionClass;

class TransactionType
{
    const DEPOSIT = 'DEPOSIT';
    const WITHDRAW = 'WITHDRAW';
    const BUY = 'BUY';
    const SELL = 'SELL';

    public static function getValues()
    {
        $reflectionClass = new ReflectionClass(static::class);
        return array_values($reflectionClass->getConstants());
    }

    public static function valueOf($value)
    {
        $constants = static::getConstants();

        if (in_array($value, $constants)) {
            return $value;
        }

        return null;
    }

    private static function getConstants()
    {
        $reflectionClass = new ReflectionClass(static::class);
        return array_values($reflectionClass->getConstants());
    }
}
