<div class="modal fade-out bd-example-modal-lg itemModal"  tabindex="-1" id="itemModal"  role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <p style="font-size: 20px">Select Item</p>
          <b><font color="red">Double click to select data</font></b>
        </div>
        <div class="row">
         <div class="col">
          <div class="modal-body">
            <div class="datatable datatable-primary">
                <input type="text" id="row-clicked" value="" readonly hidden>
                <table id="lookUpdataItem" class="table table-striped table-bordered table-hover" width="100%" >
                    <thead >
                        {{-- style="background-color: #D3D3D3" --}}
                        <tr class="text-center">
                            <th>Item Name</th>
                            <th>Type</th>
                        </tr>

                    </thead>
                    <tbody>
                    </tbody>
                </table>  
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>