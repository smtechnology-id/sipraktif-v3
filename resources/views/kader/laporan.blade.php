@extends('layouts.app')

@section('content')
    <div class="row">
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addDivision">Tambah
            Laporan</button>
        <table class="table table-borderless">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Tanggal</td>
                    <td>Jam</td>
                    <td>Photo</td>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($laporan as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->tanggal }}</td>
                        <td>{{ $data->created_at->format('H:i') }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm mb-2" data-bs-toggle="modal"
                                data-bs-target="#detailLaporan{{ $data->id }}">Lihat Laporan</button>
                            <div id="detailLaporan{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="standard-modalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="standard-modalLabel">Detail Laporan</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>:</td>
                                                    <td>{{ $data->user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>:</td>
                                                    <td>{{ $data->tanggal }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jam</td>
                                                    <td>:</td>
                                                    <td>{{ $data->created_at->format('H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Catatan</td>
                                                    <td>:</td>
                                                    <td>{{ $data->catatan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Foto Laporan</td>
                                                    <td>:</td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><img
                                                            style="width: 350px; height: 100%; object-fit: cover;"
                                                            src="{{ asset('storage/laporan_kader/' . $data->foto) }}"
                                                            alt="" srcset=""></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                    </tr>
                @endforeach


                </tr>
            </tbody>
        </table>
    </div>
    <div id="addDivision" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Tambah Laporan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kader.addLaporanKader') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="foto">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
