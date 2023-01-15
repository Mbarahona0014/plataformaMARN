// Obetener elementos del HTML por su ID
const formArea = document.querySelector("#form_area");
const idArea = document.querySelector("#id_area");
const btnCancelar = document.querySelector("#btn_cancelar");
const btnEnviar = document.querySelector("#btn_enviar");
// Variable para almacenar el DataTable
let tabla_areas = "";
// Url para realizar petición
const url = "../controlador/area.controller.php";
// Evento principal
document.addEventListener("DOMContentLoaded", async () => {
  await getAreas();
});
function alert(encabezado,mensaje,tipo){
  Swal.fire(
    encabezado,
    mensaje,
    tipo
  )
}
// Click para cancelar
btnCancelar.addEventListener("click", (e) => {
  e.preventDefault();
  clearForm();
});
// Click para enviar datos
btnEnviar.addEventListener("click", (e) => {
  e.preventDefault();
  saveArea();
});
// Función para limpiar formulario
const clearForm = () => {
  formArea.id_area.value = "";
  formArea.nombre.value = "";
  formArea.ubicacion.value = "";
  formArea.ext.value = "";
  formArea.desc.value = "";
  formArea.obser.value = "";
};
// Función para cargar la información
const getAreas = async () => {
  tabla_areas = await $("#tabla_areas").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${url}?accion=list`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "nombre" },
      { data: "ubicacion" },
      { data: "extension_terreno" },
      { data: "descripcion" },
      { data: "observaciones" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
          <button title="Editar" class="btn btn-primary btn-sm" onclick="getAreaById(${data})"><i class="fa fa-pencil"></i></button>
          <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteArea(${data})"><i class="fa fa-trash"></i></button>
          `;
        },
      },
    ],
    fnRowCallback: function (nRow) {
      $($(nRow).find("td")[5]).css("text-align", "center");
    },
    lengthMenu: [
      [5, 10, 15, 20, -1],
      [5, 10, 15, 20, "Todos"],
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });
};
// Función para guardar y actualizar un registro
const saveArea = async () => {
  const accion = !idArea.value
    ? `${url}?accion=create`
    : `${url}?accion=update`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formArea),
  }).then((res) => res.json());

  if (success) {
    clearForm();
    tabla_areas.ajax.reload();
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
};
// Función para obtener un registro
const getAreaById = async (id) => {
  const { success, area } = await fetch(`${url}?accion=get&id=${id}`).then(
    (res) => res.json()
  );

  if (success) {
    formArea.id_area.value = area[0].id;
    formArea.nombre.value = area[0].nombre;
    formArea.ubicacion.value = area[0].ubicacion;
    formArea.ext.value = area[0].extension_terreno;
    formArea.desc.value = area[0].descripcion;
    formArea.obser.value = area[0].observaciones;
  } else {
    return alert("¡Error!", "¡No se pudo obtener el ámbito!", "error");
  }
};
// Función para eliminar un registro
const deleteArea = async (id) => {
  const { isConfirmed } = await Swal.fire({
    title: "¿Seguro desea eliminar el registro?",
    text: "¡No podrá revertir la eliminación!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar",
    allowOutsideClick: false,
    heightAuto: false,
  });

  if (isConfirmed) {
    const { success, mensaje } = await fetch(
      `${url}?accion=delete&id=${id}`
    ).then((res) => res.json());

    if (success) {
      clearForm();
      tabla_areas.ajax.reload();
      return alert("¡Exito!", mensaje, "success");
    } else {
      return alert("¡Error!", mensaje, "error");
    }
  }
};
