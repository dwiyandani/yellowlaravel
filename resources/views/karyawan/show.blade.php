
@extends('layout/main')

@section('title', 'Profil Karyawan')

@section('container')

<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/karyawan') }}" class="text-primary">/Karyawan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Profil</li>
        </ol>
      </nav>

        <div class="row mb-5">
            <div class="col-11 ">
                <h1 class="mt-3 mb-5">Profil Karyawan</h1>

                @foreach($karyawan as $kyn)

                <?php $picemp = $kyn->picfile ?>
                <?php $picktp = $kyn->picfile ?>

                <div class="card mx-auto border border-warning" style="width: 30rem;">
                    @if(isset($kyn->picfile) && file_exists('storage/images/profil/'.$picemp))
                    <img src="{{asset('storage/images/profil/')}}/{{$kyn->picfile}}" class="card-img-top rounded-circle trans-90 mx-auto mt-3" alt="...">
                    @else
                    <img src="{{asset('storage/noimages.png')}}" class="card-img-top rounded-circle  mx-auto mt-3" alt="...">

                    @endif
                    <div class="card-body ">

                        <h5 class="card-title text-center">{{$kyn -> staffname}}</h5>
                        @if($kyn->positionid == 11)
                        <p class="card-text text-center bt-black manager "><b>{{$kyn -> position}}</b></p>

                        @elseif($kyn->positionid ==13)
                        <p class="card-text text-center bt-black leader "><b>{{$kyn -> position}}</b></p>

                        @else
                        <p class="card-text text-center bt-black  text-light "><b>{{$kyn -> position}}</b></p>

                        @endif

                            <div class="span2 mt-3 fz-15 font-cs georgia text-info">NIK</div>
                                <div class="" style="border-bottom-style: solid;">
                                    <p class="card-text sanserif" >{{$kyn -> staffno}}</p>
                                </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Cabang</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        <p class="card-text sanserif" >{{$kyn -> locationname}}</p>
                                </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Jenis Kelamin</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        @if($kyn->gender =="M")
                                            <p class="card-text sanserif" >Laki - Laki</p>
                                        @else
                                            <p class="card-text sanserif" >Perempuan</p>
                                        @endif

                                </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">No Telp</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        <p class="card-text sanserif" >{{$kyn -> phone}}</p>
                                </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Tempat Tanggal Lahir</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        <p class="card-text sanserif" >{{$kyn -> pob}}, {{$kyn -> dob}}</p>
                                </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Alamat</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        <p class="card-text sanserif" >{{$kyn -> addr}}</p>
                                </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">No KTP</div>
                                    <div class="" style="border-bottom-style: solid;">
                                            <p class="card-text sanserif" >{{$kyn -> ktpno}}</p>
                                    </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Foto KTP</div>

                                    @if(isset($kyn->photoktp) && file_exists('storage/images/ktp/'.$picktp))

                                            <img src="{{asset('storage/images/ktp/')}}/{{$kyn->photoktp}}" class="rounded border border-dark mb-3 ml-3 pasfoto" alt="{{$kyn->staffname}}"><br>
                                        @else
                                            <img src="{{asset('storage/noimages.png')}}" class="rounded border border-dark mb-3 ml-3" alt="Foto Tidak Ada!">

                                        @endif

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Tanggal Bergabung</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        <p class="card-text sanserif" >{{$kyn -> datestart}}</p>
                                </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Tanggal Resign</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        @if(!isset($kyn->dateresign))
                                            <p class="card-text sanserif" >{{$kyn -> dateresign}}</p>
                                        @else
                                            <p class="card-text sanserif" ><b>-</b></p>
                                        @endif

                                </div>
                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Status Kontrak</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        @if(!isset($kyn->inactive))
                                            <p class="card-text sanserif" >Tidak Aktif</p>
                                        @else
                                            <p class="card-text sanserif" >Aktif</p>
                                        @endif

                                </div>

                            </div>



                        @endforeach
                        <a href="{{url('/karyawan/edit/')}}/{{$kyn -> staffid}}" class="btn btn-warning border border-dark text-bold mx-5  my-2">Edit Profile</a>
                        <a href="/karyawan" class="btn btn-secondary border border-dark mx-5 mb-3 ">Kembali</a>
                    </div>
                  </div>

            </div>


    @endsection

