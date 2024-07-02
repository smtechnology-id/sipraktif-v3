<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users
            $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade'); // Relasi ke tabel divisions
            $table->string('nama_tersangka');
            $table->string('pasal_yang_disangkakan');
            $table->string('tahap_dua');
            $table->date('tanggal_perdamaian')->nullable();
            $table->text('keterangan_detail')->nullable();
            $table->date('tanggal_publish');
            $table->string('judul_berita');
            $table->string('gambar_sampul')->nullable();
            $table->longText('content_berita');
            $table->string('vidio')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
