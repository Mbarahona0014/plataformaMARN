const formCord = document.querySelector("#form_cord");
const id_cord = document.querySelector("#id_cord");

const btnCancelar = document.querySelector("#btn_cancelar");
const btnEnviar = document.querySelector("#btn_agregar");

let tabla_cord = "";

//URL PARA LA PETICION
const url = "../controlador/coordenadas.controller.php";
const urlAreas = "../controlador/area.controller.php";

//EVENTO PRINCIPAL CARGAR EVALUADORES
document.addEventListener("DOMContentLoaded", async () => {
  $(".select2").select2({
    theme: "classic",
    width: "resolve",
  });
  await getAreas();
  await getCords();
  await getPoints();
});

function alert(encabezado,mensaje,tipo){
  Swal.fire(
    encabezado,
    mensaje,
    tipo
  )
}


const getPoints = async () => {
  const { data } = await fetch(`${url}?accion=points`).then((res) =>
    res.json()
  );
  let html = "";
  if (data.length > 0) {
    alert(data["area"]);
  } else {
    alert("nada");
  }
  $("#area").html(html);
};

const getAreas = async () => {
  const { data } = await fetch(`${urlAreas}?accion=list`).then((res) =>
    res.json()
  );
  let html = "";
  if (data.length > 0) {
    html += '<option value="">Seleccione una área</option>';
    data.forEach((area) => {
      html += `<option value="${area.id}">${area.nombre}</option>`;
    });
  } else {
    html = `<option value="">No hay puntajes para mostrar</option>`;
  }
  $("#area").html(html);
};

btnCancelar.addEventListener("click", (e) => {
  e.preventDefault();
  clearForm();
});
// Click para enviar datos
btnEnviar.addEventListener("click", (e) => {
  e.preventDefault();
  saveCord();
});
//LIMPIAR FORMULARIOS
const clearForm = () => {
  $('#area').val("");
  $('#area').trigger('change');
  formCord.lat.value="";
  formCord.lon.value="";
};
//FUNCION PARA CARGAR LA INFORMACION
const getCords = async () => {
  tabla_cord = await $("#tabla_cord").DataTable({
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
      { data: "id_anp" },
      { data: "lat" },
      { data: "lon" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
            <button title="Editar" class="btn btn-primary btn-sm" onclick="getCordById(${data})"><i class="fa fa-pencil"></i></button>
            <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteCord(${data})"><i class="fa fa-trash"></i></button>
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
const saveCord = async () => {
  const accion = !id_cord.value
    ? `${url}?accion=create`
    : `${url}?accion=update`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formCord),
  }).then((res) => res.json());

  if (success) {
    clearForm();
    tabla_cord.ajax.reload();
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
};

//OBTENER UN REGISTRO
const getCordById = async (id) => {
  const { success, coordenada } = await fetch(
    `${url}?accion=get&id=${id}`
  ).then((res) => res.json());
  if (success) {
    /* console.log(coordenada[0].id); */
    formCord.scrollIntoView({block: "end", behavior: "smooth"});
    formCord.id_cord.value = coordenada[0].id;
    $('#area').val(coordenada[0].id_anp);
    $('#area').trigger('change');
    /* formCord.area.value = coordenada[0].id_anp; */
    formCord.lat.value = coordenada[0].lat;
    formCord.lon.value = coordenada[0].lon;
  } else {
    return alert("¡Error!", "¡No se pudo obtener la coordenada!", "error");
  }
};

const deleteCord = async (id) => {
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
      tabla_cord.ajax.reload();
      return alert("¡Exito!", mensaje, "success");
    } else {
      return alert("¡Error!", mensaje, "error");
    }
  }
};
