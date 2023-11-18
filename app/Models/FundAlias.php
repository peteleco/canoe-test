<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundAlias extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'fund_id',
        'name'
    ];

    public function fund(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }
}
