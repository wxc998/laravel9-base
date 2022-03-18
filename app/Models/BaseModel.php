<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\BaseModel
 *
 * @method static Builder|BaseModel forceIndex(string $index)
 * @method static Builder|BaseModel newModelQuery()
 * @method static Builder|BaseModel newQuery()
 * @method static Builder|BaseModel query()
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    use HasFactory;

    protected function serializeDate(DateTimeInterface $dateTime): string
    {
        return $dateTime->format('Y-m-d H:i:s');
    }

    /**
     * 强制索引
     * @param Builder $query
     * @param string $index
     * @return Builder
     */
    public function scopeForceIndex(Builder $query, string $index): Builder
    {
        $table = $this->getTable();
        return $query->from(DB::raw("`$table` FORCE INDEX(`$index`)"));
    }


    protected $guarded = [];

}
