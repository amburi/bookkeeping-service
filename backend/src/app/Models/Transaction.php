<?php
/**
 * Created for transactions.
 * User: Amburi Roy
 * Email: amburi.roy@gmail.com
 */

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Transaction\Transaction
 *
 * @property int $id
 * @property int $party_id
 * @property int $counterparty_id
 * @property string|null $comment
 * @property mixed $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $party
 * @property-read User $counterparty
 */
class Transaction extends Model
{
    protected $table = 'transactions';

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'subject', 'quantity', 'asset_id', 'comment', 'party_id', 'counterparty_id', 'total_amount'
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
        'asset_id' => 'integer',
        'party_id' => 'integer',
        'counterparty_id' => 'integer',
        'quantity' => 'integer',
        'comment' => 'string',
    ];

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
    public function counterParty(): BelongsTo
    {
        return $this->belongsTo(User::class, 'counterparty_id');
    }

    /**
     * @return BelongsTo
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function getTypeAttribute($value)
    {
        return TransactionType::valueOf($value);
    }

    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = TransactionType::valueOf($value);
    }

    public function setAssetIdAttribute($value)
    {
        $this->attributes['asset_id'] = $value ?? null;
    }

    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = $value ?? 0;
    }

    public function setTotalAmountAttribute($value)
    {
        $this->attributes['total_amount'] = $value ?? '0.00';
    }
}
