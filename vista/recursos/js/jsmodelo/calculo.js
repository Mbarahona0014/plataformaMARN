const ctx = document.getElementById("chartBar");

let tabla_encabezado = "";
let tabla_resumen = "";
let tabla_comparacion = "";
let tabla_comparacion2 = "";
let tabla_indicadores = "";
let tabla_calidad = "";
let peso_total = 0;
let chartBar;
let chartLine;

const url = "../controlador/encabezado_reporte.controller.php";
const urlAreas = "../controlador/area.controller.php";
const urlAmbitos = "../controlador/ambito.controller.php";
const urlEvaluadores = "../controlador/evaluador.controller.php";
const urlEvEn = "../controlador/evaluador_encabezado.controller.php";
const urlReport = "../controlador/detalle_reporte.controller.php";

document.addEventListener("DOMContentLoaded", async () => {
  await getAreas();
  await getHeader(0);
  await resumeTable(0);
  await indicatorsTable(0);
  await graficarChartBar(0);
  await reportComp(0);
  await reportComp2(0);
  await graficarChartLine(0);
});

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

async function getHeader(id) {
  tabla_encabezado = await $("#tabla_encabezado").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${url}?accion=listByArea&id=${id}`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "id" },
      { data: "AREA" },
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

$("#area").change(async () => {
  const area = $("#area").val();
  if (area) {
    await getHeader(area);
  } else {
    await getHeader(0);
    await resumeTable(0);
    await indicatorsTable(0);
    await graficarChartBar(0);
    await reportComp(0);
    await reportComp2(0);
    await graficarChartLine(0);
  }
});

async function resumeTable(id) {
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

async function indicatorsTable(id) {
  tabla_indicadores = await $("#tabla_indicadores").DataTable({
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
          if (data < 200) {
            return "No aceptable";
          } else if (data >= 200 && data < 400) {
            return "Poco aceptable";
          } else if (data >= 400 && data < 600) {
            return "Regular";
          } else if (data >= 600 && data < 800) {
            return "Aceptable";
          } else if (data > 800) {
            return "Satisfactorio";
          }
        },
      },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });
}

const graficarChartBar = async (id) => {
  const { data } = await fetch(
    `${urlReport}?accion=resumeByIndicator&id=${id}`
  ).then((res) => res.json());
  if (chartBar) {
    chartBar.destroy();
  }
  chartBar = new Chart(ctx, {
    type: "bar",
    data: {
      labels: data.map((x) => x.ambito),
      datasets: [
        {
          label: "Escala de Satisfacción",
          data: data.map((x) => x.indicador),
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
          ],
          borderColor: [
            "rgb(255, 99, 132)",
            "rgb(255, 159, 64)",
            "rgb(255, 205, 86)",
            "rgb(75, 192, 192)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
};

async function reportComp(id) {
  const area = $("#area").val();
  tabla_comparacion = await $("#tabla_comparacion").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${urlReport}?accion=comparetionByHeaders&id=${id}&id_ap=${area}`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "ambito" },
      { data: "ucg" },
      { data: "gas1" },
      { data: "gas2" },
      {
        data: "cg",
        render: function (data) {
          return `${data}%`;
        },
      },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });
}

async function reportComp2(id) {
  const area = $("#area").val();
  tabla_comparacion2 = await $("#tabla_comparacion2").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${urlReport}?accion=comparetionByHeaders2&id=${id}&id_ap=${area}`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      dataSrc: "data",
    },
    columns: [
      { data: "ambito" },
      { data: "ucg" },
      { data: "ga1" },
      { data: "ga2" },
      { data: "ga3" },
      { data: "ga4" },
      { data: "ga5" },
      { data: "ga6" },
    ],
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
    },
  });
}

const graficarChartLine = async (id) => {
  const datasets = [];
  const nuevoArray = [];
  const ctx = document.querySelector("#chartLine");

  const { data } = await fetch(
    `${urlReport}?accion=comparetionByHeaders2&id=${id}&id_ap=3`
  ).then((res) => res.json());

  if (chartLine) {
    chartLine.destroy();
  }

  if (data.length > 0) {
    data.forEach((item) => {
      const { ga1, ga2, ga3, ga4, ga5, ga6 } = item;
      nuevoArray.push([
        { label: "GA1", data: ga1, producto: item.ambito },
        { label: "GA2", data: ga2, producto: item.ambito },
        { label: "GA3", data: ga3, producto: item.ambito },
        { label: "GA4", data: ga4, producto: item.ambito },
        { label: "GA5", data: ga5, producto: item.ambito },
        { label: "GA6", data: ga6, producto: item.ambito },
      ]);
    });

    const g1Array = nuevoArray.map((item) => item[0]);
    const g2Array = nuevoArray.map((item) => item[1]);
    const g3Array = nuevoArray.map((item) => item[2]);
    const g4Array = nuevoArray.map((item) => item[3]);
    const g5Array = nuevoArray.map((item) => item[4]);
    const g6Array = nuevoArray.map((item) => item[5]);

    const g1Dataset = {
      label: g1Array[0].label,
      data: g1Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(255, 99, 132, 0.2)",
      borderColor: "rgb(255, 99, 132)",
      tension: 0.1,
      fill: false,
      hidden: true,
    };

    const g2Dataset = {
      label: g2Array[0].label,
      data: g2Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(255, 159, 64, 0.2)",
      borderColor: "rgb(255, 159, 64)",
      tension: 0.1,
      fill: false,
      hidden: true,
    };

    const g3Dataset = {
      label: g3Array[0].label,
      data: g3Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(255, 205, 86, 0.2)",
      borderColor: "rgb(255, 205, 86)",
      tension: 0.1,
      fill: false,
      hidden: true,
    };

    const g4Dataset = {
      label: g4Array[0].label,
      data: g4Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(75, 192, 192, 0.2)",
      borderColor: "rgb(75, 192, 192)",
      tension: 0.1,
      fill: false,
      hidden: true,
    };

    const g5Dataset = {
      label: g5Array[0].label,
      data: g5Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(150, 59, 158, 0.2)",
      borderColor: "rgba(150, 59, 158)",
      tension: 0.1,
      fill: false,
      hidden: true,
    };

    const g6Dataset = {
      label: g6Array[0].label,
      data: g6Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(139, 240, 193, 0.2)",
      borderColor: "rgb(139, 240, 193)",
      tension: 0.1,
      fill: false,
      hidden: true,
    };

    datasets.push(g1Dataset);
    datasets.push(g2Dataset);
    datasets.push(g3Dataset);
    datasets.push(g4Dataset);
    datasets.push(g5Dataset);
    datasets.push(g6Dataset);
  }

  chartLine = new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        "Ámbito Social",
        "Ámbito Administrativo",
        "Ámbito Recurso Naturales y Culturales",
        "Ámbito Económico Financiero",
      ],
      datasets,
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
};

async function goCalc(id) {
  await resumeTable(id);
  await indicatorsTable(id);
  await graficarChartBar(id);
  await reportComp(id);
  await reportComp2(id);
  await graficarChartLine(id);
}
