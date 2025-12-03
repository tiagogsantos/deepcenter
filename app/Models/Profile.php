<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $primaryKey = 'id';

    use HasFactory;

    protected $fillable = [
        'marital_status',
        'zipcode',
        'cpf',
        'rg',
        'date_birth',
        'address',
        'number',
        'neighborhood',
        'city',
        'state',
        'uf',
        'phone_number',
        'user_id'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
