@extends('layouts.base')

@section('content')
<div class="box box-success">
    <div class="box-header with-border text-center">
        <span class="box-title">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم</span>
    </div>
    <div class="box-body">
        <h3 class="text-center">Assalamu'alaikum Wr Wb</h3>
        <p class="text-center">Dengan menyebut nama Allah yang maha pengasih lagi maha penyayang.</p>
        <p class="text-center">Sesungguhnya belumlah sempurna suatu urusan jika tidak diawali dengan menyebut nama Allah.</p>
        <h3 class="text-center">Rangkuman Keuangan Mushola Al-Kautsar</h3>
        <br>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h4>@currency($masuk)</h4>

                  <p>Kas Masuk</p>
                </div>
                <div class="icon">
                  <i class="fa fa-download"></i>
                </div>
                <a href="{{ URL::to('/') }}/kas/masuk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h4>@currency($keluar)</h4>

                  <p>Kas Keluar</p>
                </div>
                <div class="icon" style="top: -17px !important">
                  <i class="fa fa-upload"></i>
                </div>
                <a href="{{ URL::to('/') }}/kas/Keluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h4>@currency($saldo)</h4>

                  <p>Saldo Kas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-money"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h4>0</h4>

                  <p>Lain nya</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
        </div>
        <br>
        <p>TTD. Bendahara DKM Al-Kautsar ( Joko Setyawan, Muhammad Machbub Marzuqi )</p>
    </div>
</div>
@endsection
