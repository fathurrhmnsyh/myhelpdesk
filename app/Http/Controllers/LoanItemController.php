<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoanItem;
use Carbon\Carbon;
use DataTables;
use DB;
use Auth;
use Illuminate\Support\Str;

class LoanItemController extends Controller
{
    public function index()
    {
        // $type_asset = DB::table('itam_master_asset_codes')->orderBy('name')->get();
        // $location = DB::table('itam_master_location')->get();
        $section = DB::table('tb_section')->get(); 
        return view('pages/loan_item/index', compact("section"));
    }
    public function get_datatables(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('epinjam')->get();

            return Datatables::of($data)
            ->editcolumn('return_date', function($data){
                $dt = $data->return_date;
                $but = "<button type='button' class='btn btn-block btn-danger btn-sm'>Danger</button>";
                if ($dt != NULL) {
                    return $data->return_date;
                } else {
                    return view('pages.loan_item._actionNotReturn');
                }
            })
            // ->editcolumn('posted_date', function($data){
            //     $dt = $data->posted_date;
            //     if ($dt != NULL) {
            //         return $data->posted_date;
            //     } else {
            //         return "//";
            //     }
            // })
            // ->editcolumn('voided_date', function($data){
            //     $dt = $data->voided_date;
            //     if ($dt != NULL) {
            //         return $data->voided_date;
            //     } else {
            //         return "//";
            //     }
            // })
            // ->editColumn('posted_date', function($data){
            //     $data1 = $data->posted_date;
            //     if ($data1 != null) {
            //         return  Carbon::parse($data1)->format('d/m/Y');
            //     } else {
            //         return '//';
            //     }
            // })
            ->addColumn('action', function($data){
                return view('pages.loan_item._actionMaster', [
                    'model' => $data,
                ]);
            })->rawColumns(['action'])
            ->make(true);  
        }
    }
    public function store(Request $request)
    {
        if ($request->ajax()){
            $data = new LoanItem;
            $data->name = $request->name;
            $data->section = $request->section;
            $data->contact = $request->contact;
            $data->item_name = $request->item_name;
            $data->amount = $request->amount;
            $data->purpose = $request->purpose;
            $data->date = Carbon::now();
            
            $data->save();

            

            
                

        }

        
        return response()->json([
            'success' => true
        ]);
    }
    public function return(Request $request, $id)
    {
        DB::beginTransaction();
        try {
                //return
                $unpost = DB::table('epinjam')
                ->where('id_epinjam', $id)
                ->update(['return_date' => Carbon::now()]);

                
           


            DB::commit();
            return response()->json([
                'success' => true
            ]);
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->back();
        }
    }
}
