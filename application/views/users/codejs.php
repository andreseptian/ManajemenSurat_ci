 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="post" class="form form-inline" action="<?= site_url('users/setunit');?>">

      <div class="modal-body">
            <div class="form-group">
              <label>Pilih Unit</label>
              <select class="form-control" name="id_unit" id="id_unit">
                <?php foreach ($unit as $key => $value) :?>
                  <option value="<?= $value->id_unit;?>"><?= $value->nama_unit;?></option>
                <?php endforeach;?>
              </select>
              <input type="hidden" name="id_user" id="id_user">
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Pilih</button>
      </div>
      </form>
    </div>
  </div>
</div>

   <script type="text/javascript">
                 $("#mytable").DataTable(

                 );
                 function confirmdelete(linkdelete) {
              alertify.confirm("Apakah anda yakin akan  menghapus data tersebut?", function() {
                location.href = linkdelete;
              }, function() {
                alertify.error("Penghapusan data dibatalkan.");
              });
              $(".ajs-header").html("Konfirmasi");
              return false;
            }

            function setunit(id){
              $('#id_user').val(id);
              $("#exampleModal").modal();
              return false;
            }
        </script>
