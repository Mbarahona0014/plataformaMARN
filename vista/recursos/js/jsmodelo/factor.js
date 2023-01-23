// Obetener elementos del HTML por su ID
const formFactor = document.querySelector("#form_factor");
const idFactor = document.querySelector("#id_factor");
const btnCancelar = document.querySelector("#btn_cancelar");
const btnEnviar = document.querySelector("#btn_enviar");
// Variable para almacenar el DataTable
let tabla_factores = "";
// Url para realizar petición
const url = "../controlador/factor.controller.php";
// Evento principal
document.addEventListener("DOMContentLoaded", async () => {
  await getFactors();
});

function alert(encabezado, mensaje, tipo) {
  Swal.fire(encabezado, mensaje, tipo);
}
// Click para cancelar
btnCancelar.addEventListener("click", (e) => {
  e.preventDefault();
  clearForm();
});
// Click para enviar datos
btnEnviar.addEventListener("click", (e) => {
  e.preventDefault();
  saveFactor();
});
// Función para limpiar formulario
const clearForm = () => {
  formFactor.id_factor.value = "";
  formFactor.nombre.value = "";
  formFactor.peso.value = "";
};
// Función para cargar la información
const getFactors = async () => {
  tabla_factores = await $("#tabla_factores").DataTable({
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
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
          <button title="Editar" class="btn btn-primary btn-sm" onclick="getFactorById(${data})"><i class="fa fa-pencil"></i></button>
          <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteFactor(${data})"><i class="fa fa-trash"></i></button>
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
const saveFactor = async () => {
  const accion = !idFactor.value
    ? `${url}?accion=create`
    : `${url}?accion=update`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formFactor),
  }).then((res) => res.json());

  if (success) {
    clearForm();
    tabla_factores.ajax.reload();
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
};
// Función para obtener un registro
const getFactorById = async (id) => {
  const { success, factor } = await fetch(`${url}?accion=get&id=${id}`).then(
    (res) => res.json()
  );

  if (success) {
    formFactor.id_factor.value = factor[0].id;
    formFactor.nombre.value = factor[0].nombre;
    formFactor.peso.value = factor[0].peso;
  } else {
    return alert("¡Error!", "¡No se pudo obtener el ámbito!", "error");
  }
};
// Función para eliminar un registro
const deleteFactor = async (id) => {
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
      tabla_factores.ajax.reload();
      return alert("¡Exito!", mensaje, "success");
    } else {
      return alert("¡Error!", mensaje, "error");
    }
  }
};
