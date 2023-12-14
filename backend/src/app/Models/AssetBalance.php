<?php
/**
 * Created for asset balances.
 * User: Amburi Roy
 * Email: amburi.roy@gmail.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetBalance extends Model
{
    protected $table = 'asset_balances';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'party_id', 'asset_id', 'quantity'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'transaction_id' => 'integer',
        'party_id' => 'integer',
        'asset_id' => 'integer',
        'quantity' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    /**
     * @return BelongsTo
     */
    public function party()
    {
        return $this->belongsTo(User::class, 'party_id');
    }

    /**
     * @return BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

}
