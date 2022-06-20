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
        'status',
        'deadline_date',
    ];

    /**
     * Get the user that owns the comment.
     */
    public function status()
    {
        $options = [
            1 => __('New'),
            2 => __('In progress'),
            3 => __('Closed'),
        ];

        return $options;
    }

    /**
     * Get the user that owns the comment.
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    /**
     * Get the pqr types that owns the comment.
     */
    public function pqrTypes()
    {
        return $this->belongsTo(PQRType::class, 'pqr_type_id')->withDefault();
    }
}
