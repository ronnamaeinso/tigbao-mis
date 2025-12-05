<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'account_verified'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // scope get row
    public function scopeGetRows($query, array $selects = [], array $where = [], $search = '')
    {
        try {

            return $query->select($selects)
                ->where($where)
                ->when($search, function ($item, $search) {
                    if ($search != '') {
                        return $item->where('name', 'LIKE', "%$search%");
                    }
                });
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // update row
    public static function updateRow(array $data, int $id, bool $updateTimestamp = true)
    {
        try {
            // get row
            $item = self::findOrFail($id);

            // disabled timestamp if the @var updateTimestamp = false
            $updateTimestamp == false ? $item->timestamps = false : $item->timestamps = true;

            // update row
            $item->forceFill($data);

            // save change and return bool
            return $item->save();
        } catch (\Throwable $th) {
            throw $th; // throw throwable
        }
    }

    // delete row
    public static function deleteRow(int $id) : bool {
        try {
            return self::findOrFail($id)->delete(); // find row and delete
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function getUnverifiedAccountCount(): int {
        return (int) static::where('account_verified', '0')->get()->count();
    }
}
