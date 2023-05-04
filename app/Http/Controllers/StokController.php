<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang_stok;
use App\Kategori;
use App\Stok_out;
use App\Stok_in;
use DB;
use Alert;
use Session;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $stok = Barang_stok::all();
        $kategori = Kategori::all();
        $stok_out = Stok_out::all();
        $last_stock = DB::table('stok_out')->latest('id')->first();

        $ambilDataStok = DB::table('barang_stok')
        ->where('stok', '<=', 2)
        ->get();

        $section = DB::table('tb_section')->get();

        if ($request->ajax()) {
            return datatables()->of($stok)->make(true);
        }


        // dd($ambilDataStok);
        Session::flash('stokAlert');
        return view('pages.cons_control.stok.stok_data', compact("stok", "kategori", "stok_out", "ambilDataStok", "last_stock","section"));
    }
    public function out(Request $request)
    {
        $requestData = $request->all();
        Stok_out::create($requestData);

        $brg = barang_stok::findOrFail($request->barang_id);
        $brg->stok -= $request->jumlah;
        $brg->save();


        return redirect('/stok')->with('warning', 'Stock Out Successfully!');
    }
    public function history_out(Request $request)
    {
        // $stok_out = DB::table('stok_out')
        // ->join('barang_stok', 'stok_out.barang_id', '=', 'barang_stok.id')
        // ->select('stok_out.*', 'barang_stok.barang_name')
        // ->orderBy('id', 'desc')
        // ->get();
        $stok_out = DB::table('stok_out')->get();



        if ($request->ajax()) {
            return datatables()->of($stok_out)->make(true);
        }
        return view('pages.cons_control.stok.riwayat_trans');
    }
    public function history_in(Request $request)
    {

        // $stok_in = DB::table('stok_in')
        // ->join('barang_stok', 'stok_in.barang_id', '=', 'barang_stok.id')
        // ->select('stok_in.*', 'barang_stok.barang_name')
        // ->orderBy('id', 'desc')
        // ->get();

        $stok = Barang_stok::all();

        $stok_in = DB::table('stok_in')->get();

        if ($request->ajax()) {
            return datatables()->of($stok_in)->make(true);
        }
        return view('pages.cons_control.stok.riwayat_trans', compact("stok"));
    }
    public function in(Request $request)
    {
        $requestData = $request->all();
        Stok_in::create($requestData);

        $brg = barang_stok::findOrFail($request->barang_id);
        $brg->stok += $request->jumlah;
        $brg->save();

        return redirect('/stok')->with('success', 'Stock In Successfully!');
    }
    public function getdata(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('barang_stok')
                    ->select('id','barang_name','barang_category')
                    ->get();
            return Datatables::of($data)->make(true);
        }
    }
    public function storestin(Request $request)
    {

            $date = $request->date;
            $input_by = $request->input_by;
            $no_ppb = $request->no_ppb;
            $barang_name = $request->barang;
            $jumlah = $request->jumlah;

            if(count($request->input('barang')) > 0){
                foreach($request->input('barang') as $item => $value){
                    $data = array(
                        'input_by' => $input_by,
                        'date' => $date,
                        'no_ppb' => $no_ppb,
                        'barang_name' => $barang_name[$item],
                        'jumlah' => $jumlah[$item]
                    );
                    $data2 = $data;
                    // dd($data2);
                    $get_data = Stok_in::create($data);

                }
                // dd($key);

                // dd($oldstock);
            }else {
                return response()->json([
                    'errors'=> $msg,
                ]);
             }
             return response()->json([
                'status' => 'Successfully Add'
            ]);


    }
    public function storestout(Request $request)
    {

            $date = $request->date;
            $input_by = $request->input_by;
            $no_perm = $request->no_perm;
            $name = $request->name;
            $section = $request->section;
            $barang_name = $request->barang;
            $jumlah = $request->jumlah;

            if(count($request->input('barang')) > 0){
                foreach($request->input('barang') as $item => $value){
                    $data = array(
                        'input_by' => $input_by,
                        'date' => $date,
                        'no_perm' => $no_perm,
                        'name' => $name,
                        'section' => $section,
                        'barang_name' => $barang_name[$item],
                        'jumlah' => $jumlah[$item]
                    );
                    $data2 = $data;
                    // dd($data2);
                    $get_data = Stok_out::create($data);

                }
                // dd($key);

                // dd($oldstock);
            }else {
                return response()->json([
                    'errors'=> $msg,
                ]);
             }
             return response()->json([
                'status' => 'Successfully Add'
            ]);


    }
    public function autoNumberPerm(Request $request)
    {
        $getYear = Carbon::now()->format('Y');
        // 22
        $getMonth = Carbon::now()->format('m');
        $getDay = Carbon::now()->format('d');
        $concatYnM = $getYear.$getMonth;

        $lastNoPerm = DB::table('stok_out')->latest('id')->select('no_perm')->first();
        $lastNoPerm1 = $lastNoPerm->no_perm;
        $perm_no = substr($lastNoPerm1,-3);
        $perm_noplus = (int)$perm_no + 1;
        $permPlus = '0'.$perm_noplus;

        // dd($lastNoPerm1);
        $zeroAdd = str_pad($permPlus, 3, "0", STR_PAD_LEFT);


        // dd($permPlus);
        if ($getDay != 01) {
            $no_perm = $concatYnM.'-'.$permPlus;
        }else{
            $no_perm = $concatYnM.'-'.'001';
        }


        // $no_perm = $concatYnM.'-'.$zeroAdd;
		return response()->json($no_perm);
    }
    public function getdata_ss(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('barang_stok')
                    ->select('id','barang_name','barang_category')
                    ->get();
            return Datatables::of($data)->make(true);
        }
    }
    public function stok_ss()
    {
        $section = DB::table('tb_section')->get();
        return view('pages.cons_control.stok.self-service.index', compact("section"));
    }
    public function stok_ss_autoNumberPerm(Request $request)
    {
        $getYear = Carbon::now()->format('Y');
        // 22
        $getMonth = Carbon::now()->format('m');
        $getDay = Carbon::now()->format('d');
        // dd($getDay);
        $concatYnM = $getYear.$getMonth;

        $lastNoPerm = DB::table('stok_out')->latest('id')->select('no_perm')->first();
        $lastNoPerm1 = $lastNoPerm->no_perm;
        $perm_no = substr($lastNoPerm1,-3);
        $perm_noplus = (int)$perm_no + 1;
        $permPlus = '0'.$perm_noplus;

        // dd($lastNoPerm1);


        // dd($permPlus);

        if ($getDay != 1) {
            $no_perm = $concatYnM.'-'.$permPlus;
        }else{
            $no_perm = $concatYnM.'-'.'001';
        }

        // $no_perm = $concatYnM.'-'.$permPlus;
		return response()->json($no_perm);
    }
    public function storestout_ss(Request $request)
    {

            $date = $request->date;
            $input_by = $request->input_by;
            $no_perm = $request->no_perm;
            $name = $request->name;
            $section = $request->section;
            $barang_name = $request->barang;
            $jumlah = $request->jumlah;

            if(count($request->input('barang')) > 0){
                foreach($request->input('barang') as $item => $value){
                    $data = array(
                        'input_by' => $input_by,
                        'date' => $date,
                        'no_perm' => $no_perm,
                        'name' => $name,
                        'section' => $section,
                        'barang_name' => $barang_name[$item],
                        'jumlah' => $jumlah[$item]
                    );
                    $data2 = $data;
                    // dd($data2);
                    $get_data = Stok_out::create($data);

                }
                // dd($key);

                // dd($oldstock);
            }else {
                return response()->json([
                    'errors'=> $msg,
                ]);
             }
             return response()->json([
                'status' => 'Successfully Add'
            ]);


    }

    public function get_datatables(Request $request)
    {
        // $stok_out = DB::table('stok_out')->get();



        // if ($request->ajax()) {
        //     return datatables()->of($stok_out)->make(true);
        // }
        // return view('pages.cons_control.stok.riwayat_trans');

        if ($request->ajax()) {
            $data = DB::table('stok_out')
            // ->where('name', Auth::user()->name)
            ->get();

            return Datatables::of($data)
            ->editcolumn('date', function($data){
                $dt = $data->date;
                if ($dt != NULL) {
                    return Carbon::parse($dt)->format('d/m/Y');
                } else {
                    return "//";
                }
            })
            ->make(true);
        }
    }
    public function autoNumberPerm_ss(Request $request)
    {
        $getYear = Carbon::now()->format('Y');
        // 22
        $getMonth = Carbon::now()->format('m');
        $getDay = Carbon::now()->format('d');
        $concatYnM = $getYear.$getMonth;

        $lastNoPerm = DB::table('stok_out')->latest('id')->select('no_perm')->first();
        $lastNoPerm1 = $lastNoPerm->no_perm;
        $perm_no = substr($lastNoPerm1,-3);
        $perm_noplus = (int)$perm_no + 1;
        $permPlus = '0'.$perm_noplus;

        // dd($lastNoPerm1);
        $zeroAdd = str_pad($permPlus, 3, "0", STR_PAD_LEFT);


        // dd($permPlus);
        // if ($getDay != 02) {
        //     // $no_perm = $concatYnM.'-'.$permPlus;
        //     $no_perm = $concatYnM.'-'.$zeroAdd;
        // }else{
        //     $no_perm = $concatYnM.'-'.'001';
        // }
        //CEK JIKA SUDAH BEDA BULAN

        $getlastmonth_ = substr($lastNoPerm1,0,6);
        $getlastmonth = substr($getlastmonth_,-2);
        // dd($getlastmonth);

        if ($getlastmonth != $getMonth) {
            $no_perm = $concatYnM.'-'.'001';
        }else{
            $no_perm = $concatYnM.'-'.$zeroAdd;
        }


        // $no_perm = $concatYnM.'-'.$zeroAdd;
		return response()->json($no_perm);
    }
    public function filter_data_item(Request $request)
    {
        $type = $request->type;

        $item_name = $request->item_name;

        if ($item_name != null) {
            $item_name = $request->item_name;
        }else{
            $item_name = 'All';
        }
        // dd($item_name);

        $start = Carbon::parse($request->input('start'))->startOfDay();
        $end = Carbon::parse($request->input('end'))->endOfDay();

        if ($type == 'stin') {
            if ($item_name == 'All') {
                # code...
                $transactions = Stok_in::whereBetween('date', [$start, $end])->get();
                $count_stin = Stok_in::whereBetween('date', [$start, $end])
                    ->sum('jumlah');
            }else{
                $transactions = Stok_in::whereBetween('date', [$start, $end])->where('barang_name', '=', $item_name)->get();
                $count_stin = Stok_in::whereBetween('date', [$start, $end])
                    ->where('barang_name', '=', $item_name)
                    ->sum('jumlah');
            }
            // dd($count_stin);
            $pdf = PDF::loadView('pages.cons_control.stok.report.report_stin_item', [
                'item' => $item_name,
                'data' => $transactions,
                'start' => $start,
                'end' => $end,
                'jumlah' => $count_stin,
            ]);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        }else{

            if ($item_name == 'All') {
                $transactions = Stok_out::whereBetween('date', [$start, $end])->get();

                $count_stin = Stok_out::whereBetween('date', [$start, $end])
                        ->sum('jumlah');
            }else{
                $transactions = Stok_out::whereBetween('date', [$start, $end])->where('barang_name', '=', $item_name)->get();

                $count_stin = Stok_out::whereBetween('date', [$start, $end])
                        ->where('barang_name', '=', $item_name)
                        ->sum('jumlah');
            }




            // dd($count_stin);
            $pdf = PDF::loadView('pages.cons_control.stok.report.report_stout_item', [
                'item' => $item_name,
                'data' => $transactions,
                'start' => $start,
                'end' => $end,
                'jumlah' => $count_stin,
            ]);
            $pdf->setPaper('A4', 'portrait');
            return $pdf->stream();
        }

    }
}
