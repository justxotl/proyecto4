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
                if (response == "NotFound") {
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
    const uri = $("#uri").val();
    const cedula = document.getElementById("ciautor").value;
    if (cedula == "") {
        Swal.fire({
            position: "top-end",
            icon: "warning",
            title: "Y entonces?",
            showConfirmButton: false,
            timer: 3000,
        });
    }
    $.ajax({
        url: "register",
        method: "POST",
        data: $("#form_ficha").serialize(),
        success: function (response) {
            if (response == "Error en el servidor") {
                alert("Todo mal");
            } else {
                $("#form_ficha")[0].reset();
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Ficha y autores procesados correctamente.",
                    showConfirmButton: false,
                    timer: 3000,
                });
                setTimeout(() => {
                    window.location.href = uri;
                }, 1000);
            }
        },
    });
}

$(".card-tools").on("click", ".addRow", function () {
    let html = `
    <div class="row autor-item">
                            <div class="input-group mb-3 col-md-3">
                                <input type="text" name="ci_autor[]" maxlength="8"
                                    class="form-control cedulaBuscar" placeholder="CI del Autor"  required autofocus>

                                <div class="input-group-append">
                                    <div class="input-group-text" style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;">
                                        <span class="fas fa-id-card {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                            
                                    <span class="invalid-feedback" role="alert"></span>
                                
                            </div>
                            
                            <div class="input-group mb-3 col-md-3" id="nombreAutor">
                                <input type="text" name="nombre_autor[]"
                                    class="form-control nombreAutor" placeholder="Nombre del Autor" required>

                                <div class="input-group-append">
                                    <div class="input-group-text" style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                    <span class="invalid-feedback" role="alert"></span>
                            </div>


                            <div class="input-group mb-3 col-md-3" id="apellidoAutor">
                                <input type="text" name="apellido_autor[]" class="form-control apellidoAutor" placeholder="Apellido del Autor" required>

                                <div class="input-group-append">
                                    <div class="input-group-text" style="border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem;">
                                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                    </div>
                                </div>
                                    <span class="invalid-feedback" role="alert"></span>
                            </div>

                            <a href='javascript:void(0)' class=' col-md-3 mb-3 btn btn-danger deleteRow'><i class="fas fa-user-times"></i></a>                            

                    </div>
    `;
    $("#ficha_plus").append(html);
});

$(document).on("keyup", ".cedulaBuscar", function (e) {
    if (e.which == 13) {
        const autor = $(this).val();
        const row = $(this).closest(".autor-item");
        const nombreInput = row.find(".nombreAutor");
        const apellidoInput = row.find(".apellidoAutor");
        const baseUrl = $('meta[name="buscar-autor-url"]').attr("content");
        const url = baseUrl.replace(":id", autor);
        $.ajax({
            url: url,
            method: "GET",
            data: { id: autor },
            success: function (response) {
                if (response == "NotFound") {
                    document.getElementById("autorN").value = "";
                    document.getElementById("autorA").value = "";
                } else {
                    nombreInput.val(response.nombre_autor);
                    apellidoInput.val(response.apellido_autor);
                }
            },
        });
    }
});

$("#ficha_plus").on("click", ".deleteRow", function () {
    $(this).closest(".autor-item").remove();
});

function quitar(id, event) {
    event.preventDefault();
    Swal.fire({
        title: "¿Desea eliminar este registro?",
        icon: "question",
        showDenyButton: true,
        confirmButtonText: "Eliminar",
        confirmButtonColor: "#a5161d",
        denyButtonColor: "#270a0a",
        denyButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            const baseUrl = $('meta[name="quitar-autor-url"]').attr("content");
            const url = baseUrl.replace(":id", id);

            $.ajax({
                url: url,
                method: "DELETE", // Método HTTP DELETE
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"), // Token CSRF
                },
                success: function (response) {
                    Swal.fire("Eliminado", response.message, "success");
                    // Eliminar la fila del autor en la interfaz
                    $(`button[onclick="quitar(${id}, event)"]`)
                        .closest(".row")
                        .remove();
                },
                error: function (xhr) {
                    Swal.fire(
                        "Error",
                        "No se pudo eliminar el autor de la ficha.",
                        "error"
                    );
                },
            });
        }
    });
}
