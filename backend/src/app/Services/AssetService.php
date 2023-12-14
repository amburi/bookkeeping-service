<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Asset;
use App\Models\AssetBalance;
use App\Models\Balance;
use App\Models\Transaction;
use App\Repositories\AssetBalanceRepository;
use App\Repositories\AssetRepository;
use App\Repositories\BalanceRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class AssetService
 * @package App\Services
 * @author Amburi Roy <amburi.roy@gmail.com>
 */
class AssetService
{
    /**
     * @var AssetRepository
     */
    private $assetRepo;


    public function __construct(AssetRepository $assetRepo)
    {
        $this->assetRepo = $assetRepo;
    }


    /**
     * Update asset with given price
     *
     * @param $assetData
     * @return void
     */
    public function updateAsset($assetData)
    {
        $this->assetRepo->update($assetData);
    }
}
