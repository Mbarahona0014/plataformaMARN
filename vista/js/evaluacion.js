const formEncabezado = document.querySelector("#form_encabezado");
const formEvaluador = document.querySelector("#form_evaluador");

const idEncabezado = document.querySelector("#id_encabezado");

/* const btnCancelar = document.querySelector("#btn_cancelar"); */
const btnEnviarEncabezado = document.querySelector("#btn_agregar_encabezado");
const btnEnviarEvaluador = document.querySelector("#btn_agregar_evaluador");

const selectArea = document.querySelector("#area");
const selectEvaluador = document.querySelector("#evaluador");
const listaEvaluadores = document.querySelector("#listaEvaluadores");

let tabla_encabezado = "";
let tabla_evaluacion = "";
let tabla_reporte = "";

const url = "../controllers/encabezado_reporte.controller.php";
const urlAreas = "../controllers/area.controller.php";
const urlEvaluadores = "../controllers/evaluador.controller.php";
const urlEvEn = "../controllers/evaluador_encabezado.controller.php";
const urlReport = "../controllers/detalle_reporte.controller.php";

document.addEventListener("DOMContentLoaded", async () => {
  await getHeader();
  fillArea();
  fillEvaluador();
  $("#div_reporte").hide();
  $("#form_detalle").hide();
  $("#div_tema").hide();
  $("#div_puntaje").hide();
  $("#div_observaciones").hide();
  $("#div_evidencias").hide();
});

btnEnviarEncabezado.addEventListener("click", (e) => {
  e.preventDefault();
  saveHeader();
});

btnEnviarEvaluador.addEventListener("click", (e) => {
  e.preventDefault();
  saveHeaderEvaluator();
});

function clearForm() {
  formEncabezado.id_encabezado.value = "";
  formEncabezado.area.value = "";
  formEncabezado.fecha.value = "";
}

function clearFormEvaluators() {
  formEvaluador.id_encabezado.value = "";
  formEvaluador.evaluador.value = "";
  listaEvaluadores.innerHTML = "";
}

//FUNCION PARA LLENAR SELECTOR DE AREAS
function fillArea() {
  $.ajax({
    method: "GET",
    url: `${urlAreas}?accion=list`,
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    success: function (response) {
      $.each(response["data"], function (id, valor) {
        var id_select = valor["id"];
        var name_select = valor["nombre"];
        $("#area").append(
          "<option value='" + id_select + "'>" + name_select + "</option>"
        );
      });
    },
  });
}

//FUNCION PARA LLENAR SELECTOR EVALUADORES
function fillEvaluador() {
  $.ajax({
    method: "GET",
    url: `${urlEvaluadores}?accion=list`,
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    success: function (response) {
      $.each(response["data"], function (id, valor) {
        var id_select = valor["id"];
        var name_select = valor["nombres"] + " " + valor["apellidos"];
        $("#evaluador").append(
          "<option value='" + id_select + "'>" + name_select + "</option>"
        );
      });
    },
  });
}

function fillEnEv(idEn) {
  $.ajax({
    method: "GET",
    url: `${urlEvEn}?accion=listNom&idEn=${idEn}`,
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    success: function (response) {
      $.each(response["data"], function (id, valor) {
        var id_select = valor["id"];
        var name_select = valor["nombre_completo"];
        $("#listaEvaluadores").append(
          '<button type="button" class="btn btn-primary btn-block" onclick="deleteHeaderEvaluator(' +
            id_select +
            ')">' +
            name_select +
            '<i class="fas fa-minus-circle"></i></div>'
        );
      });
    },
  });
}

async function getHeader() {
  tabla_encabezado = await $("#tabla_encabezado").DataTable({
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
      { data: "id" },
      { data: "id_area_natural" },
      { data: "fecha_evaluacion" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
          <button title="Ir a reporte" class="btn btn-dark btn-sm" onclick="goReport(${data})"><i class="fas fa-list"></i></button>
          <button title="Editar" class="btn btn-primary btn-sm" onclick="getHeaderById(${data})"><i class="fas fa-edit"></i></button>
          <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteHeader(${data})"><i class="fas fa-trash-alt"></i></button>
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
}

async function saveHeader() {
  const accion = !idEncabezado.value
    ? `${url}?accion=create`
    : `${url}?accion=update`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formEncabezado),
  }).then((res) => res.json());

  if (success) {
    clearForm();
    tabla_encabezado.ajax.reload();
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
}

async function getHeaderById(id) {
  const { success, encabezado } = await fetch(
    `${url}?accion=get&id=${id}`
  ).then((res) => res.json());
  if (success) {
    clearFormEvaluators();
    formEncabezado.id_encabezado.value = encabezado[0].id;
    formEvaluador.id_encabezado.value = encabezado[0].id;
    formEncabezado.area.value = encabezado[0].id_area_natural;
    formEncabezado.fecha.value = encabezado[0].fecha_evaluacion;
    fillEnEv(encabezado[0].id);
  } else {
    return alert("¡Error!", "¡No se pudo obtener la evaluacion!", "error");
  }
}

async function deleteHeader(id) {
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
      tabla_encabezado.ajax.reload();
      return alert("¡Exito!", mensaje, "success");
    } else {
      return alert("¡Error!", mensaje, "error");
    }
  }
}

async function saveHeaderEvaluator() {
  const accion = `${urlEvEn}?accion=create`;
  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formEvaluador),
  }).then((res) => res.json());
  if (success) {
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
}

async function deleteHeaderEvaluator(id) {
  const { success, mensaje } = await fetch(
    `${urlEvEn}?accion=delete&id=${id}`
  ).then((res) => res.json());
  if (success) {
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
}

const goReport = async (id) => {
  $("#div_reporte").show(400);
  $("#form_detalle").show(400);
  $("#id_encabezado_detalle").val(id);
  const { encabezado } = await fetch(`${url}?accion=get&id=${id}`).then((res) =>
    res.json()
  );
  $("#span_eva").text(encabezado[0].id);
  $("#span_fecha").text(encabezado[0].fecha_evaluacion);
  $("#spa_area").text(encabezado[0].nombre);
  await getReport(id);
  await getScopes();
};

async function getReport(id) {
  tabla_reporte = await $("#tabla_reporte").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${urlReport}?accion=getByHeader&id=${id}`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "ambito" },
      { data: "tema" },
      { data: "evidencia" },
      { data: "puntaje" },
      { data: "observaciones" },
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
}

const getScopes = async () => {
  const url = `../controllers/ambito.controller.php?accion=list`;
  const { data } = await fetch(url).then((res) => res.json());
  let html = "";

  html += '<option value="">Seleccione un ámbito</option>';
  data.forEach((scope) => {
    html += `<option value="${scope.id}">${scope.nombre}</option>`;
  });
  if (data.length > 0) {
    $("#id_ambito").html(html);
  } else {
    html = `<option value="">No hay ámbitos para mostrar</option>`;
  }
};

$("#id_ambito").change(async () => {
  const id_ambito = $("#id_ambito").val();
  const url = `../controllers/tema.controller.php`;

  if (id_ambito.length > 0) {
    const { success, temas } = await fetch(
      `${url}?accion=getByScope&id=${id_ambito}`
    ).then((res) => res.json());
    let html = "";
    if (success) {
      html += '<option value="">Seleccione un tema</option>';
      temas.forEach((tema) => {
        html += `<option value="${tema.id}">${tema.nombre}</option>`;
      });
      if (temas.length > 0) {
        $("#div_tema").show(400);
        $("#id_tema").html(html);
        $("#id_tema").trigger("change");
      } else {
        html = `<option value="">No hay temas para mostrar</option>`;
      }
    } else {
      $("#div_tema").hide(400);
      $("#id_tema").val("").trigger("change");
    }
  } else {
    $("#div_tema").hide(400);
    $("#id_tema").val("").trigger("change");
  }
});

$("#id_tema").change(async () => {
  const id_tema = $("#id_tema").val();
  const url = `../controllers/tema.controller.php`;

  if (id_tema.length > 0) {
    const { success, puntajes } = await fetch(
      `${url}?accion=getByTopic&id=${id_tema}`
    ).then((res) => res.json());
    let html = "";
    if (success) {
      html += '<option value="">Seleccione un puntaje</option>';
      puntajes.forEach((puntaje) => {
        html += `<option value="${puntaje.id}">${puntaje.puntaje}</option>`;
      });
      if (puntajes.length > 0) {
        $("#div_puntaje").show(400);
        $("#id_puntaje").html(html);
        $("#id_puntaje").trigger("change");
      } else {
        html = `<option value="">No hay puntajes para mostrar</option>`;
      }
    } else {
      $("#div_puntaje").hide(400);
      $("#id_puntaje").val("").trigger("change");
    }
  } else {
    $("#div_puntaje").hide(400);
    $("#id_puntaje").val("").trigger("change");
  }
});

$("#id_puntaje").change(async () => {
  const id_puntaje = $("#id_puntaje").val();
  if (id_puntaje) {
    $("#div_observaciones").show(200, () => {
      $("#div_evidencias").show(200);
    });
  } else {
    $("#div_evidencias").hide(200, () => {
      $("#div_observaciones").hide(200);
    });
  }
});

const cancel = () => {
  $("#form_detalle").hide(500, () => {
    $("#div_reporte").hide(500);
  });
  $("#id_ambito").val("").trigger("change");
  $("#obser_deta").val("");
  $("#evi_deta").val("");
  $("#id_encabezado_detalle").val("");
};

async function saveDetail() {
  const accion = `${urlReport}?accion=create`;

  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData($("#form_detalle")[0]),
  }).then((res) => res.json());

  if (success) {
    $("#id_ambito").val("").trigger("change");
    $("#obser_deta").val("");
    $("#evi_deta").val("");
    $("#id_encabezado_detalle").val("");
    tabla_reporte.ajax.reload();
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
}

$("#btn_agregar_detalle").click(async (e) => {
  e.preventDefault();
  await saveDetail();
});
