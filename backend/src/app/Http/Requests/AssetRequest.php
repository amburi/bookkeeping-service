<?php

namespace App\Http\Requests;

use App\Enums\TransactionType;
use App\Rules\ConditionalNullableRule;

class AssetRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'asset_id' => 'required|integer|exists:assets,id',
            'latest_price' => 'required|integer',
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
            'latest_price' => 'current_price',
        ];
    }
}
