@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="row">
            @foreach ($divisi as $data)
                <div class="col-xxl-3 col-sm-6">
                    <div class="card widget-flat text-bg-purple">
                        <div class="card-body">
                            <div class="float-end">
                                <i class="ri-wallet-2-line widget-icon"></i>
                            </div>
                            <h6 class="text-uppercase mt-0" title="Customers">Total Kasus Di Satuan Kerja {{ $data->name }}</h6>
                            <h2 class="my-2">{{ $data->cases_count }}</h2>
                        </div>
                    </div>
                </div> <!-- end col-->
            @endforeach
        </div>
    </div>
@endsection
