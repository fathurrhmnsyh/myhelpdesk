<div class="modal fade bd-example-modal-lg createModalEpinjam" style="z-index: 1041" tabindex="-1"
    id="createModalEpinjam" role="dialog" data-target="#TtfModalCreate" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog  modal-xl">
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
                        <form id="form-epinjam" method="post" action="javascript:void(0)">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="id_epinjam" name="id_epinjam">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name_epinjam" class="form-control" placeholder="Input Name">
                            </div>
                            <div class="form-group">
                                <label>Section</label>
                                <select class="form-control select2" name="section" id="section_epinjam" type="text"
                                    style="width: 100%;" data-default-value="">
                                    <option selected disabled>-Select Section-</option>
                                    @foreach($section as $section)
                                    <option value="{{$section->section}}">{{$section->section}}</option>
                                    @endforeach
                                </select>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" name="contact" id="contact_epinjam" class="form-control"
                                    placeholder="Input ext phone / others">
                            </div>
                            <div class="form-row">
                                <div class="col-6 mb-6">
                                    <div class="form-group">
                                        <label>Item Name / Nama Barang</label>
                                        <input type="text" name="item_name" id="item_name_epinjam" class="form-control"
                                            placeholder="Input Item Name">
                                    </div>
                                </div>
                                <div class="col-6 mb-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="number" name="amount" id="amount_epinjam" class="form-control"
                                            placeholder="Input Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Borrowing Purpose / Alasan Peminjaman</label>
                                <input type="text" name="purpose" id="purpose_epinjam" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="" class="btn btn-secondary "
                                    data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-info saveCreate"><i class="ti-check"></i>
                                    Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
