<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
     //  $table->string('is_confirmed');
    //  $table->string('amount');
    //  $table->string('transaction_no')

      /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = [
        'is_confirmed',
        'amount',
        'transaction_no',
    ];

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
