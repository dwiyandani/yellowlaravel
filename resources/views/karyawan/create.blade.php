
@extends('layout/main')

@section('title', 'Profil Karyawan')



@section('container')

<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/karyawan') }}" class="text-primary">/Karyawan</a></li>
          <li class="breadcrumb-item active" aria-current="page">Tambah Data Karyawan</li>
        </ol>
      </nav>

        <div class="row mb-5">
            <div class="col-6 ">
                <h1 class="bg-black text-yellow rounded mt-3 mb-5">Form Tambah Data Karyawan</h1>

                <form method="post" action="/karyawan/tambah" enctype="multipart/form-data">


                    @csrf
                    <div class="form-group row">
                        <label for="staffno" class="col-sm-4 col-form-label">Staff No</label>
                        <div class="col-sm-7">
                            @foreach($staffno as $nik)
                          <input type="text" name="staffno" class="form-control @error('staffno') is-invalid @enderror" id="staffno" value="{{$nik->staffno + 1}}" readonly>
                          @endforeach
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-7">
                          <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" value="{{old('nama')}}">
                          @error('nama')
                          <div class="invalid-feedback">
                              {{$message}}
                              </div>
                         @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                          <label for="dob" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                          <div class="col-sm-7">
                              <input type="text" name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob" placeholder="Tanggal Lahir" value="{{old('dob')}}" autocomplete="off">

                              @error('dob')
                              <div class="invalid-feedback">
                                  {{$message}}
                                  </div>
                             @enderror
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="pob" class="col-sm-4 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-7">
                            <input type="text" name="pob" class="form-control @error('pob') is-invalid @enderror" id="pob" placeholder="Tempat Lahir" value="{{old('pob')}}">

                            @error('pob')
                            <div class="invalid-feedback">
                                {{$message}}
                                </div>
                           @enderror
                        </div>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                          <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                          <div class="col-sm-7">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="gender" id="gender1" value="M" checked>
                              <label class="form-check-label" for="gender1">
                                Laki-laki
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="gender" id="gender2" value="F">
                              <label class="form-check-label" for="gender2">
                                Perempuan
                              </label>
                            </div>
                          </div>
                        </div>
                      </fieldset>

                      <div class="form-group row">
                        <label for="telp" class="col-sm-4 col-form-label">No Telp</label>
                        <div class="col-sm-7">
                          <input type="number" name="telp" class="form-control" id="telp" placeholder="No Telp" value="{{old('telp')}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-7">
                          <textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" value="{{old('alamat')}}"></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="noktp" class="col-sm-4 col-form-label">No KTP</label>
                        <div class="col-sm-7">
                          <input type="number" name="noktp" class="form-control" id="noktp" placeholder="Nomor KTP" value="{{old('noktp')}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="picktp" class="col-sm-4 col-form-label">Foto KTP</label>
                        <div class="col-sm-7">
                                <div class="custom-file">
                                        <input type="file" name="picktp" class=" @error('picktp') is-invalid @enderror" id="picktp" aria-describedby="inputGroupFileAddon01" >
                                        {{-- @error('picktp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                       @enderror --}}
                                      </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="fotoemp" class="col-sm-4 col-form-label">Foto Karyawan</label>
                        <div class="col-sm-7">
                                <div class="custom-file">
                                        <input type="file" name="picemp" class=" @error('picemp') is-invalid @enderror" id="picemp" aria-describedby="inputGroupFileAddon01" >
                                        {{-- @error('picemp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                            </div>
                                       @enderror --}}
                                        {{-- <label class="custom-file-label" for="picemp"></label> --}}
                                      </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="posisi" class="col-sm-4 col-form-label">Posisi</label>
                        <div class="col-sm-7">
                          <select name="posisi" class="form-control @error('posisi') is-invalid @enderror" id="posisi" >
                              <option value="">Pilih Posisi</option>
                              @foreach($posisi as $pos)
                              <option value="{{$pos -> positionid}}">{{$pos -> position}}</option>
                              @endforeach

                          </select>
                          @error('posisi')
                          <div class="invalid-feedback">
                              {{$message}}
                              </div>
                         @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                            <label for="cabang" class="col-sm-4 col-form-label">Cabang</label>
                            <div class="col-sm-7">
                              <select name="cabang" class="form-control @error('cabang') is-invalid @enderror" id="cabang" >
                                  <option value="">Pilih Cabang</option>
                                  @foreach($lokasi as $outlet)
                              <option value="{{$outlet -> locationid}}">{{$outlet -> locationname}}</option>
                              @endforeach
                              </select>
                              @error('cabang')
                              <div class="invalid-feedback">
                                  {{$message}}
                                  </div>
                             @enderror
                            </div>
                          </div>

                          <div class="form-group row">
                                <label for="joindate" class="col-sm-4 col-form-label">Tanggal Bergabung</label>
                                <div class="col-sm-7">
                                  <input type="text" name="joindate" class="form-control hide date" id="joindate" value="{{old('joindate')}}" >
                                </div>
                              </div>

                          <div class="form-group row">
                                <label for="joinout" class="col-sm-4 col-form-label">Tanggal Resign</label>
                                <div class="col-sm-7">
                                  <input type="text" name="joinout" class="form-control date" id="joinout" value="{{old('joinout')}}" >
                                </div>
                              </div>

                              <div class="form-group row">
                                    <label for="status" class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-5">
                                            <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="inactive" class="custom-control-input" id="customSwitch1" value="x">
                                                    <label class="custom-control-label" for="customSwitch1">Tidak Aktif</label>
                                                  </div>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                      <button type="submit" class="btn btn-primary sanserif">Tambah Data!</button>
                                      <div class="col-sm-5">
                                            <a href="/karyawan" class="btn btn-danger sanserif">Kembali</a>

                                        </div>
                                      </div>

                  </form>


            </div>
        </div>
    </div>

    @endsection

