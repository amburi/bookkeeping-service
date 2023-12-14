<?php

namespace App\Repositories;

use App\Models\Asset;

class AssetRepository
{
    public function update($assetData): void
    {
        Asset::whereId($assetData['asset_id'])->update(['current_price' => $assetData['latest_price']]);
    }
}
