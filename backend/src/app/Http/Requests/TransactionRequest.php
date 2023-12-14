<?php

namespace App\Http\Requests;


use App\Enums\TransactionType;
use App\Rules\ConditionalNullableRule;

/**
 * Class TransactionRequest
 * @author Amburi Roy <amburi.roy@gmail.com>
 * @package App\Http\Requests\Transaction
 */
class TransactionRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'party_id' => 'required|integer|exists:users,id',
            'counterparty_id' => 'required|integer|exists:users,id',
            'type' => 'required|string|in:' . implode(',', TransactionType::getValues()),
            'asset_id' => [
                new ConditionalNullableRule('type', [
                    TransactionType::DEPOSIT,
                    TransactionType::WITHDRAW
                ])
            ], '|integer|exists:assets,id',
            'quantity' => [
                new ConditionalNullableRule('type', [
                    TransactionType::DEPOSIT,
                    TransactionType::WITHDRAW
                ])
            ], '|integer',
            'total_amount' => [
                new ConditionalNullableRule('type', [
                    TransactionType::BUY,
                    TransactionType::SELL
                ])
            ], '|integer',
            'comment' => 'nullable|string|max:1000',
        ];
    }


    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'asset_id' => 'asset_id',
            'party_id' => 'party_id',
            'counterparty_id' => 'counterparty_id',
            'quantity' => 'quantity',
            'subject' => 'comment',
            'comment' => 'abc',
            'total_amount' => 'total_amount',
        ];
    }
}
