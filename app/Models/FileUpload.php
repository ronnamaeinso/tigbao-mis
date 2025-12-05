<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileUpload extends Model
{
    /**
     * fillable the table columns/attributes
     */
    protected $fillable = [
        'folder_id',
        'file_name',
        'file_path'
    ];

    public function folder() : BelongsTo {
        return $this->belongsTo(Folder::class);
    }
}
