<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PQRType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pqr_types';

    /**
     * Get the comments for the blog post.
     */
    public function pqrs()
    {
        return $this->hasMany(PQR::class);
    }
}
