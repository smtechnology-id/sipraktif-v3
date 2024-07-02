@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3>Data Kasus {{ Auth::user()->division->name }}</h3>
        <div class="table-responsive">
            <a href="{{ route('user.addKasus') }}" class="btn btn-primary mb-2 mt-3">Tambah Data</a>
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tersangka</th>
                        <th>Pasal yang disangkakan</th>
                        <th>Tahap II</th>
                        <th>Tanggal Perdamaian</th>
                        <th>Keterangan/Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($kasus as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->nama_tersangka }}</td>
                            <td>{{ $data->pasal_yang_disangkakan }}</td>
                            <td>{{ $data->tahap_dua }}</td>
                            <td>{{ $data->tanggal_perdamaian }}</td>
                            <td>{{ $data->keterangan_detail }}</td>
                            <td>
                                <a href="{{ route('detailPerkara', ['slug' => $data->slug]) }}" target="_blank"
                                    class="btn btn-primary mb-2"><i class="bi bi-eye-fill"></i></a>

                                <a href="{{ route('user.updateKasus', ['id' => $data['id']]) }}"
                                    class="btn btn-secondary mb-2"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $data->id }}"><i class="bi bi-trash-fill"></i></button>
                                <div id="delete{{ $data->id }}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Delete Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Konfirmasi Penghapusan Data</h3>
                                                <p>Apakah anda yakin ingin menghapus data ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a href="{{ route('user.deleteKasus', ['id' => $data->id]) }}"
                                                    class="btn btn-danger">Delete</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
