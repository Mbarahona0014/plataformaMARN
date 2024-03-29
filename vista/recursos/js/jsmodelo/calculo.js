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
  $(".select2").select2({
    theme: "classic",
    width: "resolve",
  });
  await getAreas();
  await getHeader(0);
  await resumeTable(0);
  await indicatorsTable(0);
  await graficarChartBar(0);
  await reportComp(0);
  await reportComp2(0);
  await graficarChartLine(0);
  $("#box_encabezado").hide();
  $(".hide").hide();
  //$("#evaluacionRef").hide();
});

function Export2PDF(filename = "test.pdf") {
  var preHtml = `<html><head><meta charset='utf-8'><title>Export HTML To PDF</title>
    <style>
    *{
      padding: 2px;
      margin: 0;
      border: 0;
    }
    .banner {
      padding-top:10px;
      font-size:14px;
      font-family: Verdana, sans-serif;
    }
    .box-tittle{
      font-family: Verdana, sans-serif;
      display: inline;
      float: left;
      text-align: right;
      white-space: nowrap;
      font-size:18px;
      padding-bottom:20px;
    }
    .nv{
      margin-bottom=10px;
    }
    #box_encabezado_header {
      font-family: Verdana, sans-serif;
      font-size:16px;
    }
    table {
      font-size:12px;
      font-family    : Tahoma, sans-serif;
      border         : 1px solid #000;
      border-collapse: collapse;
      width:100%;
    }
    
    </style>
    </head><body>`;
  var style = ``;
  var postHtml = "</body>" + style + "</html>";
  var html = preHtml;

  var gra1 = document.getElementById("imgChartBar");
  var gra2 = document.getElementById("imgChartLine");
  var logo = document.getElementById("imgLogo");
  gra1.setAttribute("src", document.querySelector("#chartBar").toDataURL());
  gra2.setAttribute("src", document.querySelector("#chartLine").toDataURL());
  html += '<div class="box-tittle">' + logo.outerHTML;
  html += "<p>REPORTE DE EVALUACION DE EFECTIVIDAD DE MANEJO</p>";
  html += "</div>";
  html += document.getElementById("box_encabezado_header").outerHTML;
  html +=
    '<div class="banner">Resumen de puntaje por ambito</div>';
  html += document.getElementById("tabla_resumen").outerHTML;
  html += '<div class="banner">Resumen de indicadores</div>';
  html += document.getElementById("tabla_indicadores").outerHTML;
  html += '<div class="banner">Grafico resumen de indicadores</div>';
  html += '<div class="banner">'+gra1.outerHTML+'</div>';
  html +=
    '<div class="banner">Comparacion sobre la calidad de gestion</div>';
  html += document.getElementById("tabla_comparacion").outerHTML;
  html +=
    '<div class="banner">Comparacion temporal de calidad de gestion 5 años</div>';
  html += document.getElementById("tabla_comparacion2").outerHTML;
  html += '<div class="banner">Grafico estadistico temporal</h3></div>';
  html += '<div class="banner">'+gra2.outerHTML+'</div>';
  html += postHtml;
  var pdf = new jsPDF("p", "pt", "letter");
  margins = {
    top: 20,
    bottom: 20,
    left: 20,
    width: 625,
  };
  // all coords and widths are in jsPDF instance's declared units
  // 'inches' in this case
  pdf.fromHTML(
    html, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top,
    {
      // y coord
      width: margins.width, // max width of content on PDF
    },
    function (dispose) {
      // dispose: object with X, Y of the last line add to the PDF
      //          this allow the insertion of new lines after html
      pdf.save(filename);
    },
    margins
  );
}

function exportTable(table) {
  $(table).each(function () {
    var $table_v = $(this);
    var csv = $table_v.table2CSV({
      delivery: "value",
    });
    window.location.href =
      "data:text/csv;charset=UTF-8," + encodeURIComponent(csv);
  });
}
/* function Export2Doc(filename = "") {
  var preHtml =
    `<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title>
    <style>
    #box_encabezado_header {
      font-family: Arial;
    }
    .banner {
      font-family: Arial;
    }
    #tabla_resumen {
      font-family: Arial;
    }
    #tabla_indicadores {
      font-family: Arial;
    }
    table {
      font-family    : Arial;
      width          : 100%;
      border         : 1px solid #000;
      border-collapse: collapse;
    }
    th,
    td {
      vertical-align : top;
      text-align     : center;
      border         : 1px solid #000;
      border-collapse: collapse;
      padding        : 0.5px;
    }
    </style>
    </head><body>`;
  var style = ``;
  var postHtml = "</body>" + style + "</html>";
  var html = preHtml;
  
  var gra1 = document.getElementById("imgChartBar");
  var gra2 = document.getElementById("imgChartLine");
  gra1.setAttribute("src", document.querySelector("#chartBar").toDataURL());
  gra2.setAttribute("src", document.querySelector("#chartLine").toDataURL());
  
  html += document.getElementById("box_encabezado_header").outerHTML;
  html += '<div class="banner"><h3>RESUMEN DE PUNTAJE POR AMBITO</h3></div>';
  html += document.getElementById("tabla_resumen").outerHTML;
  html += '<div class="banner"><h3>ESCALA DE SATISFACCION</h3></div>';
  html += document.getElementById("tabla_indicadores").outerHTML;
  html +=
    '<div class="banner"><h3>GRAFICO DE ESCALA DE SATISFACCION</h3></div>';
  html += gra1.outerHTML;
  html +=
    '<div class="banner"><h3>COMPARACION SOBRE LA CALIDAD DE GESTION DE MANEJO AÑO ANTERIOR x AÑO ACTUAL</h3></div>';
  html += document.getElementById("tabla_comparacion").outerHTML;
  html +=
    '<div class="banner"><h3>COMPARACION TEMPORAL SOBRE LA CALIDAD DE GESTION DE MANEJO PERIODO 5 AÑOS</h3></div>';
  html += document.getElementById("tabla_comparacion2").outerHTML;
  html +=
    '<div class="banner"><h3>GRAFICO ESTADISTICO COMPARACION TEMPORAL</h3></div>';
  html += gra2.outerHTML;
  html += postHtml;
  //var html = preHtml+document.getElementById(element).innerHTML+postHtml;
  var blob = new Blob(["ufeff", html], {
    type: "application/msword",
  });
  // Specify link url
  var url =
    "data:application/vnd.ms-word;charset=utf-8," + encodeURIComponent(html);
  // Specify file name
  filename = filename ? filename + ".doc" : "document.doc";
  // Create download link element
  var downloadLink = document.createElement("a");
  document.body.appendChild(downloadLink);
  if (navigator.msSaveOrOpenBlob) {
    navigator.msSaveOrOpenBlob(blob, filename);
  } else {
    // Create a link to the file
    downloadLink.href = url;
    // Setting the file name
    downloadLink.download = filename;
    //triggering the function
    downloadLink.click();
  }
  document.body.removeChild(downloadLink);
} */

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
    $("#box_encabezado").hide(200);
  }
});

async function generalScale(id) {
  const resumen = await fetch(`${urlReport}?accion=generalScale&id=${id}`).then(
    (res) => res.json()
  );
  return resumen;
}

async function fillHead(id) {
  $("#box_encabezado").show(200);
  const { success, encabezado } = await fetch(
    `${url}?accion=get&id=${id}`
  ).then((res) => res.json());
  if (success) {
    var general = await generalScale(id);
    //alert(general);
    var data = parseFloat(general);
    var satisfaccion = "";
    if (data < 200) {
      satisfaccion = "No aceptable";
    } else if (data >= 200 && data < 400) {
      satisfaccion = "Poco aceptable";
    } else if (data >= 400 && data < 600) {
      satisfaccion = "Regular";
    } else if (data >= 600 && data < 800) {
      satisfaccion = "Aceptable";
    } else if (data > 800) {
      satisfaccion = "Satisfactorio";
    }
    $("#box_encabezado_header").html(
      "<h3><b>Area natural protegida: </b>" + encabezado[0].nombre +
      "</h3><h4><b>Fecha de evaluacion: </b>" +
      encabezado[0].fecha_evaluacion +
      "</h4><h4><b>Puntaje general: </b>" + general +
      "</h4><h4><b>Porcentaje general: </b>" +
      Math.round(general/10) + '%' +
      "</h4><h4><b>Escala de satisfaccion: </b>" +
      satisfaccion +
      "</h4>"
    );
    $.ajax({
      method: "GET",
      url: `${urlEvEn}?accion=listNom&idEn=${id}`,
      dataType: "json",
      contentType: "application/json; charset=utf-8",
      success: function (response) {
        var html = '';
        $.each(response["data"], function (id, valor) {
          var id_select = valor["id"];
          var name_select = valor["nombre_completo"];
          html += '<i class="fa fa-child"></i>&nbsp&nbsp'+name_select+'&nbsp&nbsp';
        });
        $("#box_encabezado_header").append('<h4><b>Evaluadores: </b>' + html + '</h4>');
      },
    });
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

async function getTHDates() {
  $('#th_actual').html($('#evaluacionRef').find(":selected").text());
  $('#th_ant').html($('#evaluacionComp').find(":selected").text());
}

const mulGraficarChartBar = async (id_ref,id_ant) => {
  const area = $("#area").val();
  const { data } = await fetch(
    `${urlReport}?accion=comparetionByHeaders&id=${id_ref}&id_ante=${id_ant}&id_ap=${area}`
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
          label: "PUNTAJE UCG",
          data: data.map((x) => x.ucg),
          backgroundColor: [
            "rgb(102, 0, 204,0.2)",
            "rgb(102, 0, 204,0.2)",
            "rgb(102, 0, 204,0.2)",
            "rgb(102, 0, 204,0.2)",
          ],
          borderColor: [
            "rgb(102, 0, 204)",
            "rgb(102, 0, 204)",
            "rgb(102, 0, 204)",
            "rgb(102, 0, 204)",
          ],
          borderWidth: 1,
        },
        {
          label: "EVALUACION ANTERIOR",
          data: data.map((x) => x.gas1),
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(255, 99, 132, 0.2)",
            "rgba(255, 99, 132, 0.2)",
            "rgba(255, 99, 132, 0.2)",
          ],
          borderColor: [
            "rgb(255, 99, 132)",
            "rgb(255, 99, 132)",
            "rgb(255, 99, 132)",
            "rgb(255, 99, 132)",
          ],
          borderWidth: 1,
        },
        {
          label: "EVALUACION ACTUAL",
          data: data.map((x) => x.gas2),
          backgroundColor: [
            "rgba(255, 205, 86, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(255, 205, 86, 0.2)",
          ],
          borderColor: [
            "rgb(255, 205, 86)",
            "rgb(255, 205, 86)",
            "rgb(255, 205, 86)",
            "rgb(255, 205, 86)",
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

async function reportComp(id,id_ant) {
  const area = $("#area").val();
  
  tabla_comparacion = await $("#tabla_comparacion").DataTable({
    destroy: true,
    autoWidth: false,
    responsive: true,
    ajax: {
      method: "GET",
      url: `${urlReport}?accion=comparetionByHeaders&id=${id}&id_ante=${id_ant}&id_ap=${area}`,
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
      { data: "ga5" },
      { data: "ga4" },
      { data: "ga3" },
      { data: "ga2" },
      { data: "ga1" },
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
      const { ucg, ga1, ga2, ga3, ga4, ga5, ga6 } = item;
      nuevoArray.push([
        { label: "UCG", data: ucg, producto: item.ambito },
        { label: "-1 EV", data: ga1, producto: item.ambito },
        { label: "-2 EV", data: ga2, producto: item.ambito },
        { label: "-3 EV", data: ga3, producto: item.ambito },
        { label: "-4 EV", data: ga4, producto: item.ambito },
        { label: "-5 EV", data: ga5, producto: item.ambito },
        { label: "ACTUAL", data: ga6, producto: item.ambito },
      ]);
    });

    const ucgArray = nuevoArray.map((item) => item[0]);
    const g1Array = nuevoArray.map((item) => item[1]);
    const g2Array = nuevoArray.map((item) => item[2]);
    const g3Array = nuevoArray.map((item) => item[3]);
    const g4Array = nuevoArray.map((item) => item[4]);
    const g5Array = nuevoArray.map((item) => item[5]);
    const g6Array = nuevoArray.map((item) => item[6]);

    const ucgDataset = {
      label: ucgArray[0].label,
      data: ucgArray.map((item) => Number(item.data)),
      backgroundColor: "rgba(102, 0, 204, 0.2)",
      borderColor: "rgb(102, 0, 204)",
      tension: 0.1,
      fill: false,
      hidden: false,
    };

    const g1Dataset = {
      label: g1Array[0].label,
      data: g1Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(255, 99, 132, 0.2)",
      borderColor: "rgb(255, 99, 132)",
      tension: 0.1,
      fill: false,
      hidden: false,
    };

    const g2Dataset = {
      label: g2Array[0].label,
      data: g2Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(255, 159, 64, 0.2)",
      borderColor: "rgb(255, 159, 64)",
      tension: 0.1,
      fill: false,
      hidden: false,
    };

    const g3Dataset = {
      label: g3Array[0].label,
      data: g3Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(255, 205, 86, 0.2)",
      borderColor: "rgb(255, 205, 86)",
      tension: 0.1,
      fill: false,
      hidden: false,
    };

    const g4Dataset = {
      label: g4Array[0].label,
      data: g4Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(75, 192, 192, 0.2)",
      borderColor: "rgb(75, 192, 192)",
      tension: 0.1,
      fill: false,
      hidden: false,
    };

    const g5Dataset = {
      label: g5Array[0].label,
      data: g5Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(150, 59, 158, 0.2)",
      borderColor: "rgba(150, 59, 158)",
      tension: 0.1,
      fill: false,
      hidden: false,
    };

    const g6Dataset = {
      label: g6Array[0].label,
      data: g6Array.map((item) => Number(item.data)),
      backgroundColor: "rgba(139, 240, 193, 0.2)",
      borderColor: "rgb(139, 240, 193)",
      tension: 0.1,
      fill: false,
      hidden: false,
    };

    datasets.push(ucgDataset);
    datasets.push(g5Dataset);
    datasets.push(g4Dataset);
    datasets.push(g3Dataset);
    datasets.push(g2Dataset);
    datasets.push(g1Dataset);
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

$("#area").change(async () => {
  //Modificar selector para que los temas mostrados solo sean los pendientes de evaluar
  const id_area = $("#area").val();
  const url = `../controlador/encabezado_reporte.controller.php`;
  if (id_area > 0) {
    const eva = await fetch(`${url}?accion=listByArea&id=${id_area}`).then(
      (res) => res.json()
    );
    let html = "";
    html += '<option value="0">Seleccione una evaluacion</option>';
    eva["data"].forEach((evaluacion) => {
      html += `<option value="${evaluacion.id}">${evaluacion.fecha_evaluacion}</option>`;
    });
    if (eva["data"].length > 0) {
      //$("#evaluacionRef").show(400);
      $("#evaluacionRef").html(html);
      //$("#evaluacionRef").trigger("change");
    } else {
      html = '<option value="0">Sin evaluaciones para ANP</option>';
      alert(
        "Sin evaluaciones",
        "No hay evaluaciones validadas para ANP",
        "info"
      );
      $("#evaluacionRef").html(html);
      $("#evaluacionComp").html(html);
      //$("#evaluacionRef").hide(400);
      //$("#evaluacionRef").val("").trigger("change");
    }
  }
});

$("#evaluacionRef").change(async () => {
  //Modificar selector para que los temas mostrados solo sean los pendientes de evaluar
  const id_area = $("#area").val();
  const id_ev = $("#evaluacionRef").val();
  const url = `../controlador/encabezado_reporte.controller.php`;
  if (id_area > 0) {
    const eva = await fetch(
      `${url}?accion=listPreviousByArea&id=${id_area}&id_ev=${id_ev}`
    ).then((res) => res.json());
    let html = "";
    html += '<option value="0">Seleccione una evaluacion</option>';
    eva["data"].forEach((evaluacion) => {
      html += `<option value="${evaluacion.id}">${evaluacion.fecha_evaluacion}</option>`;
    });
    if (eva["data"].length > 0) {
      //$("#evaluacionRef").show(400);
      $("#evaluacionComp").html(html);
      //$("#evaluacionRef").trigger("change");
    } else {
      html = '<option value="0">Sin evaluaciones previas para ANP</option>';
      alert("Sin evaluaciones", "No hay evaluaciones previas para ANP", "info");
      $("#evaluacionComp").html(html);
      //$("#evaluacionRef").hide(400);
      //$("#evaluacionRef").val("").trigger("change");
    }
  }
});

$("#btnCalc").click(()=> {
  const id_ref = $("#evaluacionRef").val();
  const id_ant = $("#evaluacionComp").val();
  goCalc(id_ref,id_ant);
})

async function goCalc(id_ref,id_ant) {

  //await fillEnEv(id_ref);
  await getTHDates();
  await fillHead(id_ref);
  await resumeTable(id_ref);
  await indicatorsTable(id_ref);
  await mulGraficarChartBar(id_ref,id_ant);
  await reportComp(id_ref,id_ant);
  await reportComp2(id_ref);
  await graficarChartLine(id_ref);
}

const exportToExcel = (idTabla) => {
  const tabla = document.getElementById(`${idTabla}`);
  let prop = null;
  const tableExport = new TableExport(tabla, {
    exportButtons: false, // No queremos botones
    filename: "Reporte", //Nombre del archivo de Excel
    sheetname: "Reporte", //Título de la hoja
  });
  const datos = tableExport.getExportData();
  if (idTabla === "tabla_resumen") {
    prop = datos.tabla_resumen.xlsx;
  } else if (idTabla === "tabla_indicadores") {
    prop = datos.tabla_indicadores.xlsx;
  } else if (idTabla === "tabla_comparacion") {
    prop = datos.tabla_comparacion.xlsx;
  } else if (idTabla === "tabla_comparacion2") {
    prop = datos.tabla_comparacion2.xlsx;
  }
  const preferenciasDocumento = prop;
  tableExport.export2file(
    preferenciasDocumento.data,
    preferenciasDocumento.mimeType,
    preferenciasDocumento.filename,
    preferenciasDocumento.fileExtension,
    preferenciasDocumento.merges,
    preferenciasDocumento.RTL,
    preferenciasDocumento.sheetname
  );
};
