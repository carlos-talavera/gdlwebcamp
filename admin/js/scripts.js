/* Establecer en las cabeceras que es una petición de tipo Fetch API */

const reqHeaders = new Headers({
    "X-CUSTOM-HEADER": "FetchAPIRequest",
});

/* Autocomplete off para todo input */

for(let i = 0; i < document.getElementsByTagName('input').length; i++) {

    document.getElementsByTagName('input')[i].setAttribute('autocomplete', 'off');

}

/* Botón de cancelar del formulario para editar */

if(document.getElementById('cancel-update')) {

    document.getElementById('cancel-update').addEventListener('click', function (e) {

        e.preventDefault();

        const tipo = this.getAttribute("data-tipo");

        window.location.href = "lista-" + tipo + ".php";

    });

}

function administradores() {

    const url = "modelo-admin.php";

    function validacion_password(contra, spanError) {

        contra.addEventListener('focus', function () {

            if(this.value.length === 0) {

                spanError.innerHTML = "La contraseña debe contener al menos 8 caracteres";
                spanError.style.display = "block";
                this.parentNode.classList.add('has-error');

            }

            contra.addEventListener('input', function () {

                if(this.id === "new_pass" && this.value.length > 7) {

                    let verif = true;

                    const passAntigua = document.getElementById('old_pass');

                    if(passAntigua.parentNode.classList.contains('has-error')) {

                        verif = false;

                    }

                    if(verif && passAntigua.value === this.value) {

                        spanError.innerHTML = "La contraseña no puede ser la misma que la anterior";

                    } else {

                        spanError.style.display = "none";
                        this.parentNode.classList.remove('has-error');
                        this.parentNode.classList.add('has-success');

                    }

                }

                else if(this.id === "password" && this.value.length > 7) {

                    const repContra = document.getElementById('password_rep');
                    const spanErrorRepContra = document.getElementById('valid_pass_rep');

                    if(this.value === repContra.value) {

                        spanErrorRepContra.innerHTML = "Las contraseñas coinciden";
                        spanErrorRepContra.style.display = "block";
                        repContra.parentNode.classList.remove('has-error');
                        repContra.parentNode.classList.add('has-success');
                        spanErrorRepContra.style.display = "none";

                    } else {

                        repContra.parentNode.classList.remove('has-success');
                        repContra.parentNode.classList.add('has-error');
                        spanErrorRepContra.innerHTML = "Las contraseñas no coinciden";
                        spanErrorRepContra.style.display = "block";
                        spanError.style.display = "none";
                        this.parentNode.classList.remove('has-error');
                        this.parentNode.classList.add('has-success');

                    }

                }

                else if(this.value.length < 8) {

                    spanError.innerHTML = "La contraseña debe contener al menos 8 caracteres";
                    spanError.style.display = "block";
                    this.parentNode.classList.add('has-error');

                } else {

                    spanError.style.display = "none";
                    this.parentNode.classList.remove('has-error');
                    this.parentNode.classList.add('has-success');

                }

            });

        });

        contra.addEventListener('blur', function () {

            if(document.getElementById('old_pass')) {

                const passAntigua = document.getElementById('old_pass');

                if(this.value === passAntigua.value) {

                    spanError.innerHTML = "La contraseña no puede ser la misma que la anterior";
                    spanError.style.display = "block";
                    this.parentNode.classList.add('has-error');

                }

            }

            if(document.getElementById('password_rep')) {

                const repContraDiv = document.getElementById('password_rep').parentNode;
                repContraDiv.classList.remove('has-success');

            }

            this.parentNode.classList.remove('has-success');

        });

    }

    function validacion_usuario(usuario, spanError) {

        spanError.innerHTML = "El usuario debe contener al menos 5 caracteres";

        usuario.addEventListener('input', function () {

            spanError.innerHTML = "El usuario debe contener al menos 5 caracteres";

            if (this.value.length === 0) {

                spanError.style.display = "block";
                this.parentNode.classList.add('has-error');

            }

            else if (this.value.length < 5) {

                spanError.style.display = "block";
                this.parentNode.classList.add('has-error');

            }

            else if (this.value.length > 15) {

                spanError.innerHTML = "El usuario puede contener máximo 15 caracteres";
                spanError.style.display = "block";
                usuario.parentNode.classList.add('has-error');
                usuario.parentNode.classList.remove('has-success');

            } else {

                spanError.style.display = "none";
                this.parentNode.classList.remove('has-error');

                if(this.value === this.defaultValue) {

                    this.parentNode.classList.add('has-success');

                } else {

                    let datos = new FormData();
                    datos.append('accion', 'validar');
                    datos.append('extra', 'userDuplicado');
                    datos.append('usuario', this.value);

                    fetch(url, {
                        method: 'POST',
                        headers: reqHeaders,
                        body: datos
                    }).then(respuesta => {
                        return respuesta.json();
                    }).then(datos => validar(datos));

                    function validar(datos) {

                        let { status } = datos;
                        spanError.innerHTML = "Elige otro usuario";

                        if (status === "duplicado") {

                            spanError.style.display = "block";
                            usuario.parentNode.classList.add('has-error');

                        } else {

                            spanError.style.display = "none";
                            usuario.parentNode.classList.remove('has-error');
                            usuario.parentNode.classList.add('has-success');

                        }

                    }

                }

            }

        });

        usuario.addEventListener('blur', function () {

            this.parentNode.classList.remove('has-success');

        });

    }

    /* Crear administrador */

    if(document.getElementById('crear-admin')) {

        const formulario = document.getElementById('crear-admin');
        const btnAgregarAdmin = document.getElementById('agregar-admin');
        const usuario = document.getElementById('user');
        const contra = document.getElementById('password');
        const repContra = document.getElementById('password_rep');
        const spanErrorContra = document.getElementById('valid_pass');
        const spanErrorUser = document.getElementById('user_error');
        const spanErrorRepContra = document.getElementById('valid_pass_rep');

        btnAgregarAdmin.setAttribute('disabled', true);

        texto_files();
        validacion_password(contra, spanErrorContra);
        validacion_usuario(usuario, spanErrorUser);

        repContra.addEventListener('input', function() {

            spanErrorRepContra.innerHTML = "La contraseña debe contener al menos 8 caracteres";

            if(this.value.length < 8) {

                spanErrorRepContra.style.display = "block";
                contra.parentNode.classList.add('has-error');
                this.parentNode.classList.add('has-error');

            } else {

                if(this.value === contra.value) {

                    spanErrorRepContra.innerHTML = "Las contraseñas coinciden";
                    contra.parentNode.classList.remove('has-error');
                    contra.parentNode.classList.add('has-success');
                    this.parentNode.classList.remove('has-error');
                    this.parentNode.classList.add('has-success');

                } else {

                    spanErrorRepContra.innerHTML = "Las contraseñas no coinciden";
                    contra.parentNode.classList.remove('has-success');
                    contra.parentNode.classList.add('has-error');
                    this.parentNode.classList.remove('has-success');
                    this.parentNode.classList.add('has-error');

                }

            }

        });

        repContra.addEventListener('blur', function() {

            if(this.parentNode.classList.contains('has-success')) {

                spanErrorRepContra.style.display = "none";

            }

            contra.parentNode.classList.remove('has-success');
            this.parentNode.classList.remove('has-success');

        });

        formulario.addEventListener('change', function() {

            let verifErrores = false;

            for (let i = 0; i < document.getElementsByTagName('input').length; i++) {

                let input = document.getElementsByTagName('input')[i];

                if (input.type === "file") {

                    if (input.files.length === 0) {

                        verifErrores = true;
                        break;

                    }

                } else {

                    if (input.value === null || document.getElementsByClassName('has-error').length > 0) {

                        verifErrores = true;
                        btnAgregarAdmin.setAttribute('disabled', true);
                        break;

                    }

                }

            }

            if(!verifErrores) {

                btnAgregarAdmin.removeAttribute('disabled');
                btnAgregarAdmin.addEventListener('click', crearAdmin);

            }

        });

        function crearAdmin(e) {

            e.preventDefault();

            const usuario = document.getElementById('user').value;
            const nombre = document.getElementById('nombre').value;
            const password = document.getElementById('password').value;
            const foto = document.getElementById('inputFile').files;

            if(usuario.trim() === "" || password.trim() === "" || nombre.trim() === "" || foto.length === 0) {

                swal({
                    type: 'error',
                    title: 'Campos vacíos',
                    text: 'Todos los campos son obligatorios'
                })

            } else {

                const datos = new FormData();
                datos.append('accion', 'crear');
                datos.append('usuario', usuario);
                datos.append('nombre', nombre);
                datos.append('password', password);

                for(let i = 0; i < foto.length; i++) {

                    let file = foto[i];

                    datos.append('inputFile[]', file);

                }

                fetch(url, {
                    method: 'POST',
                    headers: reqHeaders,
                    body: datos
                }).then(respuesta => {
                    return respuesta.json();
                }).then(datos => validar(datos));

                function validar(datos) {

                    const {status} = datos;

                    if(status === "OK") {

                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Administrador creado correctamente'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "lista-admin.php";
                            }
                        });

                    } else {

                        swal({
                            type: 'error',
                            title: 'Error',
                            text: status
                        });

                    }

                }
                    
            }
                
        }
    }

    /* Loguear administrador */

    if(document.getElementById('login-admin')) {

        let formLogin = document.getElementById('login-admin');

        formLogin.addEventListener('submit', loguear);

        function loguear(e) {

            e.preventDefault();

            const urlLogin = 'loguear-admin.php';
            const usuario = document.getElementById('usuario').value;
            const password = document.getElementById('password').value;
            const returnURL = document.getElementById('returnURL').value;
            
            let datos = new FormData();
            datos.append('accion', 'loguear');
            datos.append('usuario', usuario);
            datos.append('pass', password);

            fetch(urlLogin, {
                method: 'POST',
                headers: reqHeaders,
                body: datos
            }).then(respuesta => {
                return respuesta.json();
            }).then(usuario => ingresar(usuario));

            function ingresar(usuario) {

                let {status} = usuario;
                let {user} = usuario;

                if (status === "OK") {

                    swal({
                        type: 'success',
                        title: 'Correcto',
                        text: 'Bienvenid@ ' + user,
                        showConfirmButton: false
                    })

                    setTimeout(function() {

                        if(returnURL !== "") {

                            window.location.href = returnURL;

                        } else {

                            window.location.href = "dashboard.php";

                        }

                    }, 2000)

                } else {

                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Datos incorrectos'
                    });

                }

            }

        }

    }

    /* Editar administrador */

    if(document.getElementById('editar-admin')) {

        const btnAct = document.getElementById('btnActAdm');
        const checkSwitch = document.getElementById('switch');
        const id = document.getElementById('id_admin').value;
        let nombre = document.getElementById('nombre').value;
        const nombreInput = document.getElementById('nombre');
        const usuarioInput = document.getElementById('user');
        let usuario = document.getElementById('user').value;
        const spanUsuario = document.getElementById('user_valid');
        const id_admin = document.getElementById('id_admin').value;
        const nivelInput = document.getElementById('nivel');
        let nivel = document.getElementById('nivel').value;

        const passAntigua = document.getElementById('old_pass');
        const passNueva = document.getElementById('new_pass');
        const spanAntigua = document.getElementById('old_pass_valid');
        const spanNueva = document.getElementById('new_pass_valid');

        checkSwitch.addEventListener('click', function() {

            $('.passwords').slideToggle(); // Sweet jQuery

        });

        nombreInput.addEventListener('input', function() {

            nombre = nombreInput.value;

        });

        usuarioInput.addEventListener('input', function() {

            usuario = usuarioInput.value;

        });

        nivelInput.addEventListener('change', function() {

            nivel = nivelInput.value;

        });
        
        passAntigua.addEventListener('input', function() {

            if(this.value.length < 8) {

                this.parentNode.classList.add('has-error');
                spanAntigua.innerHTML = "La contraseña debe tener al menos 8 caracteres";
                spanAntigua.style.display = "block";
                passNueva.readOnly = true;

            } else {

                let datos = new FormData();
                datos.append('accion', 'validar');
                datos.append('extra', 'passIguales');
                datos.append('id', id);
                datos.append('pass', passAntigua.value);

                fetch(url, {
                    method: 'POST',
                    headers: reqHeaders,
                    body: datos
                }).then(respuesta => {
                    return respuesta.json();
                }).then(json => validar(json));

                function validar(json) {

                    passAntigua.parentNode.classList.remove('has-error');
                    passAntigua.parentNode.classList.remove('has-success');

                    let {validacion} = json;

                    if(validacion === "Iguales") {

                        passAntigua.parentNode.classList.add('has-success');
                        spanAntigua.innerHTML = "Las contraseñas coinciden";
                        spanAntigua.style.display = "block";
                        passNueva.readOnly = false;
                        validacion_password(passNueva, spanNueva);

                    } else {

                        passAntigua.parentNode.classList.add('has-error');
                        spanAntigua.innerHTML = "Las contraseñas no coinciden";
                        spanAntigua.style.display = "block";
                        passNueva.readOnly = true;

                    }

                }

            }

        });

        passAntigua.addEventListener('blur', function() {

            spanAntigua.style.display = "none";
            this.parentNode.classList.remove('has-success');

        });

        texto_files();
        validacion_usuario(usuarioInput, spanUsuario);

        btnAct.addEventListener('click', editar);

        function editar(e) {

            e.preventDefault();

            const foto = document.getElementById('inputFile').files;
            
            if(document.getElementsByClassName('has-error').length > 0) {

                swal({
                    type: 'error',
                    title: 'Error',
                    text: 'Todos los campos son obligatorios'
                })

            } else {

                let datos = new FormData();
                datos.append('accion', 'actualizar');
                datos.append('id', id_admin);
                datos.append('usuario', usuario);
                datos.append('nombre', nombre);
                datos.append('nivel', nivel);

                if(passAntigua.value.trim() !== "" && passNueva.value.trim() !== "") {

                    datos.append('passNueva', passNueva.value);

                }

                if(foto.length > 0) {
                
                    for (let i = 0; i < foto.length; i++) {

                        let file = foto[i];

                        datos.append('inputFile[]', file);

                    }

                }

                fetch(url, {
                    method: 'POST',
                    headers: reqHeaders,
                    body: datos
                }).then(resultados => {
                    return resultados.json();
                }).then(edicion => validar(edicion));

                function validar(edicion) {

                    let {status} = edicion;
                    let incorrecto = "";

                    for(i in edicion) {

                        if(edicion[i] !== "OK") {

                            incorrecto = edicion[i]; 

                        }

                    }

                    if(incorrecto === "") {

                        swal({
                            type: 'success',
                            title: 'Edición correcta',
                            text: 'Se ha actualizado correctamente la información del administrador'
                        }).then(function() {
                                window.location.href = "lista-admin.php";
                            }
                        )

                    } else {

                        swal({
                            type: 'error',
                            title: 'Error',
                            text: status
                        })

                    }

                }

            }
        
        }

    }

}

function eventos() {

    const url = "modelo-evento.php";

    function valid_eventos(btnEnviar) {

        btnEnviar.setAttribute('disabled', true);

        const evento = document.getElementById('nombre_evento');
        const spanEvt = document.getElementById('valid_evt');
        let valorEvt;
        let valorFecha;
        let valorHora;
        let valorCat;
        let valorInv;

        evento.addEventListener('input', function () {

            valorEvt = this.value;

            if (valorEvt.length < 7) {

                spanEvt.innerHTML = "El evento debe contener mínimo 7 caracteres";
                spanEvt.style.display = "block";
                this.parentNode.classList.remove('has-success');
                this.parentNode.classList.add('has-error');

            } else {

                if(btnEnviar.id === "crear") {

                    let datos = new FormData();
                    datos.append('accion', 'validar');
                    datos.append('nombre', valorEvt);

                    fetch(url, {
                        method: 'POST',
                        headers: reqHeaders,
                        body: datos
                    }).then(respuesta => {
                        return respuesta.json();
                    }).then(resultado => verificar(resultado));

                    function verificar(resultado) {

                        let { status } = resultado;

                        if (status === "duplicado") {

                            spanEvt.innerHTML = "Ya existe tal evento, nómbrelo de otra forma";
                            spanEvt.style.display = "block";
                            evento.parentNode.classList.remove('has-success');
                            evento.parentNode.classList.add('has-error');

                        } else {

                            spanEvt.style.display = "none";
                            evento.parentNode.classList.remove('has-error');
                            evento.parentNode.classList.add('has-success');

                        }

                    }

                } else {

                    spanEvt.style.display = "none";
                    evento.parentNode.classList.remove('has-error');
                    evento.parentNode.classList.add('has-success');

                }

            }

        });

        evento.addEventListener('blur', function () {

            this.parentNode.classList.remove('has-success');

        });

        /* Datepicker */

        $('#fecha').datepicker({
            autoclose: true,
            language: 'es',
            format: 'yyyy/mm/dd'
        });

        $('#fecha').datepicker().on('changeDate', function () {

            valorFecha = $(this).val();

        });

        /* Timepicker */

        $('#hora').timepicker({
            showInputs: false,
            defaultTime: false
        });

        $('#hora').timepicker().on('changeTime.timepicker', function () {

            valorHora = $(this).val();

        });

        /* Select2 */

        $('.seleccionar').select2();

        $('.seleccionar.categoria').select2().on('change', function () {

            valorCat = $(this).val();

        });

        $('.seleccionar.invitado').select2().on('change', function () {

            valorInv = $(this).val();

        });

        if(btnEnviar.id === 'btnActEvt') {

            valorEvt = evento.value;
            valorFecha = $('#fecha').val();
            valorHora = $('#hora').val();
            valorCat = $('.seleccionar.categoria').val();
            valorInv = $('.seleccionar.invitado').val();

        }

        $('form').on('keyup change paste', 'input, select, textarea', function () {

            let verif = false;
            let verif2 = false;

            $('input[type="text"].valores').each(function () {

                if ($(this).val() !== null && $(this).val().trim() !== "") {

                    verif = true;

                } else {

                    verif = false;
                    return false; // El break del $().each

                }

            });

            $('select').each(function () {

                if ($(this).val() !== null && $(this).val() !== "0") {

                    verif2 = true;

                } else {

                    verif2 = false;
                    return false;

                }

            });

            if (verif && verif2) {

                if ($('#hora').val().length >= 7 && $('.has-error').length === 0) {

                    btnEnviar.removeAttribute('disabled');
                    btnEnviar.addEventListener('click', accionEvento);

                } else {

                    btnEnviar.setAttribute('disabled', true);

                }

            } else {

                btnEnviar.setAttribute('disabled', true);

            }

        });

        function accionEvento(e) {

            e.preventDefault();

            let datos = new FormData();

            if(btnEnviar.id === "agregar-evento") {
                
                datos.append('accion', 'crear');

            } else {

                const id = document.getElementById('id_evt').value;
                datos.append('accion', 'actualizar');
                datos.append('id', id);

            }

            datos.append('nombre', valorEvt);
            datos.append('fecha', valorFecha);
            datos.append('hora', valorHora);
            datos.append('categoria', valorCat);
            datos.append('invitado', valorInv);

            fetch(url, {
                method: 'POST',
                headers: reqHeaders,
                body: datos
            }).then(respuesta => {
                return respuesta.json();
            }).then(evento => validar(evento));

            function validar(evento) {

                let { status } = evento;
                let { accion } = evento;

                if (status === "Correcto") {

                    if(accion === "crear") {

                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Se ha creado correctamente el evento'
                        })

                    } else {

                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Se ha actualizado correctamente la información del evento'
                        }).then(function() {
                                window.location.href = "lista-evento.php";
                            }
                        );

                    }

                } else {

                    if(accion === "crear") {

                        swal({
                            type: 'error',
                            title: 'Error',
                            text: 'No se ha podido crear el evento'
                        })

                    } else {

                        swal({
                            type: 'error',
                            title: 'Error',
                            text: 'No se ha podido actualizar la información del evento'
                        })

                    }

                }

            }

        }

    }

    /* Crear evento */

    if(document.getElementById('crear-evento')) {

        const btnAgregarEvento = document.getElementById('agregar-evento');

        valid_eventos(btnAgregarEvento);

    }

    /* Editar evento */

    if(document.getElementById('editar-evento')) {

        const btnEditarEvento = document.getElementById('btnActEvt');

        valid_eventos(btnEditarEvento);

    }

}

function categorias() {

    const url = "modelo-categoria.php";

    function valid_categorias(btnEnviar) {

        btnEnviar.setAttribute('disabled', true);

        const nombreCat = document.getElementById('nombre_cat');
        let valorNombreCat = nombreCat.value;
        let valorIcono = $('#icono').val();

        nombreCat.addEventListener('input', function() {

            valorNombreCat = this.value;
            const validCat = document.getElementById('valid_cat');

            if(valorNombreCat.length < 8) {

                validCat.innerHTML = "El nombre de la categoría debe contener por lo menos 8 caracteres";
                validCat.parentNode.classList.remove('has-success');
                validCat.parentNode.classList.add('has-error');
                validCat.style.display = "block";

            } else {

                let datos = new FormData();
                datos.append('accion', 'validar');
                datos.append('categoria', valorNombreCat);

                fetch(url, {
                    method: 'POST',
                    headers: reqHeaders,
                    body: datos
                }).then(respuesta => {
                    return respuesta.json();
                }).then(resultado => validacion(resultado))

                function validacion(resultado) {

                    let {status} = resultado;

                    if(status === "Duplicado") {

                        validCat.innerHTML = "Ya existe una categoría con ese nombre";
                        agg_rem_class(validCat, 0);
                        validCat.style.display = "block";

                    } else {

                        validCat.style.display = "none";
                        agg_rem_class(validCat, 1);

                    }

                }
            }

        });

        nombreCat.addEventListener('blur', function() {

            this.parentNode.classList.remove('has-success');

        });

        $('#icono').iconpicker({
            templates: {
                search: '<input type="search" class="form-control iconpicker-search" placeholder="Escribe para filtrar">'
            }
        });

        $('#icono').iconpicker().on('iconpickerSelected', function() {

            valorIcono = $(this).val();

            if(valorNombreCat !== "") {
                
                btnEnviar.removeAttribute('disabled');
                btnEnviar.addEventListener('click', accionEvento);

            }

        });

        $('form').on('keyup change paste', 'input, select, textarea', function() {

            if(document.getElementsByClassName('has-error').length === 0 && valorIcono !== undefined && $('#icono').val() !== "") {

                btnEnviar.removeAttribute('disabled');

            } else {

                btnEnviar.setAttribute('disabled', true);

            }

        });

        function accionEvento(e) {

            e.preventDefault();

            let datos = new FormData();

            if(btnEnviar.id === "agregar-categoria") {
                
                datos.append('accion', 'crear');

            } else {

                let id = document.getElementById('id_cat_evento').value;
                datos.append('accion', 'actualizar');
                datos.append('id', id);

            }

            datos.append('categoria', valorNombreCat);
            datos.append('icono', valorIcono);

            fetch(url, {
                method: 'POST',
                headers: reqHeaders,
                body: datos
            }).then(respuesta => {
                return respuesta.json();
            }).then(resultado => validar(resultado))

            function validar(resultado) {

                let {status} = resultado;
                let {accion} = resultado;

                if(status === "Correcto") {

                    if(accion === "crear") {

                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Se ha creado correctamente la categoría del evento'
                        }).then(function() {
                                window.location.href = "lista-categoria.php";
                            }
                        )

                    } 
                    
                    else if(accion === "actualizar") {

                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Se ha actualizado correctamente la categoría del evento'
                        }).then(function() {
                                window.location.href = "lista-categoria.php";
                            }
                        )

                    }

                } else {

                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error'
                    })

                }

            }

        }

    }

    /* Crear una categoría */

    if(document.getElementById('crear-categoria')) {

        const btnCrearCat = document.getElementById('agregar-categoria');
        valid_categorias(btnCrearCat);

    }

    /* Editar una categoría */

    if(document.getElementById('editar-categoria')) {

        const btnActCat = document.getElementById('btnActCat');
        valid_categorias(btnActCat);

    }

}

function invitados() {

    const url = "modelo-invitado.php";

    function valid_invitados(btnEnviar) {

        let valorNombre = document.getElementById('nombre_inv').value;
        let valorApellido = document.getElementById('ape_inv').value;
        let valorDesc = document.getElementById('descripcion').value;
        let completos;
        const foto = document.getElementById('inputFile');

        btnEnviar.setAttribute('disabled', true);

        texto_files();

        for(let i = 0; i < document.getElementsByClassName('form-control').length; i++) {

            let verif;
            let num_car;

            document.getElementsByClassName('form-control')[i].addEventListener('input', function() {

                if(this.value.trim() === "") {

                    verif = "vacío";
                    agg_rem_class(this, 0);

                } 
                
                else if(this.value.length < 20 && this.id === "descripcion") {

                    verif = "menor";
                    num_car = 20;
                    agg_rem_class(this, 0);

                }
                
                else if(this.value.length < 4 && this.id !== "descripcion") {

                    verif = "menor";
                    num_car = 4;
                    agg_rem_class(this, 0);

                } else {

                    verif = "correcto";
                    this.parentNode.children[2].style.display = "none";
                    agg_rem_class(this, 1);

                }

                if(verif === "correcto") {

                    if(this.id === 'nombre_inv') {

                        valorNombre = this.value;

                    }

                    else if(this.id === 'ape_inv') {

                        valorApellido = this.value;

                    }

                    else if(this.id === 'descripcion') {

                        valorDesc = this.value;

                    }

                    if(valorNombre.trim() !== "" && valorApellido.trim() !== "" && valorDesc.trim() !== "") {

                        completos = true;
                        
                    }

                }
                
                else if(verif === "vacío") {

                    completos = false;
                    this.parentNode.children[2].innerHTML = "El campo no puede estar vacío";
                    this.parentNode.children[2].style.display = "block";

                } 
                
                else if(verif === "menor") {

                    completos = false;
                    this.parentNode.children[2].innerHTML = "El campo debe contener mínimo " + num_car + " caracteres";
                    this.parentNode.children[2].style.display = "block";

                }

            });

            document.getElementsByClassName('form-control')[i].addEventListener('blur', function () {

                this.parentNode.classList.remove('has-success');

            });

        }

        if(btnEnviar.id === "agregar-invitado") {

            $('#crear-invitado').on('keyup change paste', 'input, select, textarea', function() {

                if(completos && document.getElementsByClassName('has-error').length === 0 && foto.files.length > 0) {

                    btnEnviar.removeAttribute('disabled');
                    btnEnviar.addEventListener('click', accionEvento);

                } else {

                    btnEnviar.setAttribute('disabled', true);

                }

            });

        } else {

            completos = true;

            $('#editar-invitado').on('keyup change paste', 'input, select, textarea', function () {

                if(completos && document.getElementsByClassName('has-error').length === 0) {

                    btnEnviar.removeAttribute('disabled');
                    btnEnviar.addEventListener('click', accionEvento);

                } else {

                    btnEnviar.setAttribute('disabled', true);

                }

            });

        }

        function accionEvento(e) {

            e.preventDefault();

            let datos = new FormData();

            if(this.id === 'agregar-invitado') {

                datos.append('accion', 'crear');

            } else {

                const id = document.getElementById('id_invitado').value;

                datos.append('accion', 'actualizar');
                datos.append('id', id);

            }

            datos.append('nombre', valorNombre);
            datos.append('apellido', valorApellido);
            datos.append('descripcion', valorDesc);
            
            for(let j = 0; j < foto.files.length; j++) {

                let file = foto.files[j];

                datos.append('inputFile[]', file);

            }

            fetch(url, {
                method: 'POST',
                headers: reqHeaders,
                body: datos
            }).then(respuesta => {
                return respuesta.json();
            }).then(resultado => validar(resultado));

            function validar(resultado) {

                let {status} = resultado;
                let {accion} = resultado;

                if(status === "Correcto") {

                    if(accion === "crear") {

                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Se ha agregado correctamente el invitado'
                        }).then(function() {
                                window.location.href = "lista-invitado.php";
                            }
                        )

                    }

                    else if(accion === "actualizar") {

                        if(resultado.hasOwnProperty('status2')) {

                            let {status2} = resultado;

                            if(status2 === "Correcto") {

                                swal({
                                    type: 'success',
                                    title: 'Correcto',
                                    text: 'Se ha actualizado correctamente el invitado'
                                }).then(function() {
                                        window.location.href = "lista-invitado.php";
                                    }
                                )

                            } else {

                                swal({
                                    type: 'error',
                                    title: 'Error',
                                    text: status2
                                })

                            }

                        } else {

                            swal({
                                type: 'success',
                                title: 'Correcto',
                                text: 'Se ha actualizado correctamente el invitado'
                            }).then(function () {
                                window.location.href = "lista-invitado.php";
                            }
                            )

                        }

                    }

                } else {

                    swal({
                        type: 'error',
                        title: 'Error',
                        text: status
                    })

                }

            }

        }

    }

    /* Crear un invitado */

    if(document.getElementById('crear-invitado')) {

        const btnCrear = document.getElementById('agregar-invitado');
        valid_invitados(btnCrear);

    }

    /* Editar un invitado */

    if(document.getElementById('editar-invitado')) {

        const btnActInv = document.getElementById('btnActInv');
        valid_invitados(btnActInv);

    }

}

function usuarios() {

    function valid_usuarios(btnEnviar) {

        const url = "modelo-usuario.php";

        let valorRegalo = 0, valorPagado = -1;

        $('#regalos_crear').select2();

        $('#regalos_crear').select2().on('change', function() {

            valorRegalo = parseInt($(this).val());

        });

        $('#select_pagado').select2();

        $('#select_pagado').select2().on('change', function () {

            valorPagado = parseInt($(this).val());

        });

        const pases = document.getElementsByClassName('pase');
        const num_pases = document.getElementsByClassName('num_pases');
        const btnTipoPass = document.getElementById('btnTipoPass');
        
        let cantidadDias;
        
        let articulosTotales = {};

        const extras = document.getElementsByClassName('extra');
        const num_extras = document.getElementsByClassName('num_extras');
        const btnTipoExt = document.getElementById('btnTipoExt');

        const divsDias = document.getElementsByClassName('contenido-dia');
        const btnVerEvt = document.getElementById('btnVerEvt');
        const btnAnterior = document.getElementsByClassName('btn-arrow-slider')[0];
        const btnSiguiente = document.getElementsByClassName('btn-arrow-slider')[1];

        btnEnviar.setAttribute('disabled', true);
        btnVerEvt.setAttribute('disabled', true);

        if(btnEnviar.id === 'btnActReg') {

            valorRegalo = parseInt(document.getElementById('regalos_crear').value);
            valorPagado = parseInt(document.getElementById('select_pagado').value);

            articulosTotales = {

                un_dia: (num_pases[0].value !== '0') ? parseInt(num_pases[0].value) : undefined,
                pase_completo: (num_pases[1].value !== '0') ? parseInt(num_pases[1].value) : undefined,
                dos_dias: (num_pases[2].value !== '0') ? parseInt(num_pases[2].value) : undefined,
                camisas: (num_extras[0].value !== '0') ? parseInt(num_extras[0].value) : undefined,
                etiquetas: (num_extras[1].value !== '0') ? parseInt(num_extras[1].value) : undefined

            };

            for(let n in articulosTotales) {

                if(articulosTotales[n] === undefined) {

                    delete articulosTotales[n];

                }

            }

            cantidadBoletos();

            btnVerEvt.removeAttribute('disabled');

        }

        function cantidadBoletos() {

            if (articulosTotales.un_dia > 0 && articulosTotales.dos_dias === undefined && articulosTotales.pase_completo === undefined) {

                cantidadDias = 1;

            }

            else if (articulosTotales.dos_dias > 0 && articulosTotales.pase_completo === undefined) {

                cantidadDias = 2;

            }

            else if (articulosTotales.pase_completo > 0) {

                cantidadDias = 3;

            }

            modalEventos();

        }

        function actPassExt(articulos, num_art, btnTipo) {

            for(let i = 0; i < articulos.length; i++) {

                articulos[i].addEventListener('click', function() {

                    for(let j = 0; j < articulos.length; j++) {

                        let data_tipo = this.getAttribute('data-tipo');
                        num_art[j].style.display = "none";
                        btnTipo.innerHTML = data_tipo + ` <span class="fa fa-caret-down"></span>`;
                        
                        if(num_art[j].getAttribute('data-tipo') === data_tipo) {

                            num_art[j].style.display = "inline-block";
                            num_art[j].focus();

                        }

                        num_art[j].addEventListener('change', function() {

                            if(num_art[j].classList.contains('num_pases')) {

                                cantidadDias = 0;

                                if(this.getAttribute('data-tipo') === 'Pase de un día') {

                                    if(parseInt(this.value) > 0) {

                                        articulosTotales.un_dia = parseInt(this.value);

                                    } else {

                                        delete articulosTotales.un_dia;

                                    }

                                }

                                else if(this.getAttribute('data-tipo') === 'Pase completo') {

                                    if (parseInt(this.value) > 0) {

                                        articulosTotales.pase_completo = parseInt(this.value);

                                    } else {

                                        delete articulosTotales.pase_completo;

                                    }

                                }
                                    
                                else if(this.getAttribute('data-tipo') === 'Pase de dos días') {

                                    if (parseInt(this.value) > 0) {

                                        articulosTotales.dos_dias = parseInt(this.value);

                                    } else {

                                        delete articulosTotales.dos_dias;

                                    }

                                }

                                if (articulosTotales.un_dia > 0 || articulosTotales.dos_dias > 0 || articulosTotales.pase_completo > 0) {

                                    btnVerEvt.removeAttribute('disabled');

                                } else {

                                    btnVerEvt.setAttribute('disabled', true);

                                }

                                cantidadBoletos();

                            }

                            else if (num_art[j].classList.contains('num_extras')) {

                                if (this.getAttribute('data-tipo') === 'Camisa') {

                                    if (parseInt(this.value) > 0) {

                                        articulosTotales.camisas = parseInt(this.value);

                                    } else {

                                        delete articulosTotales.camisas;

                                    }

                                }

                                else if (this.getAttribute('data-tipo') === 'Paquete de etiquetas') {

                                    if (parseInt(this.value) > 0) {

                                        articulosTotales.etiquetas = parseInt(this.value);

                                    } else {

                                        delete articulosTotales.etiquetas;

                                    }

                                }

                            }

                        });

                    }

                });

            }

        }

        function modalEventos() {

            if(document.getElementById('selectEvt')) {

                for(let x = 0; x < divsDias.length; x++) {

                    divsDias[x].classList.remove('disponible');
                    divsDias[x].style.display = "none";

                }

                divsDias[0].style.display = "block";
                divsDias[0].classList.add('disponible');
                btnAnterior.style.display = "none";

                if (cantidadDias === 1) {

                    btnSiguiente.style.display = "none";

                } else {

                    btnSiguiente.style.display = "inline-block";

                }

            }

        }

        function btnAntSig() {

            btnAnterior.addEventListener('click', function () {

                btnSiguiente.style.display = "inline-block";

                for (let i = 0; i < cantidadDias; i++) {

                    if (divsDias[i].style.display === "block") {

                        if((i - 1) === 0) {

                            btnAnterior.style.display = "none";

                        }

                        divsDias[i].style.display = "none";

                        $('.contenido-dia[data-posicion="' + i + '"]').fadeIn('slow');

                        break;

                    }

                }

            });

            btnSiguiente.addEventListener('click', function () {

                btnAnterior.style.display = "inline-block";

                for (let j = 0; j < cantidadDias; j++) {

                    divsDias[j].classList.add('disponible');

                    if (divsDias[j].style.display === "block") {

                        divsDias[j + 1].classList.add('disponible');

                        if ((j + 2) === cantidadDias) {

                            btnSiguiente.style.display = "none";

                        }

                        divsDias[j].style.display = "none";

                        $('.contenido-dia[data-posicion="' + (j + 2) + '"]').fadeIn('slow');

                        break;

                    }

                }

            });

        }

        function validaciones() {

            const nombreInput = document.getElementById('nombre_reg');
            const apellidoInput = document.getElementById('ape_reg');
            const emailInput = document.getElementById('email_reg');
            
            let valorNombre = nombreInput.value;
            let valorApellido = apellidoInput.value;
            let valorEmail = emailInput.value;
            let verif;

            nombreInput.addEventListener('input', function() {

                const spanErr = document.getElementById('valid_nom_reg');
                valorNombre = this.value;

                if(valorNombre.length < 4) {

                    spanErr.innerHTML = "El nombre debe contener por lo menos 4 caracteres";
                    spanErr.style.display = "block";
                    agg_rem_class(this, 0);

                } else {

                    spanErr.style.display = "none";
                    agg_rem_class(this, 1);

                }
                
            });

            apellidoInput.addEventListener('input', function() {

                const spanErr = document.getElementById('valid_ape_reg');
                valorApellido = this.value;

                if (valorApellido.length < 4) {

                    spanErr.innerHTML = "El apellido debe contener por lo menos 4 caracteres";
                    spanErr.style.display = "block";
                    agg_rem_class(this, 0);

                } else {

                    spanErr.style.display = "none";
                    agg_rem_class(this, 1);

                }

            });

            emailInput.addEventListener('input', function() {

                const spanErr = document.getElementById('valid_email_reg');
                valorEmail = this.value;

                function esEmail(email) {

                    return /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/.test(email);
                }

                if(!esEmail(valorEmail)) {

                    spanErr.innerHTML = "Ingresa un email válido";
                    spanErr.style.display = "block";
                    agg_rem_class(this, 0);

                } else {

                    let formEmail = new FormData();
                    formEmail.append('accion', 'validarEmail');
                    formEmail.append('email', valorEmail);

                    fetch(url, {
                        method: 'POST',
                        headers: reqHeaders,
                        body: formEmail
                    }).then(respuesta => {
                        return respuesta.json();
                    }).then(resultado => validarEmail(resultado));

                    function validarEmail(resultado) {

                        let {status} = resultado;

                        if(status === 'Duplicado') {

                            spanErr.innerHTML = "El email ya se encuentra registrado, ingresa otro";
                            spanErr.style.display = "block";
                            agg_rem_class(emailInput, 0);

                        } else {

                            spanErr.style.display = "none";
                            agg_rem_class(emailInput, 1);

                        }

                    }

                }

            });

            for(let y = 0; y < document.getElementsByClassName('input-evt-blur').length; y++) {

                document.getElementsByClassName('input-evt-blur')[y].addEventListener('blur', function() {

                    this.parentNode.classList.remove('has-success');

                });

            }

            $('form').on('keyup change paste', 'input, select, textarea', function () {

                if($('.has-error').length > 0 || btnVerEvt.getAttribute('disabled') || valorRegalo === 0 || valorPagado === -1 || articulosTotales.camisas === 0 || articulosTotales.etiquetas === 0 || valorNombre.length < 1 || valorApellido.length < 1 || valorEmail.length < 1) {

                    verif = false;

                } else {

                    verif = true;

                }

                if(verif) {

                    btnEnviar.removeAttribute('disabled');
                    btnEnviar.addEventListener('click', accionEvento);

                } else {

                    btnEnviar.setAttribute('disabled', true);

                }

            });

            function accionEvento(e) {

                e.preventDefault();

                let totalAPagar = (articulosTotales.un_dia * 30 || 0) + (articulosTotales.pase_completo * 50 || 0) + (articulosTotales.dos_dias * 45 || 0) + (articulosTotales.camisas * 10 * 0.93) + (articulosTotales.etiquetas * 2);

                if(btnEnviar.id === 'btnActReg') {

                    swal({
                        type: 'warning',
                        title: 'Total',
                        text: 'El total es de $' + totalAPagar + ' ¿Estás seguro de que deseas editar el usuario?',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Agregar',
                        cancelButtonText: 'Cancelar'
                    }).then(function () {
                        modificarUsuario();
                    }).catch(function () {

                    });

                } else {

                    swal({
                        type: 'warning',
                        title: 'Total',
                        text: 'El total es de $' + totalAPagar + ' ¿Estás seguro de que deseas agregar el usuario?',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Agregar',
                        cancelButtonText: 'Cancelar'
                    }).then(function() {
                        modificarUsuario();
                    }).catch(function() {
                        
                    });

                }

                function modificarUsuario() {

                    const checks = document.getElementsByName('registro[]');
                    let datos = new FormData();

                    if(btnEnviar.id === 'btnActReg') {

                        const id = document.getElementById('id_reg').value;

                        datos.append('accion', 'actualizar');
                        datos.append('id', id);

                    } else {
                    
                        datos.append('accion', 'crear');
                    
                    }

                    datos.append('nombre', valorNombre);
                    datos.append('apellido', valorApellido);
                    datos.append('email', valorEmail);
                    datos.append('articulos', JSON.stringify(articulosTotales));
                    datos.append('regalo', valorRegalo);
                    datos.append('total', totalAPagar);

                    for(let c = 0; c < checks.length; c++) {

                        if(checks[c].parentNode.parentNode.parentNode.parentNode.classList.contains('disponible')) {

                            if(checks[c].checked) {

                                datos.append("registro[eventos][]", checks[c].value);

                            }

                        }

                    }

                    datos.append('pagado', valorPagado);

                    fetch(url, {
                        method: 'POST',
                        headers: reqHeaders,
                        body: datos
                    }).then(respuesta => {
                        return respuesta.json();
                    }).then(resultado => validar(resultado));

                    function validar(resultado) {

                        let {status} = resultado;
                        let {accion} = resultado;

                        if(status === 'Correcto') {

                            if(accion === 'crear') {

                                swal({
                                    type: 'success',
                                    title: 'Correcto',
                                    text: 'Se ha creado correctamente un nuevo usuario'
                                }).then(function() {
                                    window.location.href = "lista-usuario.php";
                                });

                            }

                            else if(accion === 'actualizar') {

                                swal({
                                    type: 'success',
                                    title: 'Correcto',
                                    text: 'Se ha actualizado correctamente la información del usuario'
                                }).then(function () {
                                    window.location.href = "lista-usuario.php";
                                });

                            }

                        } else {

                            swal({
                                type: 'error',
                                title: 'Error',
                                text: status
                            })

                        }

                    }

                }

            }

        }

        actPassExt(pases, num_pases, btnTipoPass);
        actPassExt(extras, num_extras, btnTipoExt);
        btnAntSig();
        validaciones();

    }

    /* Crear un usuario */

    if(document.getElementById('crear-usuario')) {

        const btnCrearReg = document.getElementById('agregar-usuario');
        valid_usuarios(btnCrearReg);

    }

    /* Editar un usuario */

    if(document.getElementById('editar-usuario')) {

        const btnActReg = document.getElementById('btnActReg');
        valid_usuarios(btnActReg);

    }

}

/* Eliminar un registro */

if (document.getElementsByClassName('borrar_registro').length > 0) {

    const btnBorrar = document.getElementsByClassName('borrar_registro');

    for (let i = 0; i < btnBorrar.length; i++) {

        btnBorrar[i].addEventListener('click', function (e) {

            e.preventDefault();

            swal({
                title: '¿Estás seguro?',
                text: "Un registro eliminado no se puede recuperar",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then(function() {
                    eliminarRegistro(btnBorrar[i]);
                }
            ).catch(function() {

            });

            function eliminarRegistro(btnBorrar) {

                let url;
                const id = btnBorrar.getAttribute('data-id');
                const tipo = btnBorrar.getAttribute('data-tipo');
                const datos = new FormData();
                datos.append('accion', 'eliminar');
                datos.append('id', id);

                url = "modelo-" + tipo + ".php";

                fetch(url, {
                    method: 'POST',
                    headers: reqHeaders,
                    body: datos
                }).then(respuesta => {
                    return respuesta.json();
                }).then(resultado => notificar(resultado))

                function notificar(resultado) {

                    let { status } = resultado;

                    if (status === "Correcto") {

                        let { id_eliminado } = resultado;

                        swal({
                            type: 'success',
                            title: 'Correcto',
                            text: 'Registro eliminado correctamente'
                        }).then(function() {
                                $('[data-id="' + id_eliminado + '"]').parents('tr').remove();
                            }
                        )

                    } else {

                        swal({
                            type: 'error',
                            title: 'Error',
                            text: 'No se ha podido eliminar el registro'
                        })

                    }

                }

            }

        });

    }

}

/* Actualizar el texto con el nombre del archivo en el botón para subir la foto de perfil */

function texto_files() {

    const inputFoto = document.getElementById('inputFile');
    const spanUpload = document.getElementsByClassName('upload-text')[0];

    inputFoto.addEventListener('change', function () {

        if(this.files.length > 0) {

            spanUpload.innerHTML = this.files[0].name;

        } else {

            spanUpload.innerHTML = "Subir un archivo";

        }

    });

}

/* Agregar y quitar clases del padre del input */

function agg_rem_class(elemento, bicaso) {

    if(bicaso === 0) {

        elemento.parentNode.classList.remove('has-success');
        elemento.parentNode.classList.add('has-error');

    }
    
    else if(bicaso === 1) {

        elemento.parentNode.classList.remove('has-error');
        elemento.parentNode.classList.add('has-success');

    } else { /* Por si el coder se equivoca al pasar los parámetros */

        swal({
            type: 'error',
            title: 'La regaste',
            text: 'Ni modo bro :3'
        })

    }

}

administradores();
eventos();
categorias();
invitados();
usuarios();