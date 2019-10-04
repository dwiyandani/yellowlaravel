<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Staff;
use App\Lokasi;
use App\Posisi;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $karyawan = DB::table('sky_staff')->get();
        $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
        left outer join sky_position p on p.positionid = s.positionid
      left outer join sky_location c on c.locationid= s.locationid');
        // $lokasi = DB::table('sky_location')->get();
        // $lokasi = lokasi::all();
        // $posisi = DB::table('sky_position')->get();
        $posisi = Posisi::all();
        $lokasi = Lokasi::all();
        // dump($karyawan);
        return view('karyawan.index', ['karyawan' => $karyawan, 'lokasi' => $lokasi, 'posisi' => $posisi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $karyawan = DB::table('sky_staff')->get();
        $staffno = Staff::select('staffno')->orderBy('staffid', 'desc')->take(1)->get();
        $posisi = Posisi::all();
        $lokasi = Lokasi::all();
        $profil = Storage::disk('public')->exists('noimages.png');

        // foreach ($karyawan as $kyn) {
        //     $no = $kyn->staffno + 1;
        // }
        // echo asset('noimages.png');
        // return Storage::url('noimages.png');


        // $staffno = ["staffno" => $no];
        // echo $staffno['staffno'];
        // dump($karyawan);
        // return $karyawan;
        // return view('karyawan.create');
        return view('karyawan.create', ['staffno' => $staffno, 'lokasi' => $lokasi, 'posisi' => $posisi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([

            'staffno' => 'required|max:50',
            'nama' => 'required|string|max:150',
            'dob' => 'max:10',
            'pob' => 'max:50',
            'gender' => '',
            'telp' => 'max:50',
            'alamat' => '',
            'noktp' => 'max:50',
            'picktp' => 'mimes:jpeg,bmp,png',
            'picemp' => 'mimes:jpeg,bmp,png',
            'posisi' => 'required',
            'cabang' => 'required',
            'joindate' => '',
            'joinout' => ''
        ]);



        $file =$request->picemp;
        $filektp =$request->picktp;

        if(!empty($file) ){

            $picemp = $request->staffno.'.'.$file->getClientOriginalExtension();
        }else{
            $picemp = $request->file('picemp');
        }
        if( !empty($filektp)){

            $picktp = $request->staffno.'.'.$file->getClientOriginalExtension();
        }else{
            $picktp = $request->file('picktp');

        }

        // dd($request->all());
      $staff =  Staff::create([
            'staffno' => $request->staffno,
            'staffname' => $request->nama,
            'dob' =>  $request->dob ? $request->dob : '',
            'pob' => $request->pob ? $request->pob : '',
            'gender' => $request->gender,
            // 'phone' => !empty($request->telp) ? $request->telp : '',
            'phone' => $request->telp ? $request->telp : '',
            'addr' => $request->alamat ? $request->alamat : '',
            'ktpno' => $request->noktp ? $request->noktp : '',
            'photoktp' => $request->file('picktp') ? $picktp : '',
            'picfile' =>   $request->file('picemp') ? $picemp : '',
            'positionid' => $request->posisi,
            'locationid' => $request->cabang,
            'datestart' => $request->joindate ? $request->joindate : '',
            'dateresign' => $request->joinout ? $request->joinout : '',
            'sp1' => '',
            'password' => '',
            'admin' => '',
            'inactive' => $request->inactive ? $request->inactive : ''
            ]);

            if($request->hasFile('picemp')){

            $staff->picfile = $file->storeAs('/images/profil',$request->staffno.'.'.$file->getClientOriginalExtension(),'public');

            }

            if($request->hasFile('picktp')){

            $staff->photoktp = $filektp->storeAs('/images/ktp',$request->staffno.'.'.$file->getClientOriginalExtension(),'public');

            }
        // $staff->save();
        // dd($staff);

        return redirect('/karyawan')->with('alert', 'Data Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     * @param \App\Staff $staff
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $id = $staff->staffid;
        $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
            left outer join sky_position p on p.positionid = s.positionid
          left outer join sky_location c on c.locationid=s.locationid WHERE s.staffid=? ', [$id]);
        // return view('karyawan.show', compact('staff'));
        return view('karyawan.show', ['karyawan' => $karyawan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
        $posisi = Posisi::all();
        $lokasi = Lokasi::all();

        $id = $staff->staffid;
        $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
            left outer join sky_position p on p.positionid = s.positionid
          left outer join sky_location c on c.locationid=s.locationid WHERE s.staffid=? ', [$id]);
        // return view('karyawan.show', compact('staff'));
        return view('karyawan.edit', ['karyawan' => $karyawan, 'posisi'=>$posisi, 'lokasi' => $lokasi]);
    }

    /**
     * Update the specified resource in storage.
     *@param \App\Staff $staff
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        // dd($request->all());

        $request->validate([

            'nama' => 'required|string|max:150',
            'dob' => 'max:10',
            'pob' => 'max:50',
            // 'gender' => '',
            'telp' => 'max:50',
            // 'alamat' => '',
            'noktp' => 'max:50',
            'picktp' => 'mimes:jpeg,bmp,png',
            'picemp' => 'mimes:jpeg,bmp,png',
            'posisi' => 'required',
            'cabang' => 'required',
            // 'joindate' => '',
            // 'joinout' => ''
        ]);



        $file =$request->picemp;
        $filektp =$request->picktp;

        if(!empty($file) ){

            $picemp = $request->staffno.'.'.$file->getClientOriginalExtension();
        }else{
            $picemp = $request->file('picemp');
        }
        if( !empty($filektp)){

            $picktp = $request->staffno.'.'.$file->getClientOriginalExtension();
        }else{
            $picktp = $request->file('picktp');

        }

        $staff = Staff::find($request->staffid)->update(
        [

            'staffno' => $request->staffno,
            'staffname' => $request->nama,
            'dob' =>  $request->dob ? $request->dob : '',
            'pob' => $request->pob ? $request->pob : '',
            'gender' => $request->gender,
            // 'phone' => !empty($request->telp) ? $request->telp : '',
            'phone' => $request->telp ? $request->telp : '',
            'addr' => $request->alamat ? $request->alamat : '',
            'ktpno' => $request->noktp ? $request->noktp : '',
            'positionid' => $request->posisi,
            'locationid' => $request->cabang,
            'datestart' => $request->joindate ? $request->joindate : '',
            'dateresign' => $request->joinout ? $request->joinout : '',
            'sp1' => '',
            'password' => '',
            'admin' => '',
            'inactive' => $request->inactive ? $request->inactive : ''
        ]);

        // $staff = Staff::where('staffid',$request->staffid)->where('staffno',$request->staffno)->update([

        //     'staffno' => $request->staffno,
        //     'staffname' => $request->nama,
        //     'dob' =>  $request->dob ? $request->dob : '',
        //     'pob' => $request->pob ? $request->pob : '',
        //     'gender' => $request->gender,
        //     // 'phone' => !empty($request->telp) ? $request->telp : '',
        //     'phone' => $request->telp ? $request->telp : '',
        //     'addr' => $request->alamat ? $request->alamat : '',
        //     'ktpno' => $request->noktp ? $request->noktp : '',
        //     'photoktp' => $request->file('picktp') ? $picktp : '',
        //     'picfile' =>   $request->file('picemp') ? $picemp : '',
        //     'positionid' => $request->posisi,
        //     'locationid' => $request->cabang,
        //     'datestart' => $request->joindate ? $request->joindate : '',
        //     'dateresign' => $request->joinout ? $request->joinout : '',
        //     'sp1' => '',
        //     'password' => '',
        //     'admin' => '',
        //     'inactive' => $request->inactive ? $request->inactive : ''
        // ]);



        if($request->hasFile('picemp')){

            Staff::find($request->staffid)->update(['picfile' =>   $request->file('picemp') ? $picemp : '']);
            
            $file->storeAs('/images/profil',$request->staffno.'.'.$file->getClientOriginalExtension(),'public');
            
        }
        
        if($request->hasFile('picktp')){
            
            Staff::find($request->staffid)->update(['photoktp' =>   $request->file('picktp') ? $picemp : '']);

             $filektp->storeAs('/images/ktp',$request->staffno.'.'.$file->getClientOriginalExtension(),'public');

            }
        // $staff->save();
        // dd($staff);

        return redirect('/karyawan')->with('alert', 'Data Berhasil Di Update!');

    }

    /**
     * Remove the specified resource from storage.
     * @param \App\Staff $staff
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        // return $staff;
        Staff::destroy($staff->staffid);
        return redirect('/karyawan')->with('hapus', 'Data Berhasil Dihapus!');
    }

    /**
     * Store a newly created filter in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $locationid = $request->locationid;
        $positionid = $request->positionid;
        $status = $request->status;

        if ($locationid != "" && $positionid == "" && $status =="") {
            $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
            left outer join sky_position p on p.positionid = s.positionid
          left outer join sky_location c on c.locationid=s.locationid WHERE s.locationid=? ', [$locationid]);
        } elseif ($locationid == "" && $positionid != "" && $status =="") {
            $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
                left outer join sky_position p on p.positionid = s.positionid
              left outer join sky_location c on c.locationid= s.locationid  WHERE s.positionid=?', [$positionid]);
        } elseif ($locationid != "" && $positionid != "" && $status =="") {
            $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
                 left outer join sky_position p on p.positionid = s.positionid
               left outer join sky_location c on   c.locationid = s.locationid WHERE s.positionid= ? AND s.locationid=? ', [$positionid, $locationid]);
        }elseif ($locationid == "" && $positionid == "" && $status !="") {
            $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
                 left outer join sky_position p on p.positionid = s.positionid
               left outer join sky_location c on   c.locationid = s.locationid WHERE s.inactive = ? ', [ $status]);
        }
         elseif ($locationid != "" && $positionid != "" && $status !="") {
            $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
                 left outer join sky_position p on p.positionid = s.positionid
               left outer join sky_location c on   c.locationid = s.locationid WHERE s.positionid= ? AND s.locationid=? AND s.inactive=? ', [$positionid, $locationid,$status]);
        }
        $staff = Staff::all();
        $lokasi = DB::table('sky_location')->get();
        $posisi = DB::table('sky_position')->get();
        // dd($karyawan);
        // echo $karyawan;
        return view('karyawan.index', ['karyawan' => $karyawan, 'lokasi' => $lokasi, 'posisi' => $posisi, 'staff' => $staff]);

        // $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
        //          left outer join sky_position p on p.positionid = s.positionid
        //        left outer join sky_location c on   c.locationid = s.locationid WHERE s.positionid=?  ', [$positionid]);
        // $karyawan = DB::select('SELECT s.*,p.position,c.locationname  FROM sky_staff s
        //          left outer join sky_position p on p.positionid = s.positionid
        //        left outer join sky_location c on   c.locationid = s.locationid WHERE s.locationid=?  ', [$locationid]);

        // $lokasi = DB::table('sky_location')->get();
        // $posisi = DB::table('sky_position')->get();
        // return view('karyawan.index', ['karyawan' => $karyawan, 'lokasi' => $lokasi, 'posisi' => $posisi]);
    }
}
