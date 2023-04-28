@extends('layouts.admin')
@section('title', 'Search Eriwayat | MY HELPDESK')
@section('title-sub', 'Search Eriwayat ')
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="">Eticket</a></li>
    <li class="breadcrumb-item ">ERiwayat</li>
    <li class="breadcrumb-item active">Search result</li>
</ol>
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-hover dataTable table-striped w-full" id="example1" data-plugin="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode FA</th>
                        <th>Date</th>
                        <th>Issue</th>
                        <th>Problem</th>
                        <th>Solution</th>
                        <th>Replacement Part</th>
                        <th>Technician</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        $no = 1;
        ?>
                    @foreach($eticket as $f)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$f->id_kode_fa}}</td>
                        <td>{{$f->date}}</td>
                        <td>{{$f->issue}}</td>
                        <td>{{$f->problem}}</td>
                        <td>{{$f->solution}}</td>
                        <td>{{$f->rep_part}}</td>
                        <td>{{$f->technician}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-12">
                <br>
                <input class="btn btn-warning" action="action" onclick="window.history.go(-1); return false;"
                    type="submit" value="Cancel" />
                <a href="/eriwayat/print/{{$f->id_asset}}/{{$f->id_kode_fa}}" type="button" target="_blank" class="btn btn-success mb-3"><i
                        class="fa fa-print"></i> Print</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>





@endsection
