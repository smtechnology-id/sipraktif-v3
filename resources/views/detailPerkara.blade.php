@extends('layouts.landing')

@section('content')
    <!-- Page Title Section -->
    <div class="page-title-section style-two">
        <div class="auto-container mt-5 pt-5">
            <ul class="post-meta">
                <li><a href="{{ route('index') }}">Homepage</a></li>
                <li>Data Perkara</li>
            </ul>
            <h2>{{ $kasus->judul_berita }}</h2>
        </div>
    </div>
    <!-- End Page Title Section -->

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container padding-top style-two">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Content Side -->
                <div class="content-side col-lg-9 col-md-12 col-sm-12">
                    <div class="blog-detail">
                        <div class="inner-box">
                            <div class="image">
                                <img src="{{ asset('storage/gambar_sampul/' . $kasus->gambar_sampul) }}" alt="Gambar Sampul Kasus" />

                            </div>
                            <div class="lower-content">
                                <div class="post-info"><span class="theme_color">Satuan Kerja {{ $kasus->division->name }}</span>
                                    - {{ $kasus->tanggal_publish }} by <i>{{ $kasus->user->name }}</i></div>
                                {!! $kasus->content_berita !!}
                                <!-- Post Share Options-->

                            </div>
                        </div>
                    </div>
                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                    <aside class="sidebar sticky-top margin-left">


                        <!--Category Blog-->
                        <div class="sidebar-widget categories-blog">
                            <div class="sidebar-title">
                                <h4>Satuan Kerja</h4>
                            </div>
                            <ul>
                                <li><a href="#">All <span>25</span></a></li>
                                @foreach ($divisi as $data)
                                    <li><a href="{{ route('dataPerkara', ['id' => $data->id]) }}">Satuan Kerja {{ $data->name }}
                                            <span>25</span></a></li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Popular Posts -->
                        <div class="sidebar-widget popular-posts">
                            <div class="sidebar-title">
                                <h4>Recent Posts</h4>
                            </div>
                            <div class="widget-content">
                                @foreach ($recentPosts as $recentPosts)
                                <div class="post">
                                    <figure class="post-thumb"><a href="blog-single.html"><img
                                                src="{{ asset('storage/gambar_sampul/' . $recentPosts->gambar_sampul) }}" alt=""></a></figure>
                                    <div class="text"><a href="{{ route('detailPerkara', ['slug' => $recentPosts->slug]) }}">{{ $recentPosts->judul_berita }}</a></div>
                                    <p>{{ $recentPosts->tanggal_publish }}</p>
                                </div>
                                @endforeach
                                

                            </div>
                        </div>

                        <!-- Tags -->

                    </aside>
                </div>

            </div>
        </div>

        <!-- Lower Section -->
        <!-- End Lower Section -->

    </div>
@endsection
