/* // Elementos del HTML
const btnSalir = document.getElementById("btn-logout");
// Evento principal
document.addEventListener("DOMContentLoaded", () => {
  activeMenu();
});
// Función de alertas
const alert = (title, text, icon) => {
  Swal.fire({
    title: `${title}`,
    text: `${text}`,
    icon: `${icon}`,
    showConfirmButton: false,
    timer: 1500,
    allowOutsideClick: false,
    heightAuto: false,
  });
};
// Función cerrar sesión
const logout = async () => {
  const url = "../controllers/usuario.controller.php?accion=logout";
  const { status, mensaje } = await fetch(url).then((res) => res.json());
  if (!status) {
    return alert("¡Error!", mensaje, "error");
  } else {
    alert("¡Hasta pronto!", mensaje, "info");
    setTimeout(() => {
      window.location.reload();
    }, 2500);
  }
};
// Evento Click
btnSalir.addEventListener("click", () => {
  logout();
});
// Active menu
const activeMenu = () => {
  const path = window.location.href;
  const pathArray = path.split("/");
  const lastPath = pathArray[pathArray.length - 1];
  $(`.tab-${lastPath}`).addClass("active");
};
 */