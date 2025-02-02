@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xxl-3 col-sm-6">
        <div class="card widget-flat text-bg-pink">
            <div class="card-body">
                <div class="float-end">
                    <i class="ri-eye-line widget-icon"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers"> Divisi {{ Auth::User()->division->name }}</h6>
                <h2 class="my-2">{{ $countKasus }}</h2>
                <p class="mb-0">
                    <span class="text-nowrap">Total Kasus </span>
                </p>
            </div>
        </div>
    </div> <!-- end col-->
    <div class="col-xxl-3 col-sm-6">
        <div class="card widget-flat text-bg-primary">
            <div class="card-body">
                <div class="float-end">
                    <i class="ri-eye-line widget-icon"></i>
                </div>
                <h6 class="text-uppercase mt-0" title="Customers"> Divisi {{ Auth::User()->division->name }}</h6>
                <h2 class="my-2">{{ $countUser }}</h2>
                <p class="mb-0">
                    <span class="text-nowrap">Total User </span>
                </p>
            </div>
        </div>
    </div> <!-- end col-->

</div>
@endsection
