

let tabla_encabezado = "";
let tabla_resumen = "";
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
  getTotalWeight();
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

