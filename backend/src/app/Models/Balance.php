<?php
/**
 * Created for balances.
 * User: Amburi Roy
 * Email: amburi.roy@gmail.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    protected $table = 'balances';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'party_id', 'balance_amount'
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
    ];

    /**
     * @return BelongsTo
     */
    public function party(): BelongsTo
    {
        return $this->belongsTo(User::class, 'party_id');
    }

    /**
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function setBalanceAmountAttribute($value)
    {
        $this->attributes['balance_amount'] = $value ?? '0.00';
    }
}
