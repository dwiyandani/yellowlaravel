
@extends('layout/main')

@section('title', 'Edit Profil Karyawan')

@section('container')

<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/karyawan') }}" class="text-primary">/Karyawan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
        </ol>
      </nav>

        <div class="row mb-5">
            <div class="col-11 ">
                <h1 class="mt-3 mb-5">Profil Karyawan</h1>


                <form method="post" action="/karyawan/update" enctype="multipart/form-data">
                    @csrf

                @foreach($karyawan as $kyn)
                <?php $picemp = $kyn->picfile ?>
                <?php $picktp = $kyn->picfile ?>
                <div class="card mx-auto border border-warning" style="width: 30rem;">
                    @if(isset($kyn->picfile) && file_exists('storage/images/profil/'.$picemp) )
                    <img src="{{asset('storage/images/profil/')}}/{{$kyn->picfile}}" class="card-img-top rounded-circle trans-90 mx-auto mt-3" alt="...">
                    @else
                    <img src="{{asset('storage/noimages.png')}}" class="card-img-top rounded-circle  mx-auto mt-3" alt="...">

                    @endif
                    <div class="card-body">

                        <input type="text" name="staffid" class="card-text sanserif input-form hide" title="Harus Nama Lengkap!" value="{{$kyn -> staffid}}" hidden>

                        <div class="span2 mt-3 fz-15 font-cs georgia text-info">NIK</div>
                                <input type="text" name="staffno" class="card-text sanserif input-form hide @error('staffno') is-invalid @enderror" title="Nomor Induk Karyawan" value="{{$kyn -> staffno}}" readonly>


                        <div class="span2 mt-3 fz-15 font-cs georgia text-info">Nama</div>

                                <input type="text" name="nama" class="card-text sanserif input-form hide @error('nama') is-invalid @enderror" title="Harus Nama Lengkap!" value="{{$kyn -> staffname}}">
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{$message}}
                                    </div>
                               @enderror

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Jenis Kelamin</div>
                                    <div class="" style="border-bottom-style: solid;">
                                        @if($kyn->gender == "M")
                                            <input class="card-text sanserif" type="radio" name="gender" id="gender1" value="{{$kyn -> gender}}" checked>
                                            <label class="form-check-label" for="gender1">
                                                Laki-laki
                                            </label>
                                            </label>
                                            <input class="card-text sanserif ml-3" type="radio" name="gender" id="gender1" value="F" >
                                            <label class="form-check-label" for="gender1">
                                                Perempuan
                                            </label>

                                        @elseif($kyn->gender =="F")
                                            <input class="card-text sanserif" type="radio" name="gender" id="gender1" value="{{$kyn -> gender}}" >
                                            <label class="form-check-label" for="gender1">
                                                Laki-laki
                                            </label>
                                            <input class="card-text sanserif ml-3" type="radio" name="gender" id="gender1" value="F" checked>
                                            <label class="form-check-label" for="gender1">
                                                Perempuan
                                            </label>

                                    @else

                                            <input class="card-text sanserif" type="radio" name="gender" id="gender1" value="{{$kyn -> gender}}" >
                                            <label class="form-check-label" for="gender1">
                                                Laki-laki
                                            </label>
                                                <input class="card-text sanserif ml-3" type="radio" name="gender" id="gender1" value="F" >
                                                <label class="form-check-label" for="gender1">
                                                    Perempuan
                                                </label>

                                    @endif
                                </div>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Jabatan</div>

                                <select name="posisi" class="form-control selectbox-form @error('posisi') is-invalid @enderror" id="posisi" >
                                        <option value="" disabled selected>Pilih Posisi</option>
                                        @foreach($posisi as $pos)
                                        @if($kyn->positionid <> $pos->positionid)
                                        <option value="{{$pos -> positionid}}" >{{$pos -> position}}</option>
                                        @else
                                        <option value="{{$pos -> positionid}}" selected>{{$pos -> position}}</option>
                                        @endif
                                        @endforeach

                                    </select>
                                    @error('jabatan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                   @enderror


                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Cabang</div>


                                        <select name="cabang" class="form-control selectbox-form @error('cabang') is-invalid @enderror" id="cabang" >
                                                <option value="" disabled selected>Pilih Cabang</option>
                                                @foreach($lokasi as $outlet)
                                                @if($kyn -> locationid <> $outlet->locationid)
                                                <option value="{{$outlet -> locationid}}" >{{$outlet -> locationname}}</option>
                                                @else
                                                <option value="{{$outlet -> locationid}}" selected>{{$outlet -> locationname}}</option>
                                            @endif
                                            @endforeach
                                            </select>
                                            @error('cabang')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                                </div>
                                           @enderror


                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">No Telp</div>

                                    <input type="number" name="telp" class="card-text sanserif input-form @error('telp') is-invalid @enderror" value="{{$kyn ->phone}}">

                                    @error('telp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                   @enderror

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Tempat, Tanggal Lahir</div>

                                    <input type="text" name="pob" class="card-text sanserif input-pob inline" value="{{$kyn -> pob}}">
                                    @error('pob')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                   @enderror
                                    <input type="text" id="dob" name="dob" class="card-text sanserif input-dob inline hide" title="Contoh : {{date("d/m/Y",strtotime("now"))}}" value="{{$kyn->dob}}" autocomplete="off">
                                    @error('dob')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                   @enderror


                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Alamat</div>

                                    <textarea name="alamat" id="" cols="30" rows="10" class="card-text sanserif input-form hide" title="Harus Sesuai KTP!">{{$kyn -> addr}}</textarea>

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Foto Karyawan</div>

                                    <div class="custom-file">
                                            <input type="file" name="picemp" class="custom-file-input sanserif input-form  @error('picktp') is-invalid @enderror  id="customFile">
                                            <label class="custom-file-label input-form" for="customFile"> @if(!isset($kyn->picfile)) {{$kyn->picfile}} @else Ganti Foto @endif </label>
                                          </div>

                                    @error('picemp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                   @enderror


                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">No KTP</div>
                                    <input type="text" name="noktp" class="card-text sanserif input-form" value="{{$kyn -> ktpno}}">
                                    @error('noktp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                   @enderror

                                <div class="span2 mt-3 fz-15 font-cs georgia text-info">Foto KTP</div>

                                    <div class="custom-file">
                                            <input type="file" name="picktp" class="custom-file-input sanserif input-form  @error('picktp') is-invalid @enderror  id="customFile">
                                            <label class="custom-file-label input-form" for="customFile"> @if(!isset($kyn->photoktp)) {{$kyn->photoktp}} @else Ganti Foto @endif </label>
                                          </div>

                                    @error('picktp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                        </div>
                                   @enderror

                                    @if(isset($kyn->photoktp) && file_exists('storage/images/ktp/'.$picktp))

                                            <img src="{{asset('storage/images/ktp/')}}/{{$kyn->photoktp}}" class="rounded mt-3 mb-3 ml-3 pasfoto" alt="{{$kyn->photoktp}}"><br>
                                        @else
                                            <img src="{{asset('storage/noimages.png')}}" class="rounded mb-3 ml-3 mt-3" alt="Foto Tidak Ada!"><br>
                                        @endif



                                    <div class="span2 mt-3 fz-15 font-cs georgia text-info inline mt-3">Tanggal Bergabung</div>

                                    <div class="span2 mt-3 fz-15 font-cs georgia text-info inline ml-6 mt-5">Tanggal Resign</div>

                                        <input type="text" id="datejoin" name="datejoin" class="card-text sanserif input-pob inline hide" title="Contoh : {{date("d/m/Y",strtotime("now"))}}" value="{{$kyn -> datestart}}">
                                            <input type="text" id="dateout"  name="dateout" class="card-text sanserif input-dob inline hide "  title="Contoh : {{date("d/m/Y",strtotime("now"))}}" value="{{$kyn -> dateresign}}">



                                        <div class="span2 mt-3 fz-15 font-cs georgia text-info ">Status</div>

                                            <div class="custom-control custom-switch">
                                                @if(isset($kyn -> inactive))
                                                    <input type="checkbox" name="inactive" class=" custom-control custom-switch custom-control-input " id="customSwitch1" value="x" checked>
                                                    @else
                                                    <input type="checkbox" name="inactive" class=" custom-control custom-switch custom-control-input " id="customSwitch1" value="x">

                                                @endif
                                                    <label class="custom-control-label sanserif" for="customSwitch1">Tidak Aktif</label>
                                                  </div>



                            </div>



                        @endforeach
                        <button type="submit" class="btn btn-primary border border-dark text-bold mx-5 mt-3  ">Simpan</button>
                        <button type="reset" class="btn btn-danger border border-dark text-bold mx-5  my-2">Reset</button>
                        <a href="/karyawan" class="btn btn-secondary border border-dark mx-5 mb-3 ">Kembali</a>
                    </div>
                  </div>
                </form>

            </div>


    @endsection

