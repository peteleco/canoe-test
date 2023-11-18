<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fund extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'fund_manager_id',
        'name',
        'start_year'
    ];
    public function fundManager(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FundManager::class);
    }

    public function aliases(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FundAlias::class);
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withTimestamps()->withPivot(['deleted_at']);
    }
}
