// Obetener elementos del HTML por su ID
const formAmbito = document.querySelector("#form_ambito");
const idAmbito = document.querySelector("#id_ambito");
const btnCancelar = document.querySelector("#btn_cancelar");
const btnEnviar = document.querySelector("#btn_enviar");
// Variable para almacenar el DataTable
let tabla_ambitos = "";
// Url para realizar petición
const url = "../controlador/ambito.controller.php";
// Evento principal
document.addEventListener("DOMContentLoaded", async () => {
  await getScopes();
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
  saveScope();
});
// Función para limpiar formulario
const clearForm = () => {
  formAmbito.id_ambito.value = "";
  formAmbito.nombre.value = "";
  formAmbito.peso.value = "";
  formAmbito.desc.value = "";
};
// Función para cargar la información
const getScopes = async () => {
  tabla_ambitos = await $("#tabla_ambitos").DataTable({
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
      { data: "peso" },
      { data: "descripcion" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
          <button title="Editar" class="btn btn-primary btn-sm" onclick="getScopeById(${data})"><i class="fa fa-pencil"></i></button>
          <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteScope(${data})"><i class="fa fa-trash"></i></button>
          `;
        },
      },
    ],
    fnRowCallback: function (nRow) {
      $($(nRow).find("td")[2]).css("text-align", "center");
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
const saveScope = async () => {
  const accion = !idAmbito.value
    ? `${url}?accion=create`
    : `${url}?accion=update`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formAmbito),
  }).then((res) => res.json());

  if (success) {
    clearForm();
    tabla_ambitos.ajax.reload();
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
};
// Función para obtener un registro
const getScopeById = async (id) => {
  const { success, ambito } = await fetch(`${url}?accion=get&id=${id}`).then(
    (res) => res.json()
  );

  if (success) {
    formAmbito.scrollIntoView({block: "end", behavior: "smooth"});
    formAmbito.id_ambito.value = ambito[0].id;
    formAmbito.nombre.value = ambito[0].nombre;
    formAmbito.peso.value = ambito[0].peso;
    formAmbito.desc.value = ambito[0].descripcion;
  } else {
    return alert("¡Error!", "¡No se pudo obtener el ámbito!", "error");
  }
};
// Función para eliminar un registro
const deleteScope = async (id) => {
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
      tabla_ambitos.ajax.reload();
      return alert("¡Exito!", mensaje, "success");
    } else {
      return alert("¡Error!", mensaje, "error");
    }
  }
};
