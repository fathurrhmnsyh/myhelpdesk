<div class="modal fade bd-example-modal-lg stoutModal" style="z-index: 1041" tabindex="-1" id="stoutModal" role="dialog"
    data-target="#TtfModalCreate" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col">
                    <div class="modal-body create_modal">
                        <form id="form-stout" method="post" action="javascript:void(0)">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="id_stout" name="id_stout">
                            <div class="form-row">
                                <div class="col-6 mb-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="hidden" name="input_by" class="form-control"
                                            value="{{auth()->user()->name}}">
                                        <input type="date" name="date" id="date1" class="form-control"
                                            value="<?php echo date('Y-m-d');?>" readonly>
                                    </div>
                                </div>
                                <div class="col-6 mb-6">
                                    <div class="form-group">
                                        <label>No Permintaan</label>
                                        <input type="text" name="no_perm" id="no_perm" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Input Name">
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <select class="form-control select2" name="section" id="section" type="text" style="width: 100%;">
                                    <option value="">-select section-</option>
                                    @foreach($section as $section)
                                    <option value="{{$section->section}}">{{$section->section}}</option>
                                     @endforeach</select>
                                </select>
                                {{-- <input type="text" name="section" id="section" class="form-control"
                                    value="{{auth()->user()->section}}" readonly> --}}
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="datatable datatable-primary">
                                        <div class="table-responsive">
                                            <table id="tbl-pickup-cons" class="table table-bordered table-hover"
                                                width="100%">
                                                {{-- style="background-color: #D3D3D3" --}}
                                                <thead class="text-center">
                                                    <tr>
                                                        <th width="2%">No</th>
                                                        <th width="76%">Barang Name</th>
                                                        <th width="20%">Quantity</th>
                                                        <th width="2%">
                                                            {{-- ACTION --}}
                                                            <!-- <button type="button" data-toggle="tooltip"
                                                                data-placement="top" title="Add Item"
                                                                class="btn btn-danger btn-xs" id="addRow2"> <i
                                                                    class="fa fa-plus"></i></button> -->
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="body">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" data-toggle="tooltip"  data-placement="top" title="Add Item" class="btn btn-info" id="addRow"> Add Item</button> --}}

                                <button type="button" data-toggle="tooltip"  data-placement="top" title="Add Item" class="btn btn-info" id="addRow2"><i class="fa fa-plus"></i> Add Item</button>
                                <button type="button" onclick="clear_value_create_page_ss()" class="btn btn-secondary "
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success savePickup"><i class="ti-check"></i>
                                    Save</button>

                                {{-- @php $counter @endphp --}}
                                <input type="hidden" id="jml_row" name="jml_row" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
