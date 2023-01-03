// Elementos HTML
const formLogin = document.getElementById("form-login");
const btnEnviar = document.getElementById("btn-login");
// URL GLOBAL
const url = "../controlador/usuario.controller.php?accion=login";
// Función para validar el formulario de login
const verifyUser = () => {
    const usuario = formLogin.user.value;
    const constrasena = formLogin.pass.value;
    // Validar que los campos no estén vacíos
    if (usuario == "" || constrasena == "") {
        return alert("¡Error!", "¡Todos los campos son obligatorios!", "error");
    }
    // Barra de progreso
    const barra = document.querySelector(".progress-bar");
    let width = 0;
    btnEnviar.disabled = true;
    let progress = setInterval(async () => {
        if (width == 100) {
            // Limpiar el intervalo
            btnEnviar.disabled = false;
            clearInterval(progress);
            $(".progress").hide(250);
            barra.textContent = "0%";
            barra.style.width = "0%";
            // Enviar los datos al servidor
            const { status, mensaje } = await fetch(url, {
                method: "POST",
                body: new FormData(formLogin),
            }).then((res) => res.json());
            if (!status) {
                return alert("¡Error!", mensaje, "error");
            } else {
                alert("¡Bienvenido!", mensaje, "success");
                setTimeout(() => {
                    window.location.reload();
                }, 2500);
            }
        } else {
            // Aumentar el progreso de la barra
            $(".progress").show(250);
            width += 25;
            barra.textContent = width + "%";
            barra.style.width = width + "%";
        }
    }, 700);
};
btnEnviar.addEventListener("click", (e) => {
    e.preventDefault();
    verifyUser();
});
