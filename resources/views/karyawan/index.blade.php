
@extends('layout/main')

@section('title', 'Daftar Karyawan')

@section('container')

    <div class="container">

        <div class="row ">
            <div class="col-md-12 ">
                <h1 class="mt-3">Daftar Karyawan</h1>

                <a href="/karyawan/tambah" class="btn btn-primary my-3">Tambah Data ✚</a>

                @if (session('alert'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @elseif (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- filter --}}
                        <div class="accordion mb-5" id="accordionExample">
                            <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                <button class="btn btn-warning" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" data-placement="top" title="Sortir Pencarian">

                                    <span class="badge badge-warning sanserif">Filter ▼</span>
                                </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body mb-1">
                                        <form action="/karyawan" method="post">
                                            @csrf
                                            <div class="content np ">
                                                <div class="controls-row ">
                                                    <div class="span2">Cabang :</div>
                                                    <div class="span4">
                                                        <select name="locationid" id="" class="custom-select">
                                                            <option value="">Pilih Cabang</option>
                                                            @foreach($lokasi as $loc)
                                                            <option value="{{$loc -> locationid}}">{{$loc -> locationname}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="span2 mt-3">Posisi :</div>
                                                    <div class="span4">
                                                        <select name="positionid" id="" class="custom-select">
                                                            <option value="">Pilih Posisi</option>
                                                            @foreach($posisi as $pos)
                                                            <option value="{{$pos -> positionid}}">{{$pos -> position}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="span2 mt-3">Status :</div>
                                                    <div class="span4">
                                                            <div class="form-group row">
                                                                    <div class="col-sm-5">
                                                                            <div class="custom-control custom-switch">
                                                                                    <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1" value="x">
                                                                                    <label class="custom-control-label" for="customSwitch1">Tidak Aktif</label>
                                                                                  </div>
                                                                    </div>
                                                                  </div>
                                                    </div>
                                                </div>
                                                <div class="span4 ml-3 mb2">
                                                        <button class="btn btn-primary mr-3 px-5" type="submit">Cari</button>
                                                        <a href="/karyawan" class="btn btn-danger" >Reset</a>
                                                    </div>
                                            </div>
                                        </form>
                                </div>
                            </div>


                    {{-- end filter --}}

                <div class="table-responsive rounded ">

                <table id="tabel-data" class="table mt-5">
                    <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="10%">NIK</th>
                        <th scope="col" width="25%">Nama</th>
                        <th scope="col" width="15%">Jabatan</th>
                        <th scope="col" width="25%">Cabang</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody  >
                            @foreach($karyawan as $kyn)
                        <tr >
                            <th scope="row" class="text-center">{{$loop -> iteration}}</th>
                            <td class="text-center">{{$kyn -> staffno}}</td>
                            <td>{{$kyn-> staffname}}</td>
                            <td class="text-center">{{$kyn -> position}}</td>
                            <td class="text-center">{{$kyn -> locationname}}</td>
                            <td class="text-center">
                                <form action="/karyawan/{{$kyn->staffid}}" method="post" >
                                <a href="{{url('/karyawan/profil/')}}/{{$kyn -> staffid}}" class="badge badge-info d-inline" data-toggle="tooltip" data-placement="top" title="Lihat Profil">Detail</a>
                                <a href="{{url('/karyawan/edit/')}}/{{$kyn -> staffid}}" class="badge badge-warning mx-2 d-inline" data-toggle="tooltip" data-placement="top" title="Edit Profil">Edit</a>

                                    @method('delete')
                                    @csrf
                                    <button class="badge badge-danger d-inline" type="submit" data-toggle="tooltip" data-placement="top" title="Delete Data">Hapus</button>
                                </form>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>


    @endsection

