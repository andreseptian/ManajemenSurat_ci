<script>
    function confirmaction(action, linkdelete) {
        alertify.defaults.theme.input = "form-control";
        if(action == "Reject"){
             alertify.prompt( 'Konfirmasi Reject', 'Keterangan', 'Keterangan'
               , function(evt, value) { 
                    $.ajax({
                    url: linkdelete+'/'+value,
                    type: "get",
                    success: function (response) {
                        if (response == true) {
                          ''//  location.reload();
                        }
                        console.log(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
                    
                }
               , function() { alertify.error('Cancel') });

        }else{
            alertify.confirm("Apakah anda yakin akan  "+action+" data tersebut?", function() {
                location.href = linkdelete;
            }, function() {
                alertify.error("Penghapusan data dibatalkan.");
            });
        }
        $(".ajs-header").html("Konfirmasi");
        return false;
    }
    $(':checkbox[name=selectall]').click(function () {
        $(':checkbox[name=id]').prop('checked', this.checked);
    });

    $("#formbulk").on("submit", function () {
        var rowsel = [];
        $.each($("input[name='id']:checked"), function () {
            rowsel.push($(this).val());
        });
        if (rowsel.join(",") == "") {
            alertify.alert('', 'Tidak ada data terpilih!', function () {});

        } else {
            var prompt = alertify.confirm('Apakah anda yakin akan menghapus data tersebut?',
                'Apakah anda yakin akan menghapus data tersebut?').set('labels', {
                ok: 'Yakin',
                cancel: 'Batal!'
            }).set('onok', function (closeEvent) {

                $.ajax({
                    url: "suratmasukunit/deletebulk",
                    type: "post",
                    data: "msg = " + rowsel.join(","),
                    success: function (response) {
                        if (response == true) {
                            location.reload();
                        }
                        //console.log(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            });
            $(".ajs-header").html("Konfirmasi");
        }
        return false;
    });
     
    
</script>