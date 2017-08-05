<?php

/**
 * @file
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $caption: The caption for this table. May be empty.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $classes: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 * @ingroup views_templates
 */
?>


<?php

  global $base_url;

?>



<table <?php if ($classes) { print 'class="'. $classes . '" '; } ?><?php print $attributes; ?>>

<?php 
print "a per";

  if(isset($view->exposed_raw_input["field_fecha_de_carga_value"]["value"]) && isset($view->exposed_raw_input["field_fecha_de_carga_value_1"]["value"])){
    if(isset($view->exposed_raw_input["field_fecha_de_carga_value"]["value"])){
      if(isset($view->exposed_raw_input["field_fecha_de_carga_value_1"]["value"])){
        $fecha_final = $view->exposed_raw_input["field_fecha_de_carga_value_1"]["value"];
        
        $porciones = explode("-", $fecha_final);
        $anio = $porciones[0];
        $mes = $porciones[1];
        $dia = $porciones[2];

        $fecha_archivo = $anio . $mes . $dia;

      }else{
        $fecha_final = '<p class="bg-warning"><b>No hay seleccionada una fecha de inicio o una fecha de finalización, hasta que no seleccione ambas fechas no se generará el informe para descargar</b></p>';
      }
    }else{
      $fecha_final = '<p class="bg-warning"><b>No hay seleccionada una fecha de inicio o una fecha de finalización, hasta que no seleccione ambas fechas no se generará el informe para descargar</b></p>';
    }
  }else{
    $fecha_final = '<p class="bg-warning"><b>No hay seleccionada una fecha de inicio o una fecha de finalización, hasta que no seleccione ambas fechas no se generará el informe para descargar</b></p>';
  }  

  print '<div class="fecha">' . $fecha_final . '</div>';


  if(isset($fecha_archivo)){
    $myfile = fopen("sites/default/files/archivos/EBT_TOYASRL_".$fecha_archivo.".txt", "w") or die("Unable to open file!");
    chmod($_SERVER['DOCUMENT_ROOT'] . "/sites/default/files/archivos/EBT_TOYASRL_".$fecha_archivo.".txt", 0777);
  }

  $i = 0;
  foreach($view->result as $resultado){
		print '<tr>';
    if(isset($resultado->_field_data["nid"]["entity"]->field_codigo_interno_banco["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_codigo_interno_banco["und"][0]["value"] != ''){
      $field_codigo_interno_banco = $resultado->_field_data["nid"]["entity"]->field_codigo_interno_banco["und"][0]["value"];
      $field_codigo_interno_banco = str_pad($field_codigo_interno_banco, 2, 0, STR_PAD_LEFT);
      print '<td>' . $field_codigo_interno_banco . '</td>';
    }else{
      $field_codigo_interno_banco = 00;      
      print '<td></td>';
    }

    if(isset($resultado->_field_data["nid"]["entity"]->field_fecha_vencimiento["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_fecha_vencimiento["und"][0]["value"] != ''){
      $field_fecha_vencimiento = $resultado->_field_data["nid"]["entity"]->field_fecha_vencimiento["und"][0]["value"];
      $field_fecha_vencimiento = str_pad($field_fecha_vencimiento, 8, 0, STR_PAD_LEFT);
      print '<td>' . $field_fecha_vencimiento . '</td>';
    }else{
      $field_fecha_vencimiento = 00000000;      
      print '<td></td>';
    }

    if(isset($resultado->_field_data["nid"]["entity"]->field_referencia_interna_transac["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_referencia_interna_transac["und"][0]["value"] != ''){
      $field_referencia_interna_transac = $resultado->_field_data["nid"]["entity"]->field_referencia_interna_transac["und"][0]["value"];
      $field_referencia_interna_transac = str_pad($field_referencia_interna_transac, 6, 0, STR_PAD_LEFT);
      print '<td>' . $field_referencia_interna_transac . '</td>';
    }else{
      $field_referencia_interna_transac = 000000;      
      print '<td></td>';
    }

    if(isset($resultado->_field_data["nid"]["entity"]->field_identificador_del_cliente["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_identificador_del_cliente["und"][0]["value"] != ''){
      $field_identificador_del_cliente = $resultado->_field_data["nid"]["entity"]->field_identificador_del_cliente["und"][0]["value"];
      $field_identificador_del_cliente = str_pad($field_identificador_del_cliente, 7, 0, STR_PAD_RIGHT); //VER QUE ONDA LOS ESPACIOS
      print '<td>' . $field_identificador_del_cliente . '</td>';
    }else{
      $field_identificador_del_cliente = 0000000;      
      print '<td></td>';
    }

    if(isset($resultado->_field_data["nid"]["entity"]->field_tipo_de_moneda["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_tipo_de_moneda["und"][0]["value"] != ''){
      $field_tipo_de_moneda = $resultado->_field_data["nid"]["entity"]->field_tipo_de_moneda["und"][0]["value"];
      $field_tipo_de_moneda = str_pad($field_tipo_de_moneda, 1, 'P', STR_PAD_RIGHT);
      print '<td>' . $field_tipo_de_moneda . '</td>';
    }else{
      $field_tipo_de_moneda = 'P';      
      print '<td></td>';
    }

    if(isset($resultado->_field_data["nid"]["entity"]->field_cbu_bloque_1["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_cbu_bloque_1["und"][0]["value"] != ''){
      $field_cbu_bloque_1 = $resultado->_field_data["nid"]["entity"]->field_cbu_bloque_1["und"][0]["value"];
      $field_cbu_bloque_1 = str_pad($field_cbu_bloque_1, 8, '0', STR_PAD_LEFT);
      print '<td>' . $field_cbu_bloque_1 . '</td>';
    }else{
      $field_cbu_bloque_1 = 00000000;      
      print '<td></td>';
    }

    if(isset($resultado->_field_data["nid"]["entity"]->field_cbu_bloque_2["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_cbu_bloque_2["und"][0]["value"] != ''){
      $field_cbu_bloque_2 = $resultado->_field_data["nid"]["entity"]->field_cbu_bloque_2["und"][0]["value"];
      $field_cbu_bloque_2 = str_pad($field_cbu_bloque_2, 14, '0', STR_PAD_LEFT);
      print '<td>' . $field_cbu_bloque_2 . '</td>';
    }else{
      $field_cbu_bloque_2 = 00000000000000;      
      print '<td></td>';
    }
    
    if(isset($resultado->_field_data["nid"]["entity"]->field_importe["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_importe["und"][0]["value"] != ''){
      $field_importe = $resultado->_field_data["nid"]["entity"]->field_importe["und"][0]["value"];
      $field_importe = str_pad($field_importe, 10, '0', STR_PAD_LEFT);
      print '<td>' . $field_importe . '</td>';
    }else{
      $field_importe = 0000000000;      
      print '<td></td>';
    }
        
    if(isset($resultado->_field_data["nid"]["entity"]->field_cuit_de_la_empresa["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_cuit_de_la_empresa["und"][0]["value"] != ''){
      $field_cuit_de_la_empresa = $resultado->_field_data["nid"]["entity"]->field_cuit_de_la_empresa["und"][0]["value"];
      $field_cuit_de_la_empresa = str_pad($field_cuit_de_la_empresa, 11, '0', STR_PAD_LEFT);
      print '<td>' . $field_cuit_de_la_empresa . '</td>';
    }else{
      $field_cuit_de_la_empresa = 00000000000;      
      print '<td></td>';
    }
    
    if(isset($resultado->_field_data["nid"]["entity"]->field_descripcion_de_la_prestaci["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_descripcion_de_la_prestaci["und"][0]["value"] != ''){
      $field_descripcion_de_la_prestaci = $resultado->_field_data["nid"]["entity"]->field_descripcion_de_la_prestaci["und"][0]["value"];
      $field_descripcion_de_la_prestaci = str_pad($field_descripcion_de_la_prestaci, 10, ' ', STR_PAD_RIGHT);
      print '<td>' . $field_descripcion_de_la_prestaci . '</td>';
    }else{
      $field_descripcion_de_la_prestaci = '          ';      
      print '<td></td>';
    }
    
    if(isset($resultado->_field_data["nid"]["entity"]->field_referencia_univoca_del_deb["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_referencia_univoca_del_deb["und"][0]["value"] != ''){
      $field_referencia_univoca_del_deb = $resultado->_field_data["nid"]["entity"]->field_referencia_univoca_del_deb["und"][0]["value"];
      $field_referencia_univoca_del_deb = str_pad($field_referencia_univoca_del_deb, 15, ' ', STR_PAD_RIGHT);
      print '<td>' . $field_referencia_univoca_del_deb . '</td>';
    }else{
      $field_referencia_univoca_del_deb = '               ';      
      print '<td></td>';
    }

    if(isset($resultado->_field_data["nid"]["entity"]->field_referencia_interna_tran["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_referencia_interna_tran["und"][0]["value"] != ''){
      $field_referencia_interna_tran = $resultado->_field_data["nid"]["entity"]->field_referencia_interna_tran["und"][0]["value"];
      $field_referencia_interna_tran = str_pad($field_referencia_interna_tran, 15, ' ', STR_PAD_RIGHT);
      print '<td>' . $field_referencia_interna_tran . '</td>';
    }else{
      $field_referencia_interna_tran = '               ';      
      print '<td></td>';
    }
    
    if(isset($resultado->_field_data["nid"]["entity"]->field_nuevo_identificador_del_cl["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_nuevo_identificador_del_cl["und"][0]["value"] != ''){
      $field_nuevo_identificador_del_cl = $resultado->_field_data["nid"]["entity"]->field_nuevo_identificador_del_cl["und"][0]["value"];
      $field_nuevo_identificador_del_cl = str_pad($field_nuevo_identificador_del_cl, 22, ' ', STR_PAD_RIGHT);
      print '<td>' . $field_nuevo_identificador_del_cl . '</td>';
    }else{
      $field_nuevo_identificador_del_cl = '                      ';      
      print '<td></td>';
    }
        
    if(isset($resultado->_field_data["nid"]["entity"]->field_codigo_de_rechazo["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_codigo_de_rechazo["und"][0]["value"] != ''){
      $field_codigo_de_rechazo = $resultado->_field_data["nid"]["entity"]->field_codigo_de_rechazo["und"][0]["value"];
      $field_codigo_de_rechazo = str_pad($field_codigo_de_rechazo, 3, ' ', STR_PAD_RIGHT);
      print '<td>' . $field_codigo_de_rechazo . '</td>';
    }else{
      $field_codigo_de_rechazo = '   ';      
      print '<td></td>';
    }

    if(isset($resultado->_field_data["nid"]["entity"]->field_nombre_empresa["und"][0]["value"]) && $resultado->_field_data["nid"]["entity"]->field_nombre_empresa["und"][0]["value"] != ''){
      $field_nombre_empresa = $resultado->_field_data["nid"]["entity"]->field_nombre_empresa["und"][0]["value"];
      $field_nombre_empresa = str_pad($field_nombre_empresa, 16, ' ', STR_PAD_RIGHT);
      print '<td>' . $field_nombre_empresa . '</td>';
    }else{
      $field_nombre_empresa = '                ';      
      print '<td></td>';
    }

		print '</tr>';        



    $txt =  
      $field_codigo_interno_banco . 
      $field_fecha_vencimiento . 
      $field_referencia_interna_transac . 
      $field_identificador_del_cliente . 
      $field_tipo_de_moneda . 
      $field_cbu_bloque_1 .
      $field_cbu_bloque_2 .
      $field_importe .
      $field_cuit_de_la_empresa .
      $field_descripcion_de_la_prestaci .
      $field_referencia_univoca_del_deb .
      $field_referencia_interna_tran .
      $field_nuevo_identificador_del_cl .
      $field_codigo_de_rechazo .
      $field_nombre_empresa;

    if(isset($fecha_archivo)){
      fwrite($myfile, $txt . PHP_EOL);
    }

    $i++;

    if(!isset($fecha_archivo)){
      if($i == 40){
        print '<div class="contenedor_mensaje_mas_de_40"><p class="bg-success"><b>La vista está mostrando solo los últimos 40 registros hasta que se asigne un filtro de fecha, esto sucede para no cargar todas las ventas y ocupar la memoria del sistema, si el filtro de fecha está seleccionado se mostraran todas las ventas que estén contempladas en el filtro independientemente de que excedan las 40.</b></p></div>';
        break;
      }
    }  
  
  }

  print '<div class="mensaje_coincidencias_encontradas">Cantidad de coincidencias encontradas: ' . $i . '</div>';

  if(isset($fecha_archivo)){
    fclose($myfile);    

    $ruta_archivo = $base_url.'/sites/default/files/archivos/EBT_TOYASRL_'.$fecha_archivo.'.txt';
    $filename = "EBT_TOYASRL_".$fecha_archivo.".txt";

    print '<a href="'.$ruta_archivo.'" download="'.$filename.'">';
      print 'BAJAR';
    print '</a>';

  }




?>


</table>

