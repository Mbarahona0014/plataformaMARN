

let tabla_encabezado = "";
let tabla_resumen = "";
let tabla_calidad = "";
let peso_total = 0;

const url = "../controlador/encabezado_reporte.controller.php";
const urlAreas = "../controlador/area.controller.php";
const urlAmbitos = "../controlador/ambito.controller.php";
const urlEvaluadores = "../controlador/evaluador.controller.php";
const urlEvEn = "../controlador/evaluador_encabezado.controller.php";
const urlReport = "../controlador/detalle_reporte.controller.php";

document.addEventListener("DOMContentLoaded", async () => {
  await getHeader();
});

function alert(encabezado, mensaje, tipo) {
  Swal.fire(encabezado, mensaje, tipo);
}

/* async function getTotalWeight() {
  const { success, peso } = await fetch(
    `${urlAmbitos}?accion=getTotalWeight`
  ).then((res) => res.json());
  if (success) {
    $("#peso_total").value =peso[0]['total'];
  } else {
    $("#peso_total").value =0;
  }
} */

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
      { data: "fecha_evaluacion" },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data) {
          return `
          <button title="Ir a calculos" class="btn bg-teal btn-sm" onclick="goCalc(${data})"><i class="fa fa-search"></i></button>
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

async function resumeTable(id){
  tabla_resumen = await $("#tabla_resumen").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${urlReport}?accion=resumeByHeader&id=${id}`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "ambito" },
      { data: "peso" },
      { data: "puntajeucg" },
      { data: "puntajeanp" },
      { data: "diferencia" },
      { data: "porcentaje" },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });
}

async function indicatorsTable(id){
  tabla_resumen = await $("#tabla_indicadores").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${urlReport}?accion=resumeByIndicator&id=${id}`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "ambito" },
      { data: "indicador" },
      {
        data: "indicador",
        orderable: false,
        searchable: false,
        render: function (data) {
          if(data < 200){
            return 'No aceptable';
          }else if(data >= 200 && data < 400){
            return 'Poco aceptable';
          }else if(data >= 400 && data < 600){
            return 'Regular';
          }else if(data >= 600 && data < 800){
            return 'Aceptable';
          }else if(data > 800){
            return 'Satisfactorio';
          }
        },
      },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });
}


async function goCalc(id) {
  await resumeTable(id);
  await indicatorsTable(id);
}

