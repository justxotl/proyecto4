function buscarAutor(event) {
    event.preventDefault();
    if (event.which == 13) {
        const autor = document.getElementById("ciautor").value;
        $.ajax({
            url: "" + autor + "/get",
            method: "GET",
            data: { id: autor },
            success: function (response) {
                console.log(response);
                if (response == 'NotFound') {
                    document.getElementById("nombreAutor").style.visibility =
                        "visible";
                    document.getElementById("apellidoAutor").style.visibility =
                        "visible";
                    document.getElementById("titleFicha").style.visibility =
                        "visible";
                    document.getElementById("fechaTrabajo").style.visibility =
                        "visible";
                    document.getElementById("carreraTrabajo").style.visibility =
                        "visible";
                    document.getElementById("resumenTrabajo").style.visibility =
                        "visible";
                } else {
                    document.getElementById("nombreAutor").style.visibility =
                        "visible";
                    document.getElementById("autorN").value =
                        response.nombre_autor;
                    document.getElementById("apellidoAutor").style.visibility =
                        "visible";
                    document.getElementById("autorA").value =
                        response.apellido_autor;
                    document.getElementById("titleFicha").style.visibility =
                        "visible";
                    document.getElementById("fechaTrabajo").style.visibility =
                        "visible";
                    document.getElementById("carreraTrabajo").style.visibility =
                        "visible";
                    document.getElementById("resumenTrabajo").style.visibility =
                        "visible";
                }
            },
        });
    }
}

function registrarAutor(event) {
    event.preventDefault();
    const cedula = document.getElementById('ciautor').value
    if (cedula == '') {
        Swal.fire({
            position: "top-end",
            icon: "warning",
            title: "Y entonces?",
            showConfirmButton: false,
            timer: 3000
        });
    }
    $.ajax({
        url: 'register',
        method: 'POST',
        data: $('#form_ficha').serialize(),
        success: function (response) {
            if (response == 'Error en el servidor') {
                alert('Todo mal')
            } else {
                $('#form_ficha')[0].reset();
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Ficha y autores procesados correctamente.",
                    showConfirmButton: false,
                    timer: 3000
                })
                setTimeout(() => {
                    window.location.href = '/laravel/biblio/public/admin/fichas';
                }, 1000);
            }
        }
    });

}

$(".card-tools").on("click", ".addRow", function () {
    let html = `
    <div class="row autor-item">
                            <div class="input-group mb-3 col-md-4">
                                <input type="text" name="ci_autor[]"
                                    class="form-control cedulaBuscar" placeholder="CI del Autor" id="ciautor" required autofocus>

                                <div class="input-group-append">
                                    <div class="input-group-text" style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;">
                                        <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            
                                    <span class="invalid-feedback" role="alert"></span>
                                
                            </div>
                            

                            <div class="input-group mb-3 col-md-4" id="nombreAutor">
                                <input type="text" name="nombre_autor[]"
                                    class="form-control nombreAutor" placeholder="Nombre del Autor" id="autorN" required>

                                <div class="input-group-append">
                                    <div class="input-group-text" style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                    <span class="invalid-feedback" role="alert"></span>
                            </div>


                            <div class="input-group mb-3 col-md-4" id="apellidoAutor">
                                <input type="text" name="apellido_autor[]" class="form-control apellidoAutor" placeholder="Apellido del Autor" id="autorA" required>

                                <div class="input-group-append">
                                    <div class="input-group-text" style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                    <span class="invalid-feedback" role="alert"></span>
                            </div>
                    </div>
    `
    $('#ficha_plus').append(html)
});
$(document).on('keyup', '.cedulaBuscar', function (e) {
    if(e.which == 13){
        const autor = $(this).val();
        const row = $(this).closest('.autor-item');
        const nombreInput = row.find('.nombreAutor');
        const apellidoInput = row.find('.apellidoAutor');
        $.ajax({
            url: "" + autor + "/get",
            method: "GET",
            data: { id: autor },
            success: function (response) {
                if (response == 'NotFound') {
                    document.getElementById("autorN").value =
                        '';
                    document.getElementById("autorA").value =
                        '';
                } else {
                    nombreInput.val(response.nombre_autor);
                    apellidoInput.val(response.apellido_autor);
                }
            },
        });
    }
});
