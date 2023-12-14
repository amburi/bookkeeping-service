<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Asset;
use App\Models\AssetBalance;
use App\Models\Balance;
use App\Models\Transaction;
use App\Repositories\AssetBalanceRepository;
use App\Repositories\BalanceRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class TransactionService
 * @package App\Services
 * @author Amburi Roy <amburi.roy@gmail.com>
 */
class TransactionService
{

    /**
     * @var AssetBalanceRepository
     */
    private $assetBalanceRepo;

    /**
     * @var BalanceRepository
     */
    private $balanceRepo;


    public function __construct(
        AssetBalanceRepository $assetBalanceRepo,
        BalanceRepository      $balanceRepo
    )
    {
        $this->assetBalanceRepo = $assetBalanceRepo;
        $this->balanceRepo = $balanceRepo;
    }

    /**
     * Create new transaction
     *
     * @param array $transactionData
     * @return void
     * @throws Exception
     */
    function createTransaction(array $transactionData)
    {
        DB::beginTransaction();

        $transaction = new Transaction($transactionData);
        if ($transactionData['asset_id'] != null && $transactionData['quantity'] > 0) {
            $asset = $transaction->asset;
            $transaction->total_amount = $asset->current_price * $transaction->quantity;
        }

        try {

            $transaction->save();

            switch ($transactionData['type']) {
                case TransactionType::DEPOSIT:
                    $this->updateBalance($transaction->party_id, $transaction->id, $transaction->total_amount, true);
                    $this->updateBalance($transaction->counterparty_id, $transaction->id, $transaction->total_amount, false);
                    break;

                case TransactionType::WITHDRAW:
                    $this->updateBalance($transaction->counterparty_id, $transaction->id, $transaction->total_amount, true);
                    $this->updateBalance($transaction->party_id, $transaction->id, $transaction->total_amount, false);
                    break;

                case TransactionType::BUY:
                    $this->updateAssetBalance($transaction->party_id, $transaction->id, $transaction->asset_id, $transaction->quantity, true);
                    $this->updateAssetBalance($transaction->counterparty_id, $transaction->id, $transaction->asset_id, $transaction->quantity, false);
                    $this->updateBalance($transaction->party_id, $transaction->id, $transaction->total_amount, false);
                    $this->updateBalance($transaction->counterparty_id, $transaction->id, $transaction->total_amount, true);
                    break;

                case TransactionType::SELL:
                    $this->updateAssetBalance($transaction->counterparty_id, $transaction->id, $transaction->asset_id, $transaction->quantity, true);
                    $this->updateAssetBalance($transaction->party_id, $transaction->id, $transaction->asset_id, $transaction->quantity, false);
                    $this->updateBalance($transaction->counterparty_id, $transaction->id, $transaction->total_amount, false);
                    $this->updateBalance($transaction->party_id, $transaction->id, $transaction->total_amount, true);
                    break;
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }


    /**
     * Update balance of given user
     *
     * @param int $userId
     * @param int $transactionId
     * @param float $amount
     * @param bool $isAmountAddition
     * @return void
     */
    private function updateBalance(int $userId, int $transactionId, float $amount, bool $isAmountAddition): void
    {
        $prevAmount = 0;
        $balance = new Balance();
        $balance->party_id = $userId;
        $balance->transaction_id = $transactionId;

        $latestBalance = $this->balanceRepo->getLastBalance($userId);
        if ($latestBalance != null) {
            $prevAmount = $latestBalance->balance_amount;
        }

        if ($isAmountAddition) {
            $balance->balance_amount = $prevAmount + $amount;
        } else {
            $balance->balance_amount = $prevAmount - $amount;
        }

        $balance->save();
    }

    /**
     * Update asset balance of given user
     *
     * @param int $userId
     * @param int $transactionId
     * @param int $assetId
     * @param int $quantity
     * @param bool $isAssetAddition
     * @return void
     */
    private function updateAssetBalance(int $userId, int $transactionId, int $assetId, int $quantity, bool $isAssetAddition): void
    {
        $prevQuantity = 0;
        $assetBalance = new AssetBalance();
        $assetBalance->party_id = $userId;
        $assetBalance->transaction_id = $transactionId;
        $assetBalance->asset_id = $assetId;

        $latestAssetBalance = $this->assetBalanceRepo->getLastAssetBalance($userId, $assetId);
        if ($latestAssetBalance != null) {
            $prevQuantity = $latestAssetBalance->quantity;
        }

        if ($isAssetAddition) {
            $assetBalance->quantity = $prevQuantity + $quantity;
        } else {
            $assetBalance->quantity = $prevQuantity - $quantity;
        }

        $assetBalance->save();
    }

    /**
     * Get balance position
     *
     * @param int $userId
     * @param string $date
     * @return array
     */
    public function getBalancePosition(int $userId, string $date): array
    {
        $positionResources = array();

        $balanceAmount = $this->balanceRepo->getBalancePosition($userId, $date);
        if ($balanceAmount != null) {
            $positionResources['balance_amount'] = $balanceAmount->balance_amount;
        }

        $assetBalanceAmounts = $this->assetBalanceRepo->getAssetBalancePosition($userId, $date);
        foreach ($assetBalanceAmounts->toArray() as $assetBalanceAmount) {
            $assetName = Asset::find($assetBalanceAmount['asset_id']);
            $positionResources[$assetName->name] = $assetBalanceAmount['quantity'];
        }

        return $positionResources;
    }
}
