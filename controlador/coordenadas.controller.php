<?php

require_once '../modelo/coordenadas.class.php';
require_once '../helpers/helper.class.php';
//deleteheaderEvaluators
$cm = new Cord();
$hlp = new Helper();

if (isset($_POST) || isset($_GET)) {
    $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;

    $id_post = isset($_POST['id_cord']) ? (int)$hlp->clear($_POST['id_cord']) : false;
    $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;

    $id_a = isset($_POST['area']) ? $hlp->clear($_POST['area']) : false;
    $lat = isset($_POST['lat']) ? $hlp->clear($_POST['lat']) : false;
    $lon = isset($_POST['lon']) ? $hlp->clear($_POST['lon']) : false;

    if ($accion) {
        switch ($accion) {
            case 'list':
                $cords = $cm->getCords();
                if ($cords) {
                    print_r(json_encode($cords, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                } else {
                    print_r(json_encode([
                        "sEcho" => 1,
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => []
                    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }
                break;
            case 'create':
                if (!$id_a || !$lat || !$lon) {
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡Debe ingresar todos los datos!"
                    ]));
                } else {
                    $cord = $cm->createCord($id_a, $lat, $lon);
                    if ($cord) {
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Coordenada agregada correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡El Coordenada ya existe!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'get':
                if ($id_get) {
                    $cord = $cm->getCordById($id_get);
                    if ($cord) {
                        print_r(json_encode([
                            "success" => true,
                            "coordenada" => $cord
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "coordenada" => []
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'update':
                if (!$id_a || !$lat || !$lon || !$id_post) {
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡Debe ingresar todos los datos!"
                    ]));
                } else {
                    $cord = $cm->updateCord($id_a, $lat, $lon, $id_post);
                    if ($cord) {
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Coordenada actualizada correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡La Coordenada ya existe!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'delete':
                if ($id_get) {
                    $cord = $cm->deleteCord($id_get);
                    if ($cord) {
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Coordenada eliminada correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Hubo un problema al eiliminar la Coordenada!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'points':
                $cords = $cm->consultarPoints();
                $geojson = array(
                    'type'      => 'FeatureCollection',
                    'features'  => array()
                );
                foreach ($cords as $key => $data) {
                    $feature = array(
                        'type' => 'Feature',
                        # Pass other attribute columns here
                        'properties' => array(
                            'area' => $data['area'],
                            'fecha' => $data['fecha'],
                            'escala' => $data['escala'],
                            'longitud' => $data['lon'],
                            'latitud' => $data['lat'],
                            'satisfaccion' => $data['satisfaccion']
                        ),
                        'geometry' => array(
                            'type' => 'Point',
                            # Pass Longitude and Latitude Columns here
                            'coordinates' => [$data['lon'], $data['lat']],
                            'id' => $key
                        )
                    );
                    # Add feature arrays to feature collection array
                    array_push($geojson['features'], $feature);
                }
                echo json_encode($geojson);
                break;
            default:
                print_r(json_encode([
                    "success" => false,
                    "mensaje" => "¡Accion no encontrada!",
                ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                break;
        }
    }
}
