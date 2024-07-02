<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'divisions';

    // Fields yang boleh diisi secara massal
    protected $fillable = [
        'name',
    ];
    public function cases()
    {
        return $this->hasMany(Cases::class);
    }
}
