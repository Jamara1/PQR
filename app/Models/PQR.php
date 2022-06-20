<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditingAuditable;

class PQR extends Model implements Auditable
{
    use HasFactory;
    use AuditingAuditable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pqrs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'pqr_type_id',
        'subject',
        'deadline_date',
    ];
}
