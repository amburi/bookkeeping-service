<?php

namespace App\Repositories;

use App\Models\AssetBalance;

/**
 * Class AssetBalanceRepository
 * @package App\Repositories
 * @author Amburi Roy <amburi.roy@gmail.com>
 */
class AssetBalanceRepository
{
    public function getLastAssetBalance($userId, $assetId)
    {
        return AssetBalance::wherePartyId($userId)->whereAssetId($assetId)->orderBy('updated_at', 'desc')->first();
    }

    public function getAssetBalancePosition($userId, $date)
    {
        return AssetBalance::whereIn('id', function ($query) use ($userId, $date) {
            $query->selectRaw("max(id) as max_id")
                ->from('asset_balances')
                ->wherePartyId($userId)
                ->whereDate('created_at', '<=', $date)
                ->groupBy('asset_id');
        })->get();
    }
}
