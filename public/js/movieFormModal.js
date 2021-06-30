'use stric'

$(document).ready(function(){



//Insert ajax
    $("#insert").click(function(e){



        if ($("#form-data")[0].checkValidity()){



            e.preventDefault();


                var files = $('#image')[0].files[0];
                console.log(files)


                $("#form-data")[0][4].remove()
            $("#form-data")[0].append('image',files);

            console.log($("#form-data"))


            $.ajax({
                url: "ajax",
                type: "POST",
                data: $("#form-data").serialize()+"&action=insertMovie",
                success: function (response) {
                    console.log(this.data)
                    Swal.fire({
                        title:'Film ajoutée !',
                        icon: 'success'
                    })
                    $("#addModal").modal('hide');
                    $("#form-data")[0].reset();
                    // showAllBooking();
                }
            })
        }
    })

});
