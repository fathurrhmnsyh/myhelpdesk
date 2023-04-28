<div style="text-align: center; ">
    <div class="btn-group">
      <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-search"></i> 
      </button>
      <div class="dropdown-menu">
       <a href="#" style="color: black;" data-toggle="tooltip"  row-id="{{ $model->id_epinjam }}" data-id="{{ $model->item_name }}"  data-placement="top" title="Return Item" class="dropdown-item return"> <i class="fa fa-reply"></i> Return Item</a>
      </div>
    </div>
  </div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>