// Obetener elementos del HTML por su ID
const formTema = document.querySelector("#form_tema");
const formPuntaje = document.querySelector("#form_puntaje");

const temaSubs = document.querySelector("#temaSubs");
const iconSubs = document.querySelector("#iconSubs");

const idTema = document.querySelector("#id_tema");
const idPuntaje = document.querySelector("#id_puntaje");

const btnCancelar = document.querySelector("#btn_cancelar");
const btnEnviar = document.querySelector("#btn_enviar");
const btnEnviarPuntaje = document.querySelector("#btn_enviar_puntaje");

const selectPuntaje = document.querySelector("#pts");

// Variable para almacenar el DataTable
let tabla_temas = "";

// Url para realizar petición
const url = "../controlador/tema.controller.php";
const urlPts = "../controlador/puntaje.controller.php";
const urlAmbito = "../controlador/ambito.controller.php";

// Evento principal
document.addEventListener("DOMContentLoaded", async () => {
  await getTopics();
  fillAmbito();
});
// Click para cancelar
btnCancelar.addEventListener("click", (e) => {
  e.preventDefault();
  clearForm();
});
// Click para enviar datos
btnEnviar.addEventListener("click", (e) => {
  e.preventDefault();
  saveTopic();
});

btnEnviarPuntaje.addEventListener("click", (e) => {
  e.preventDefault();
  savePts();
});
//Al cambiar el select buscara llenar los datos del puntaje asociados al tema
selectPuntaje.addEventListener("change", (e) => {
  e.preventDefault();
  getPts(selectPuntaje.value,idTema.value);
})

// Función para limpiar formulario
const clearForm = () => {
  formTema.id_tema.value = "";
  formTema.nombre.value = "";
  formTema.desc.value = "";
  formTema.obser.value = "";
  formTema.ambito.value = "";
};

const clearFormPts = () => {
  formPuntaje.id_puntaje.value  = "";
  formPuntaje.id_tema.value     = "";
  formPuntaje.pts.value         = "";
  formPuntaje.ptsDesc.value     = "";
  $("#calloutText").text("No se ha seleccionado tema!");
  $("#calloutTema").removeClass("callout-info");
  $("#calloutTema").addClass("callout-warning");
};

const clearFormPtsDesc= () => {
  formPuntaje.id_puntaje.value  = "";
  formPuntaje.ptsDesc.value     = "";
}

// Función para cargar la información
const getTopics = async () => {
  tabla_temas = await $("#tabla_temas").DataTable({
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
      { data: "descripcion" },
      { data: "observaciones" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
          <button title="Editar" class="btn btn-primary btn-sm" onclick="getTopicById(${data})"><i class="fa fa-pencil"></i></button>
          <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteTopic(${data})"><i class="fa fa-trash"></i></button>
          `;
        },
      },
    ],
    fnRowCallback: function (nRow) {
      $($(nRow).find("td")[3]).css("text-align", "center");
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

function fillAmbito() {
  $.ajax({
    method: "GET",
    url: `${urlAmbito}?accion=list`,
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    success: function (response) {
      $.each(response["data"], function(id,valor){
        var id_select = valor['id'];
        var name_select = valor['nombre'];
        $("#ambito").append("<option value='" + id_select + "'>" + name_select + "</option>");
      })
    }
  });
}

// Función para guardar y actualizar un tema
const saveTopic = async () => {
  const accion = !idTema.value
    ? `${url}?accion=create`
    : `${url}?accion=update`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formTema),
  }).then((res) => res.json());

  if (success) {
    clearForm();
    tabla_temas.ajax.reload();
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
};

// Función para obtener un tema por id
const getTopicById = async (id) => {
  const { success, tema } = await fetch(`${url}?accion=get&id=${id}`).then(
    (res) => res.json()
  );

  if (success) {
    formTema.id_tema.value = tema[0].id;
    formTema.nombre.value = tema[0].nombre;
    formTema.desc.value = tema[0].descripcion;
    formTema.obser.value = tema[0].observaciones;
    formTema.ambito.value = tema[0].id_ambito;
    formPuntaje.id_tema.value = tema[0].id;
    $("#calloutText").text(tema[0].nombre);
    $("#calloutTema").removeClass("callout-warning");
    $("#calloutTema").addClass("callout-info");
  } else {
    return alert("¡Error!", "¡No se pudo obtener el ámbito!", "error");
  }
};
// Función para obtener un puntaje por id
/* const getPtsById = async (id) =>{
  const { success, puntaje } = await fetch(`${urlPts}?accion=get&id=${id}`).then(
    (res) => res.json()
  );
  if (success) {
    formPuntaje.id_puntaje.value = puntaje[0].id;
    formPuntaje.id_tema.value = puntaje[0].id_tema;
    formPuntaje.pts.value = puntaje[0].puntaje;
    formPuntaje.ptsDesc.value = tema[0].descripcion;
  } else {
    return alert("¡Error!", "¡No se pudo obtener el puntaje!", "error");
  }
} */

const getPts = async (pts,idt) =>{
  const { success, puntaje } = await fetch(`${urlPts}?accion=getPts&pts=${pts}&idt=${idt}`).then(
    (res) => res.json()
  );
  if (success) {
    formPuntaje.id_puntaje.value = puntaje[0].id;
    formPuntaje.id_tema.value = puntaje[0].id_tema;
    formPuntaje.pts.value = puntaje[0].puntaje;
    formPuntaje.ptsDesc.value = puntaje[0].descripcion;
  } else {
    if (!idt){
      clearFormPtsDesc();
      return alert("¡Error!", "¡No se ha seleccionado tema!", "error");
    }else{
      clearFormPtsDesc();
      return alert("¡Error!", "¡Aun no se ha ingresado este puntaje!", "error");
    }
  }
}

const savePts = async () => {
  const accion = !idPuntaje.value
    ? `${urlPts}?accion=create`
    : `${urlPts}?accion=update`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formPuntaje),
  }).then((res) => res.json());

  if (success) {
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
};


// Función para eliminar un registro
const deleteTopic = async (id) => {
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
      tabla_temas.ajax.reload();
      return alert("¡Exito!", mensaje, "success");
    } else {
      return alert("¡Error!", mensaje, "error");
    }
  }
};
