<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Models\User;

class ConnectionToken extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'token',
        'expired_at',
    ];

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime',
            'token' => 'encrypted'
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
