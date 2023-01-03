const formEvaluador = document.querySelector("#form_evaluador");

const id_evaluador = document.querySelector("#id_evaluador");

const btnCancelar = document.querySelector("#btn_cancelar");
const btnEnviar = document.querySelector("#btn_enviar");

let tabla_evaluadores = "";

//URL PARA LA PETICION
const url = "../controllers/evaluador.controller.php";

//EVENTO PRINCIPAL CARGAR EVALUADORES
document.addEventListener("DOMContentLoaded", async () => {
  await getEvaluators();
});
btnCancelar.addEventListener("click", (e) => {
  e.preventDefault();
  clearForm();
});
// Click para enviar datos
btnEnviar.addEventListener("click", (e) => {
  e.preventDefault();
  saveEvaluator();
});
//LIMPIAR FORMULARIOS
const clearForm = () => {
  formEvaluador.id_evaluador.value = "";
  formEvaluador.nombres.value = "";
  formEvaluador.apellidos.value = "";
  formEvaluador.correo.value = "";
  formEvaluador.telefono.value = "";
};
//FUNCION PARA CARGAR LA INFORMACION
const getEvaluators = async () => {
  tabla_evaluadores = await $("#tabla_evaluadores").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      method: "GET",
      url: `${url}?accion=list`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "nombres" },
      { data: "apellidos" },
      { data: "telefono" },
      { data: "correo" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
            <button title="Editar" class="btn btn-primary btn-sm" onclick="getEvaluatorById(${data})"><i class="fas fa-edit"></i></button>
            <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteEvaluator(${data})"><i class="fas fa-trash-alt"></i></button>
          `;
        },
      },
    ],
    fnRowCallback: function (nRow) {
      $($(nRow).find("td")[4]).css("text-align", "center");
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

//GUARDAR EVALUADOR
const saveEvaluator = async () => {
  const accion = !id_evaluador.value
    ? `${url}?accion=create`
    : `${url}?accion=update`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formEvaluador),
  }).then((res) => res.json());

  if (success) {
    clearForm();
    tabla_evaluadores.ajax.reload();
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
};

//OBTENER UN REGISTRO
const getEvaluatorById = async (id) => {
  const { success, evaluador } = await fetch(`${url}?accion=get&id=${id}`).then(
    (res) => res.json()
  );
  if (success) {
    formEvaluador.id_evaluador.value = evaluador[0].id;
    formEvaluador.nombres.value = evaluador[0].nombres;
    formEvaluador.apellidos.value = evaluador[0].apellidos;
    formEvaluador.correo.value = evaluador[0].correo;
    formEvaluador.telefono.value = evaluador[0].telefono;
  } else {
    return alert("¡Error!", "¡No se pudo obtener el ámbito!", "error");
  }
};

const deleteEvaluator = async (id) => {
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
      tabla_evaluadores.ajax.reload();
      return alert("¡Exito!", mensaje, "success");
    } else {
      return alert("¡Error!", mensaje, "error");
    }
  }
};
