<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * This model class is for summons table
 *
 * Uses SoftDeletes, has protected fillable(table attributes)
 * has protected casts for petsa
 *
 */
class Summon extends Model
{
    use SoftDeletes;

    /**
     * The attributes of tbl summons
     *
     * status
     *      1 - Submitted.
     *      2 - Approved and still in process.
     *      3 - Rejected with reject_comments.
     *      4 - Document is generate pdf.
     *      5 - Issued, Ready for pick up.
     */
    protected $fillable = [
        'user_id',
        'kaso_sa_brgy_isip',
        'mga_nagsumbong',
        'mga_gisumbong',
        'bahin_sa',
        'petsa',
        'status',
        'reject_comment',
        'generated_at'
    ];

    protected $casts = [
        'petsa' => 'datetime',
        'generated_at' => 'datetime'
    ];

    /**
     * Scope a query to select rows with optional search filtering.
     *
     * Builds a query with given columns and where conditions.
     * If a search string is provided, applies OR-based filtering
     * across multiple predefined searchable columns.
     * if $join in not empty then make a join query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array|string $selects  The columns to select.
     * @param array|string $wheres   Base where condition(s).
     * @param string $search         Optional search keyword.
     * @param array $join            Join a table
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetRows(Builder $query, array|string $selects = ['*'], array|string $wheres = '', string|null $search = '', array $join = []) : Builder
    {
        $query->select($selects);

        if($wheres){
            $query->where($wheres);
        }

        if (!empty($search)) {

            $searchables = [
                'kaso_sa_brgy_isip',
                'mga_nagsumbong',
                'mga_gisumbong',
                'bahin_sa',
                'status',
            ];

            $query->where(function ($q) use ($search, $searchables) {
                foreach ($searchables as $item) {
                    $q->orWhere($item, 'like', "%{$search}%");
                }
            });
        }


        if($join){
            $query->join(...$join);
        }

        return $query;
    }

    /**
     * Update any row
     *
     *
     */
    public static function updateRow(int $id, array $data, bool $timestampOff = false) {
        $item = self::findOrFail($id);

        if($timestampOff) $item->timestamps = false;

        $item->forceFill($data);

        return $item->save();
    }

}
