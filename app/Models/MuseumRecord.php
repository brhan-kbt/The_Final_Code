<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuseumRecord extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
     * Get the user associated with the MuseumRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}