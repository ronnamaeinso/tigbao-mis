<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    /**
     * get folder name
     */
    public static function getFolderName(int $id) : string {
        $row = static::findOrFail($id);
        return $row->name;
    }

    /**
     * files
     */
    public function files() : HasMany {
        return $this->hasMany(FileUpload::class);
    }

    /**
     * get folder name
     */
    public static function getAllFolders() {
        $data = static::orderBy('name', 'asc')->get();

        return $data;
    }
}
