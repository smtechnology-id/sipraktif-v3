@extends('layouts.landing')


@section('content')
    <div class="about-section">
        <div class="auto-container pt-5 mt-5">
            <div class="inner-container">
                <div class="row align-items-center clearfix">
                    <!-- Image Column -->

                    <!-- Content Column -->
                    <div class="content-column col-lg-12 col-md-12 col-sm-12 mb-0">
                        <div class="about-column">
                            <div class="sec-title">
                                <div class="title">Data Monitoring Perkara</div>
                                <h2>Satuan Kerja <span>{{ $divisiShow->name }}</span></h2>
                            </div>
                            <div class="text">
                               <div class="table-responsive">
                                <table id="myTable" class="display" class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Tersangka</th>
                                            <th>Pasal yang disangkakan</th>
                                            <th>Tahap II</th>
                                            <th>Tanggal Perdamaian</th>
                                            <th>Keterangan / Detail</th>
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
                                                <td>{{ \Carbon\Carbon::parse($data->tanggal_perdamaian)->isoFormat('D MMMM YYYY') }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('detailPerkara', ['slug' => $data->slug]) }}" class="btn btn-primary btn-sm  mb-2" style="background-color: #6B2032; border: none">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <div class="container py-5">
    @endsection
