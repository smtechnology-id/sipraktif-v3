@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3>Tambah Data Kasus {{ Auth::user()->division->name }}</h3>
        <form action="{{ route('user.storeKasus') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <label for="nama_tersangka">Nama Tersangka</label>
                        <input type="text" class="form-control" id="nama_tersangka" name="nama_tersangka" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <label for="pasal_yang_disangkakan">Pasal yang Disangkakan</label>
                        <input type="text" class="form-control" id="pasal_yang_disangkakan" name="pasal_yang_disangkakan" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <label for="tahap_dua">Tahap II</label>
                        <input type="text" class="form-control" id="tahap_dua" name="tahap_dua" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <label for="tanggal_perdamaian">Tanggal Perdamaian</label>
                        <input type="date" class="form-control" id="tanggal_perdamaian" name="tanggal_perdamaian">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group my-2">
                        <label for="keterangan_detail">Keterangan/Detail</label>
                        <textarea class="form-control" id="keterangan_detail" name="keterangan_detail" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group my-2">
                        <label for="judul_berita">Judul Berita</label>
                        <input type="text" class="form-control" id="judul_berita" name="judul_berita" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group my-2">
                        <label for="gambar_sampul">Gambar Sampul</label>
                        <input type="file" class="form-control" id="gambar_sampul" name="gambar_sampul" accept="image/*">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group my-2">
                        <label for="content_berita">Content Berita</label>
                        <textarea class="form-control" id="content_berita" name="content_berita" rows="5" required></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group my-2">
                        <label for="vidio">Video YouTube URL</label>
                        <input type="url" class="form-control" id="vidio" name="vidio" placeholder="https://www.youtube.com/watch?v=example" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </div>
            </div>
        </form>
        


    </div>
    <script>
        CKEDITOR.replace('content_berita');

        document.getElementById('judul_berita').addEventListener('input', function() {
            const judul = this.value;
            const slug = judul.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
