<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Eticket;
use App\Komputer;
use Carbon\Carbon;
use Auth;
use Alert;
use PDF;

class EticketController extends Controller
{
    public function index()
    {
        $ticket = DB::table('eticket')
        ->join('user', 'user.id', '=', 'eticket.id_user')
        ->where('id_user', Auth::user()->id)
        ->select('eticket.*', 'user.name')
        ->orderBy('status', 'asc')
        ->orderBy('id', 'desc')
        ->get();
        return view ('pages.eticket.eticket', compact("ticket"));
        
    }

    public function admin_index()
    {
        $open = DB::table('eticket')
        ->where('status', '=', 1)
        ->count();
        $onprocc = DB::table('eticket')
        ->where('status', '=', 2)
        ->count();
        $pending = DB::table('eticket')
        ->where('status', '=', 3)
        ->count();
        $close = DB::table('eticket')
        ->where('status', '=', 4)
        ->count();

        $ticket = DB::table('eticket')
        ->join('user', 'user.id', '=', 'eticket.id_user')
        ->select('eticket.*', 'user.name')
        ->orderBy('status', 'asc')
        ->orderBy('id', 'desc')
        ->get();
        return view ('pages.eticket.eticket_admin', compact("ticket", "open", "onprocc", "pending", "close" ));
    }
    public function admin_detail($id)
    {
        $eticket = DB::table('eticket')
        ->join('user', 'user.id', '=', 'eticket.id_user')
        ->select('eticket.*', 'user.name', 'user.section', 'user.nik')
        ->where('eticket.id', $id)
        ->first();
        
        return view('pages/eticket/eticket_admin_detail', ['eticket'=> $eticket]);
    }
    public function user_detail($id)
    {
        $eticket = DB::table('eticket')
        ->join('user', 'user.id', '=', 'eticket.id_user')
        ->select('eticket.*', 'user.name', 'user.section', 'user.nik')
        ->where('eticket.id', $id)
        ->first();
        
        return view('pages/eticket/eticket_user_detail', ['eticket'=> $eticket]);
    }
    public function admin_edit($id)
    {

        $eticket = DB::table('eticket')
        ->join('user', 'user.id', '=', 'eticket.id_user')
        ->select('eticket.*', 'user.name', 'user.section', 'user.nik')
        ->where('eticket.id', $id)
        ->first();

        $komputer = DB::table('komputer')->get();
       

        return view('pages/eticket/eticket_admin_edit', compact("eticket", "komputer"));
    }
    public function getkom(Request $request , $id)
    {
        
        $getID = DB::table($request->asset_type)->pluck("kode_fa", "kode_fa");
        return json_encode($getID);
    }
    

    public function store(Request $request)
    {
        $unique_ticket = Eticket::orderby('id', 'DESC')->pluck('id')->first();
        if($unique_ticket == null or $unique_ticket == "" ){
            #if table is empty
            $unique_ticket = 1;
        }
        else {
            # If table has already some data
            $unique_ticket = $unique_ticket + 1;
        }
        DB::table('eticket')->insert([
            'date' => Carbon::now()->format('Y-m-d'),
            'time' => Carbon::now()->format('Y-m-d H:i:s'),
            'id_user' => Auth::user()->id,
            'ticket_no' => 'ET'.date('Ym').$unique_ticket,
            'issue' => $request->issue,
            'status' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        
        return redirect('/eticket')->with('success', 'Ticket Add Successfully!');
    }


    
    public function update(Request $request, $id)
    {
        DB::table('eticket')->where('id', $request->id)->update([
            'problem' => $request->problem,
            'problem_type' => $request->problem_type,
            'solution' => $request->solution,
            'rep_part' => $request->rep_part,
            'id_asset' => $request->asset_type,
            'id_kode_fa' => $request->id_kode_fa,
            'status' => $request->status,
            'technician' => Auth::user()->name,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        
        return redirect('/eticket/admin')->with('success', 'Ticket Update Successfully!');
        
    }

    public function eriwayat(Request $request)
    {
        $eriwayat = DB::table('eticket')
        ->select('eticket.*')
        ->where('id_kode_fa', '>', '' )
        ->orderBy('date', 'desc')
        ->orderBy('id', 'desc')
        ->get();

        if ($request->ajax()) 
        {
         return datatables()->of($eriwayat)->make(true);
        }
        // dd($eticket);
        return view ('pages.eticket.eriwayat');
     }
     public function erw_search()
     {
         $eticket = DB::table('eticket')
        ->select('*')
        ->get();
 
        
 
        return view('pages/eticket/eriwayat_search', compact("eticket"));
     }

     public function search_result(Request $request)
    {
	// menangkap data pencarian
	$cari = $request->cari;
 
 	// mengambil data dari table pegawai sesuai pencarian data
	$eticket = DB::table('eticket')
	->where('id_kode_fa','like',"%".$cari."%")
	->get();

    // dd($eriwayat);

    // mengirim data pegawai ke view index
    // dd($eticket);
    return view('pages/eticket/eriwayat_search_r', compact("eticket"));
        

    }
    public function print(Request $request,$id_asset, $id_kode_fa)
    {
        
        // dd($id_asset);
       
        $eticket = DB::table('eticket')
        ->leftJoin($id_asset, 'eticket.id_kode_fa', '=', $id_asset.'.kode_fa') 
        ->select('eticket.*', $id_asset.'.*')
        ->where('eticket.id_kode_fa', $id_kode_fa)
        ->get();
    
        
        // dd($eticket);

        // $eriwayat = eriwayat_kom::find($id_kom);
        $pdf = PDF::loadview('pages/eticket/eriwayat_print', ['eticket' => $eticket])->setPaper('a4', 'portrait');
        // return $pdf->download('laporan-komputer-pdf.pdf');
        return $pdf->stream();
    }


}
