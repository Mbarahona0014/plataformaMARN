const formEncabezado = document.querySelector("#form_encabezado");
const formEvaluador = document.querySelector("#form_evaluador");
const formDetalle = document.querySelector("#form_detalle");
const fileInput = document.getElementById("imagenes");

const idEncabezado = document.querySelector("#id_encabezado");

const btnCancelar = document.querySelector("#btn_cancelar");
const btnEnviarEncabezado = document.querySelector("#btn_agregar_encabezado");
const btnEnviarEvaluador = document.querySelector("#btn_agregar_evaluador");

const selectConservacion = document.querySelector("#conservacion");
const selectArea = document.querySelector("#area");
const selectEvaluador = document.querySelector("#evaluador");
const listaEvaluadores = document.querySelector("#listaEvaluadores");

let tabla_encabezado = "";
let tabla_evaluacion = "";
let tabla_reporte = "";
let tabla_archivos = "";

const url = "../controlador/encabezado_reporte.controller.php";
const urlAreas = "../controlador/area.controller.php";
const urlEvaluadores = "../controlador/evaluador.controller.php";
const urlEvEn = "../controlador/evaluador_encabezado.controller.php";
const urlReport = "../controlador/detalle_reporte.controller.php";
const urlDescargar = "../controlador/descargar.controller.php";

document.addEventListener("DOMContentLoaded", async () => {
  await getHeader();
  fillArea();
  fillAreaCon();
  fillEvaluador();
  $("#div_reporte").hide();
  $("#form_detalle").hide();
  $("#div_tema").hide();
  $("#div_puntaje").hide();
  $("#div_observaciones").hide();
  $("#div_evidencias").hide();
  $("#div_imagen").hide();
});

function alert(encabezado, mensaje, tipo) {
  Swal.fire(encabezado, mensaje, tipo);
}

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
  $("#calloutText").text("No se ha seleccionado evaluacion!");
  $("#calloutEvaluacion").removeClass("callout-info");
  $("#calloutEvaluacion").addClass("callout-warning");
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

//FUNCION PARA LLENAR AREAS DE CONSERVACION
function fillAreaCon() {
  $.ajax({
    method: "GET",
    url: `${urlAreas}?accion=listC`,
    dataType: "json",
    contentType: "application/json; charset=utf-8",
    success: function (response) {
      $.each(response["data"], function (id, valor) {
        var id_select = valor["id"];
        var name_select = valor["nombre"];
        $("#conservacion").append(
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
            '&nbsp<i class="fa fa-minus-circle"></i></div>'
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
      { data: "area" },
      { data: "paisaje" },
      { data: "fecha_evaluacion" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
          <button title="Ir a reporte" class="btn bg-navy btn-sm" onclick="goReport(${data})"><i class="fa fa-list-ul"></i></button>
          <button title="Editar" class="btn btn-primary btn-sm" onclick="getHeaderById(${data})"><i class="fa fa-pencil"></i></button>
          <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteHeader(${data})"><i class="fa fa-trash"></i></button>
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
    formEncabezado.scrollIntoView({block: "end", behavior: "smooth"});
    formEncabezado.id_encabezado.value = encabezado[0].id;
    formEvaluador.id_encabezado.value = encabezado[0].id;
    formEncabezado.area.value = encabezado[0].id_area_natural;
    formEncabezado.conservacion.value = encabezado[0].id_area_conservacion;
    formEncabezado.fecha.value = encabezado[0].fecha_evaluacion;
    fillEnEv(encabezado[0].id);
    $("#calloutText").text("Evaluacion numero: " + id);
    $("#calloutEvaluacion").removeClass("callout-warning");
    $("#calloutEvaluacion").addClass("callout-info");
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
  const id_encabezado = $("#id_encabezado").val();
  const accion = `${urlEvEn}?accion=create`;
  const { success, mensaje } = await fetch(accion, {
    method: "POST",
    body: new FormData(formEvaluador),
  }).then((res) => res.json());
  if (success) {
    listaEvaluadores.innerHTML = "";
    fillEnEv(id_encabezado);
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
}

async function deleteHeaderEvaluator(id) {
  const id_encabezado = $("#id_encabezado").val();
  const { success, mensaje } = await fetch(
    `${urlEvEn}?accion=delete&id=${id}`
  ).then((res) => res.json());
  if (success) {
    listaEvaluadores.innerHTML = "";
    fillEnEv(id_encabezado);
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
}

async function deleteDetail(id) {
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
      `${urlReport}?accion=delete&id=${id}`
    ).then((res) => res.json());
    if (success) {
      getRemainingTopics($("#id_encabezado_detalle").val());
      tabla_reporte.ajax.reload();
      return alert("¡Exito!", mensaje, "success");
    } else {
      return alert("¡Error!", mensaje, "error");
    }
  }
}

async function updaterHeaderStatus(est, idEn) {
  const url = `../controlador/encabezado_reporte.controller.php`;
  const { success, temas } = await fetch(
    `${url}?accion=updateStatus&estado=${est}&id=${idEn}`
  ).then((res) => res.json());
}

async function getRemainingTopics(idEn) {
  const url = `../controlador/tema.controller.php`;
  const { success, temas } = await fetch(
    `${url}?accion=getRemainingTopic&idEn=${idEn}`
  ).then((res) => res.json());
  if (success) {
    if (temas[0]["pendientes"] == 0) {
      updaterHeaderStatus("1", idEn);
      $("#temasPendientes").text("Esta evaluacion ya está finalizada");
    } else {
      updaterHeaderStatus("0", idEn);
      $("#temasPendientes").text(temas[0]["pendientes"]);
    }
  } else {
    $("#temasPendientes").text("0");
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
  getRemainingTopics(encabezado[0].id);
  await getReport(id);
  await getScopes();
  formDetalle.scrollIntoView({block: "end", behavior: "smooth"});
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
      { data: "puntaje" },
      { data: "evidencia" },
      { data: "observaciones" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
            <button title="Eliminar" class="btn btn-danger btn-sm" onclick="deleteDetail(${data})"><i class="fa fa-trash"></i></button>
            <button title="Ver Archivos" class="btn btn-info btn-sm" onclick="abrirModal(${data})"><i class="fa fa-file"></i></button>
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

const abrirModal = (id) => {
  $("#modal_archivos").modal({
    show: false,
    backdrop: "static",
  });
  $("#modal_archivos").modal("show");
  listarArchivos(id);
};

const getScopes = async () => {
  const url = `../controlador/ambito.controller.php?accion=list`;
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
  //Modificar selector para que los temas mostrados solo sean los pendientes de evaluar
  const id_encabezado = $("#id_encabezado_detalle").val();
  const id_ambito = $("#id_ambito").val();
  const url = `../controlador/tema.controller.php`;
  if (id_ambito.length > 0) {
    const { success, temas } = await fetch(
      `${url}?accion=getRemainingByScope&id=${id_ambito}&idEn=${id_encabezado}`
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
      alert("Finalizado", "Todos los temas han sido evaluados", "info");
      $("#div_tema").hide(400);
      $("#id_tema").val("").trigger("change");
    }
  } else {
    //Indicar que los temas ya fueron evaluados
    $("#div_tema").hide(400);
    $("#id_tema").val("").trigger("change");
  }
});

$("#id_tema").change(async () => {
  const id_tema = $("#id_tema").val();
  const url = `../controlador/tema.controller.php`;

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
      $("#imagenes").val("").trigger("change");
    }
  } else {
    $("#div_puntaje").hide(400);
    $("#id_puntaje").val("").trigger("change");
    $("#imagenes").val("").trigger("change");
  }
});

$("#id_puntaje").change(async () => {
  const id_puntaje = $("#id_puntaje").val();
  $("#imagenes").val("").trigger("change");
  if (id_puntaje) {
    $("#div_observaciones").show(200, () => {
      $("#div_evidencias").show(200, () => {
        $("#div_imagen").show(200);
      });
    });
  } else {
    $("#div_evidencias").hide(200, () => {
      $("#div_observaciones").hide(200, () => {
        $("#div_imagen").hide(200);
      });
    });
  }
});

const dt = new DataTransfer();
$("#imagenes").change(() => {
  const valInput = $("#imagenes").val();
  // console.log(valInput);
  let ext = "";
  let fileBloc = "";
  const allowebExtensions = [
    "jpg",
    "jpeg",
    "png",
    "gif",
    "doc",
    "docx",
    "pdf",
    "xlsx",
    "xls",
  ];
  let fileList = fileInput.files;
  for (let file of fileList) {
    ext = file.name.split(".").pop();
    if (!allowebExtensions.includes(ext)) {
      return Swal.fire({
        title: "¡Error!",
        text: "¡Se ingresó un archivo de formato inválido!",
        icon: "error",
        // showConfirmButton: false,
        // timer: 1500,
        allowOutsideClick: false,
        heightAuto: false,
      });
    }
  }

  if (valInput.length > 0) {
    for (let i = 0; i < fileList.length; i++) {
      fileBloc = `
      <p class="file-block">
        <span class="file-delete" style="cursor: pointer;">
          <b class="badge bg-red">x</b>
          <span class="name">
            ${fileList.item(i).name}
          </span>
        </span>
      </p>
      `;
      $("#filesList > #files-names").append(fileBloc);
    }

    for (let file of fileList) {
      dt.items.add(file);
    }

    fileList = dt.files;

    $("span.file-delete").click(function () {
      let name = $(this).children("span.name").text().trim();
      $(this).parent().remove();
      for (let i = 0; i < dt.items.length; i++) {
        if (name === dt.items[i].getAsFile().name) {
          dt.items.remove(i);
          continue;
        }
      }
      document.getElementById("imagenes").files = dt.files;
    });
  } else {
    $("#filesList > #files-names").empty();
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
    $("#imagenes").val("").trigger("change");
    //$("#id_encabezado_detalle").val("");
    tabla_reporte.ajax.reload();
    getRemainingTopics($("#id_encabezado_detalle").val());
    return alert("¡Exito!", mensaje, "success");
  } else {
    return alert("¡Error!", mensaje, "error");
  }
}

$("#btn_agregar_detalle").click(async (e) => {
  e.preventDefault();
  await saveDetail();
});

const listarArchivos = async (id) => {
  tabla_archivos = await $("#tabla_archivos").DataTable({
    destroy: true,
    ordering: false,
    responsive: true,
    autoWidth: false,
    ajax: {
      method: "GET",
      url: `${urlReport}?accion=listFiles&id=${id}`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { defaultContent: "" },
      { data: "archivo" },
      { data: "id_detalle" },
      {
        data: "archivo",
        render: function (data) {
          return `<a href="${urlDescargar}?file=${data}" class="btn btn-info btn-sm"><i class="fa fa-download"></i></a>`;
        },
      },
    ],
    fnRowCallback: function (nRow) {
      $($(nRow).find("td")[0]).css("text-align", "left");
      $($(nRow).find("td")[1]).css("text-align", "left");
      $($(nRow).find("td")[2]).css("text-align", "center");
    },
    lengthMenu: [
      [10, 15, 20, -1],
      [10, 15, 20, "Todos"],
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });

  tabla_archivos.on("draw.dt", function () {
    const PageInfo = $("#tabla_archivos").DataTable().page.info();
    tabla_archivos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + PageInfo.start;
      });
  });
};
