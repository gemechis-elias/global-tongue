<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'level', 'type'];
       /**
     * User
     *
     * Get User Uploaded By Product
     *
     * @return object
     */
    public function user(): object
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email');
    }

}
