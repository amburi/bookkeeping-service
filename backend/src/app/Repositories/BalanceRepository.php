<?php

namespace App\Repositories;

use App\Models\Balance;

/**
 * Class BalanceRepository
 * @package App\Repositories
 * @author Amburi Roy <amburi.roy@gmail.com>
 */
class BalanceRepository
{
    public function getLastBalance($userId)
    {
        return Balance::wherePartyId($userId)->orderBy('updated_at', 'desc')->first();
    }

    public function getBalancePosition($userId, $date)
    {
        return Balance::wherePartyId($userId)
            ->whereDate('created_at', '<=', $date)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->first();
    }
}
