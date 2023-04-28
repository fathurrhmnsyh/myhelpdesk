@extends('layouts.admin')
@section('title', 'Computer Data | ITCS')
@section('title-sub', 'Computer Data')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="">IT Asset</a></li>
    <li class="breadcrumb-item ">Database</li>
    <li class="breadcrumb-item active">Computer</li>
</ol>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <a href="/komputer/add" type="button" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add Data</a>
            <a href="/komputer/print_all" type="button" class="btn btn-success mb-3" target="_blank"><i
                    class="fa fa-print"></i>
                Print Data</a>
            <a href="/komputer/export_excel" type="button" class="btn btn-success mb-3" target="_blank"><i
                    class="fa fa-file"></i>
                Export File</a>

            <br><br>
            <table class="table table-hover dataTable table-striped w-full" id="myTable" data-plugin="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode FA</th>
                        <th>Processor</th>
                        <th>Mainboard</th>
                        <th>RAM Info</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
      $no = 1;
      ?>
                    @foreach($komputer as $k)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$k->kode_fa}}</td>
                        <td>{{$k->p_merk}} {{$k->p_jenis}} {{$k->p_tipe}}</td>
                        <td>{{$k->m_merk}} {{$k->m_tipe}}</td>
                        <td>{{$k->r_kapasitas}} GB {{$k->r_tipe}} {{$k->r_slot}} Channel </td>
                        <td>
                            <a href="/komputer/detail/{{$k->id}}" class="btn-sm btn-info"><i class="fa fa-bars"></i>
                                Detail</a>
                            <a class="btn-sm btn-danger" onclick="return confirm('Deleted Data Cant Be Recovered!')"
                                href="/komputer/delete/{{$k->id}}"> <i class="fa fa-trash"> Delete</i></a>


                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>



@endsection
