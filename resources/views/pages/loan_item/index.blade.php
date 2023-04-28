@extends('layouts.admin')
@section('title', 'E-Pinjam | MY HELPDESK')
{{-- @section('title-sub', 'Master Asset') --}}
{{-- @section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">DataTables</li>
</ol>
@endsection --}}
@section('content')


<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">E-PINJAM</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
            <div class="row mt-3">
                <div class="col-2">
                    <button type="button" class="btn btn-primary mb-3" id="addModal"><i class="fa fa-plus" ></i> Add Data</button>
                </div>
            </div>



            {{-- <div class="row" style="align:right">
                <button type="button" class="btn btn-primary mb-3" id="addModal" onclick="deactivenotpc()"><i class="fa fa-plus" ></i> Add Data</button>
            </div> --}}
            <table class="table table-hover w-full " id="loan_items_datatables" >
                <thead style="background-color: #0069D9; color: #fff;">
                    <tr class="text-center" >
                        <th style="width: 5%">No</th>
                        <th style="width: 10%">Name</th>
                        <th style="width: 10%">Section</th>
                        <th style="width: 10%">Contact</th>
                        <th style="width: 10%">Amount</th>
                        <th style="width: 20%">Purpose</th>
                        <th style="width: 15%">Date</th>
                        <th style="width: 15%">Return Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="body">

                </tbody>

            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>




@endsection
@include('pages.loan_item.modal.create')
@push('page-script')
{{-- @include('pages.master_asset.ajax') --}}
<script>
 $(document).ready(function(){
        //get data from datatables
        var table = $('#loan_items_datatables').DataTable({
            processing: true,
            serverSide: true,
            destroy:true,
            ajax: {
                url: "{{ route('epinjam.get_datatables') }}",
                type: "POST",
                'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            order: [
                [6, 'desc']
            ],
            responsive: true,
            columns: [
                {
                    title: '#',
                    name: 'no',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'section',
                    name: 'section'
                },
                {
                    data: 'contact',
                    name: 'contact'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'purpose',
                    name: 'purpose'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'return_date',
                    name: 'return_date'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    });
// ADDED NEW DATA
$(document).on('click', '#addModal', function (e) {
    // alert('ok');
    e.preventDefault();
    $('#createModalEpinjam').modal('show');
    $('.modal-title').text('Pinjam  Entry');
});

//  INSERT VIA AJAX
$('.modal-footer').on('click', '.saveCreate', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var name = $('#name_epinjam').val();
    var section = $('#section_epinjam').val();
    var contact = $('#contact_epinjam').val();
    var amount = $('#amount_epinjam').val();
    var purpose = $('#purpose_epinjam').val();
    var item = $('#item_name_epinjam').val();

    if (name != '') {
        if (section != '') {
            if (amount != '') {
                if (item != '') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                    url: "{{ route('epinjam.store') }}",
                    type: "POST",
                    data: $('#form-epinjam').serialize(),
                    success: function (data) {
                            if ($.isEmptyObject(data.error)) {
                                if (data.checkdata) {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: data.errors
                                    });
                                } else {
                                    clearvaluecreate();
                                    Swal.fire(
                                        'Successfully!',
                                        'Added New Data!',
                                        'success'
                                    ).then(function () {
                                        $('#createModalEpinjam').modal('hide');
                                        // document.location.reload();
                                        $('#loan_items_datatables').DataTable().ajax.reload();
                                    })
                                }
                            } else {
                                printErrorMsg(data.error)
                            }

                        }
                    });
                } else {
                    Swal.fire(
                    'Error!',
                    'Item Name Cannot Be Empty!',
                    'warning'
                    ).then(function () {
                        $('#item_name_epinjam').focus();
                    })
                }
            } else {
                Swal.fire(
                'Error!',
                'Amount Cannot Be Empty!',
                'warning'
                ).then(function () {
                    $('#amount_epinjam').focus();
                })
            }
        }else{
            Swal.fire(
            'Error!',
            'Section Cannot Be Empty!',
            'warning'
            ).then(function () {
                $('#section_epinjam').focus();
            })
        }
    }else{
        Swal.fire(
            'Error!',
            'Name Cannot Be Empty!',
            'warning'
        ).then(function () {
            $('#name_epinjam').focus();
        })
    }

})

function clearvaluecreate()
{
    $('#name_epinjam').val("");
    // $('#section_epinjam').val("");
    $("#section_epinjam").select2('val', '-Select Section-');
    $('#contact_epinjam').val("");
    $('#amount_epinjam').val("");
    $('#purpose_epinjam').val("");
    $('#item_name_epinjam').val("");

    // $("#section_epinjam option[selected]").prop('selected', true);
}

//  RETURN
$(document).on('click', '.return', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
         var id = $(this).attr('row-id');
         var item = $(this).attr('data-id');

            return_(id,item)

})
//RETURN
function return_(id, item){
    Swal.fire({
        title: 'Are you sure you return this item?',
        text: "Item Name :" + item,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Return this item!'
    }).
    then((willPosted) => {
        var route  = "{{ route('epinjam.return', ':id') }}";
        route  = route.replace(':id', id);
        if(willPosted.value){
            $.ajax({
                url: route,
                type: "POST",
                data : {
                    '_method' : 'POST'
                },
                success: function(data){
                    Swal.fire(
                        'Succesfully!',
                        'Item successfully returned!.',
                        'success',
                        ).then(function(){
                            // document.location.reload();
                            $('#loan_items_datatables').DataTable().ajax.reload();
                        });

                    },
                    error: function(){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: 'Error Contact IT department!',
                        })
                    }
                })
        } else {
            console.log(`data was dismissed by ${willPosted.dismiss}`);
        }


    })
}
</script>

@endpush
