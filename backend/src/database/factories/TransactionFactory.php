<?php

namespace Database\Factories;
/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Enums\TransactionType;
use App\Models\Asset;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {

        $users = User::inRandomOrder()->limit(2)->get();
        $userFrom = $users->first();
        $userTo = $users->last();

        $assets = Asset::inRandomOrder()->limit(1)->get();
        $asset = $assets->first();

        $transactionTypes = [
            TransactionType::DEPOSIT,
            TransactionType::WITHDRAW,
            TransactionType::BUY,
            TransactionType::SELL
        ];
        $date = date("Y-m-d H:i:s", rand(1546362453, 1688231253));

        return [
            'type' => $transactionTypes[array_rand($transactionTypes)],
            'quantity' => random_int(1, 5),
            'comment' => random_int(0, 1) ? fake()->realText(random_int(10, 100)) : null,
            'party_id' => $userFrom->id,
            'counterparty_id' => $userTo->id,
            'asset_id' => $asset->id,
            'created_at' => $date,
            'updated_at' => $date,
        ];

    }

}
