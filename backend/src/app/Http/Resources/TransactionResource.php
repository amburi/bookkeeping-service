<?php

namespace App\Http\Resources;


use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TransactionResource
 * @author Amburi Roy <amburi.roy@gmail.com>
 * @package App\Http\Resources\Transacion
 * @OA\Schema(schema="Transaction", type="object")
 */
class TransactionResource extends JsonResource
{

    /**
     * @OA\Property(
     *   property="id",
     *   type="integer"
     * )
     */

    /**
     * @OA\Property(
     *   property="party",
     *   ref="#/components/schemas/User",
     * )
     */

    /**
     * @OA\Property(
     *   property="counter_party",
     *   ref="#/components/schemas/User",
     * )
     */

    /**
     * @OA\Property(
     *   property="quantity",
     *   type="double"
     * )
     */

    /**
     * @OA\Property(
     *   property="subject",
     *   type="string"
     * )
     */

    /**
     * @OA\Property(
     *   property="description",
     *   type="comment",
     *   nullable=true,
     * )
     */

    /**
     * Transform the resource into an array.
     *
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        /** @var Transaction $transaction */
        $transaction = clone $this;

        return array('id' => $transaction->id,
            'type' => $transaction->type,
            'asset' => $transaction->asset,
            'party' => $transaction->party,
            'counter_party' => $transaction->counterParty,
            'quantity' => $transaction->quantity,
            'total_amount' => $transaction->total_amount,
            'comment' => $transaction->comment,
        );
    }
}
