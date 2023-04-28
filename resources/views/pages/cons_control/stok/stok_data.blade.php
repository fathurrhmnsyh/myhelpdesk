@extends('layouts.admin')
@section('title', 'Stock | Consumable Control')
@section('title-sub', 'Consumable Stock')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/">IT Asset</a></li>
    <li class="breadcrumb-item ">Consumable Control</li>
    <li class="breadcrumb-item active">Stock</li>
</ol>
@endsection

@section('content')
@include('pages.cons_control.stok.stok-in.modal_stin')
@include('pages.cons_control.stok.stok-in.modal_item_stin')
@include('pages.cons_control.stok.stok-out.modal_stout')

<div class="col-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <!-- <button class="btn btn-success " data-toggle="modal" data-target="#myModalin"><i class="fa fa-plus"></i>
                Stok In</button> -->
            <button class="btn btn-primary " data-toggle="modal" data-target="#myModalstin"><i class="fa fa-plus"></i>
                Stok In</button>
            <!-- <button class="btn btn-danger " data-toggle="modal" data-target="#myModal"><i class="fa fa-minus"></i> Stok
                Out</button> -->
            <button class="btn btn-danger " data-toggle="modal" id="btnstout"><i class="fa fa-minus"></i>
                Stok Out</button>
            <br>
            <br>
            @if ($message = Session::get('stokAlert'))

            @foreach ($ambilDataStok as $s)
            <div class="alert alert-alt alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Ups, <a class="alert-link" href="javascript:void(0)">{{$s->barang_name}} sisa {{$s->stok}} </a> Segera
                Order!
            </div>
            @endforeach
            @endif
            <br>
            <table id="table-stock" class="table table-hover table-striped w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang Name</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                    </tr>
                </thead>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title">Stock Out</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="row " action="/stok/out" id="dynamicAddRemove" >
                    {{ csrf_field() }}
                    <p align="right" style="font-size: 15px, margin-bottom: -10px">last no trans : <span style="color:red">{{ $last_stock->no_perm}}</span> </p>
                    <div class="form-group col-md-12">
                        <label>Date</label>
                        <input type="hidden" name="input_by" class="form-control" value="{{auth()->user()->name}}">
                        <input type="date" name="date" class="form-control" placeholder="Date">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Pilih Barang</label><br>
                        <select name="barang_id" class="js-example-basic-single" style="width: 100%">
                            <option value="">Open Select Menu</option>
                            @foreach($stok as $st)
                            <option value="{{ $st->id}}">{{ $st->barang_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group col-md-3">
                    <button style="margin-top: 35px;" type="button" name="add" id="add-btn-so" class="btn btn-success btn-sm">+ Add More</button>
                    </div> --}}
                    <div class="form-group col-md-12">

                        <label>No Transaction</label>
                        <input type="text" name="no_perm" class="form-control" placeholder="No transaction">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Section</label>
                        <select class="form-control" name="section" type="text">
                            <option value="Accounting & Fin">Accounting & Fin</option>
                            <option value="Engineering">Engineering</option>
                            <option value="GA">GA</option>
                            <option value="HRD">HRD</option>
                            <option value="IT">IT</option>
                            <option value="Inventory Management">Inventory Management</option>
                            <option value="Marketing">Marketing</option>
                            <option value="PPC & Delvcon">PPC & Delvcon</option>
                            <option value="Purchasing">Purchasing</option>
                            <option value="Production">Production</option>
                            <option value="QA">QA</option>
                            <option value="QHSE">QHSE</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" placeholder="Jumlah">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal Stok In -->
<div class="modal fade" id="myModalin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title">Stock In</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/stok/in">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Date</label>
                        <input type="hidden" name="input_by" class="form-control" value="{{auth()->user()->name}}">
                        <input type="date" name="date" class="form-control" placeholder="Date">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pilih Barang </label><br>
                        <select name="barang_id" class="form-control js-example-basic-single" style="width: 100%">
                            <option value="">Open Select Menu</option>
                            @foreach($stok as $st)
                            <option value="{{ $st->id}}">{{ $st->barang_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>No PPB</label>
                        <input type="text" name="no_ppb" class="form-control" placeholder="No PPB">
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" placeholder="Jumlah">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>





@endsection
@push('page-script')
    <script>
        $(function () {
        $('#table-stock').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/stok',
            columns: [{
                    data: 'no',
                    name: 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'barang_name',
                    name: 'barang_name'
                },
                {
                    data: 'barang_category',
                    name: 'barang_category'
                },
                {
                    data: 'stok',
                    name: 'stok'
                }
            ],
            order : [[0, 'asc']]
        });
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    });
    $(document).ready(function(){
        $("#btnstout").click(function(){
            $("#myModalstout").modal('show');

            var route ='{{ route("stok.auto_number_perm") }}';
            $.get(route, function (data) {
                document.getElementById('no_perm').value = data;
                    // $('#setdate').focus();
            });
        });
    });
    </script>

@endpush
