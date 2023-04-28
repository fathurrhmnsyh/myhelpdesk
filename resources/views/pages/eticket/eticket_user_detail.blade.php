@extends('layouts.admin')
@section('title', 'Eticket | MyHelpdesk')
{{-- @section('title-sub', 'Eticket') --}}
@section('breadcrumb')
{{-- <ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/">IT Asset</a></li>
    <li class="breadcrumb-item ">Database</li>
    <li class="breadcrumb-item active">Printer</li>
</ol> --}}
@endsection

@section('content')

<div class="col-12">
    <div class="card">
        {{method_field('PUT')}}
        <div class="card-header">
            <h3 class="card-title">Detail Ticket</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12">
                            <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm"
                                        src="{{url('backend/dist/img/user1-128x128.jpg')}}" alt="user image">
                                    <span class="username">
                                        <a href="#">{{$eticket->name}}</a>
                                    </span>
                                    <span class="description">{{$eticket->section}} - {{$eticket->nik}}</span>
                                </div>
                                <!-- /.user-block -->
                                <span style="color: #0066FF">ISSUE</span>
                                <p>
                                    {{$eticket->issue}}
                                </p>
                                <hr>
                                <span style="color: #0066FF">PROBLEM</span>
                                <p>
                                    {{$eticket->problem}}
                                </p>
                                <hr>
                                <span style="color: #0066FF ">SOLUTION</span>
                                <p>
                                    @if ($eticket->solution == "")
                                    -
                                    @else
                                    {{$eticket->solution}}
                                    @endif
                                </p>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <p><strong>Ticket No :</strong></p>
                    <h3 class="text-primary">{{$eticket->ticket_no}}</h3>
                    <br>
                    <div class="text-muted">
                        <p class="text-sm">Date
                            <b class="d-block">{{$eticket->date}}</b>
                        </p>
                        <p class="text-sm">Time
                            <b class="d-block">{{$eticket->time}}</b>
                        </p>
                    </div>

                    <h5 class="mt-5 text-muted"></h5>
                    <table class="text-muted">
                        <tr>
                            <td>Problem Type</td>
                            <td>&nbsp;: 
                                @if ($eticket->problem_type == "")
                                -
                                @else
                                {{$eticket->problem_type}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Replacement Part</td>
                            <td>&nbsp;:
                                @if ($eticket->rep_part == "")
                                -
                                @else
                                {{$eticket->rep_part}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                            @if ($eticket->status == "1")
                                &nbsp;: <span class="badge bg-info">Open</span>
                            @elseif($eticket->status == "2")
                                &nbsp;: <span class="badge bg-warning">On Process</span>
                            @elseif($eticket->status == "3")
                                &nbsp;: <span class="badge bg-danger">Pending</span>
                            @elseif($eticket->status == "4")
                                &nbsp;: <span class="badge bg-success">Close</span>
                            @endif
                            </td>
                            
                        </tr>
                    </table>
                    <div class="mt-5 mb-3">
                        <a href="#" class="btn btn-sm btn-warning" onclick="window.history.go(-1); return false;">Back</a>
                        {{-- <a href="/eticket/edit/{{$eticket->id}}" class="btn btn-sm btn-info">Edit</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>


@endsection
