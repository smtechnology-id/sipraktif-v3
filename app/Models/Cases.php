<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;
    protected $table = 'cases';

    protected $fillable = [
        'user_id',
        'division_id',
        'nama_tersangka',
        'pasal_yang_disangkakan',
        'tahap_dua',
        'tanggal_perdamaian',
        'keterangan_detail',
        'tanggal_publish',
        'judul_berita',
        'gambar_sampul',
        'content_berita',
        'vidio',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
