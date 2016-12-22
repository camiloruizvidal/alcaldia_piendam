<?php

class Visual
{

    public function Tabsmenu($ArrayTabs)
    {
        $html = '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
        $i    = 0;
        foreach ($ArrayTabs as $key => $temp)
        {
            $true = 'false';
            if ($i === 0)
            {
                $true = 'true';
            }
            $html .= '<div class="panel panel-primary">
                        <div class="panel-heading" role="tab" id="heading' . $i . '">
                            <h4 class="panel-title">';
            if ($i === 0)
            {
                $html .= '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $i . '" aria-expanded="true" aria-controls="collapse' . $i . '">';
            }
            else
            {
                $html .= '<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $i . '" aria-expanded="false" aria-controls="collapse' . $i . '">';
            }
            $html .= "\n" . $temp['head'] . '
                                </a>
                            </h4>
                        </div>
                        <div id="collapse' . $i . '" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading' . $i . '">
                            <div class="panel-body">
                                ' . $temp['body'] . '
                            </div>
                        </div>
                    </div>';
            $i++;
        }
        $html .= "\n" . '</div>';
        return $html;
    }

    public function Tabs($items, $contentItems)
    {
        $html   = '<ul class="nav nav-tabs" role="tablist">' . "\n";
        $contar = 1;
        foreach ($items as $key => $data)
        {
            $active = '';
            if ($contar === 1)
            {
                $active = ' active';
            }
            $html .= '<li class = "nav-item' . $active . '">
                        <a class = "nav-link' . $active . '" data-toggle = "tab" href = "#tab_' . $contar . '" role = "tab">' . $contar . ')' . $data['value'] . '</a>
                      </li>' . "\n";
            $contar++;
        }
        $html   .= '</ul>' . "\n";
        $html   .= '<div class = "tab-content">' . "\n";
        $true   = TRUE;
        $contar = 1;
        foreach ($contentItems as $key => $data)
        {

            $active = '';
            if ($true)
            {
                $active = ' active';
                $true   = FALSE;
            }

            $html .= '<div class = "tab-pane' . $active . '" id = "tab_' . $contar . '" role = "tabpanel">' . "\n";
            $html .= $data['value'] . "\n";
            $html .= '</div>' . "\n";
            $contar++;
        }
        $html .= '</div>' . "\n";
        return $html;
    }

    public function EliminarColumna($Datos, $Col)
    {
        $Res = array();
        foreach ($Datos as $temp)
        {
            $temp2 = array();
            for ($i = 0; isset($temp[$i]); $i++)
            {
                if ($Col != $i)
                {
                    $temp2[] = $temp[$i];
                }
            }
            if (count($temp2) > 0)
            {
                $Res[] = $temp2;
            }
        }
        return $Res;
    }

    public function Productos($Data)
    {
        $html = '';
        foreach ($Data as $temp)
        {
            $img    = $temp['imagen'];
            $id     = $temp['id_producto'];
            $titulo = $temp['descripcion'];
            $valor  = $temp['precio'];
            $valor  = '$' . number_format($valor);
            $html   .= '<div class="item  col-xs-4 col-lg-4">
                <div class="thumbnail">
                    <a href="producto_' . $id . '"><img class="img_product group list-group-image" src="' . $img . '" alt="" /></a>
                    <div class="caption simpleCart_shelfItem">
                        <a href="producto_' . $id . '"><h4 class="group inner list-group-item-heading item_name">' . $titulo . '</h4></a>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <a href="producto_' . $id . '">
                                    <label class="info">Precio: <span class="sub-total item_price" id="precio_' . $id . '"> ' . $valor . '</span></label>
                                </a>
                                <h4 class="info">Total: <span class="sub-total" id="total_' . $id . '"> ' . $valor . '</span></h4>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <button class="form form-control btn btn-circle btn-warning" onclick="addRemove(' . $id . ')" >
                                    <span class="glyphicon glyphicon-minus"></span>
                                </button>
                                <button class="form form-control btn btn-circle btn-primary"  onclick="addPlus(' . $id . ')"> 
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                                <input class="form form-control productos_save item_Quantity" type="number" id="product_cant_' . $id . '" value="1"/>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <span class="item_id">' . $id . '</span>
                                <button class="btn btn-success form form-control item_add" onclick="agregar(' . $id . ')">
                                    agregar
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </button>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <a href="producto_' . $id . '" class="btn btn-danger form form-control" >Detalle
                                    <i class="glyphicon glyphicon-option-horizontal"></i>
                                    </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>';
        }
        return $html;
    }

    public function input($type, $class, $id, $name, $value, $label, $sexo, $values = '')
    {
        switch ($sexo)
        {
            case NULL: $sexo = '';
                break;
            case '1': $sexo = 'men';
                break;
            case '2': $sexo = 'women';
                break;
        }

        $html = '';
        if ($class != '')
        {
            
        }
        if ($id != '')
        {
            $id = ' id="' . $id . '" ';
        }
        if ($type == 'text' || $type == 'textarea' || $type == 'datos_json')
        {
            $html .= '<div class="' . $sexo . 'form form-group col-lg-12">';
        }
        else
        {
            $html .= '<div class="' . $sexo . ' form form-group col-lg-6">';
        }
        if ($type == 'checkbox')
        {
            $html .= '<input ' . $id . ' type="' . $type . '" name="' . $name . '" style="opacity: inherit !important;" class="' . $class . '" value="1">';
            $html .= '<label style="margin-left: 20px;">' . $label . '</label>';
            $html .= '</div>';
        }
        else
        {
            if ($type == 'datos_json')
            {
                $html   .= '            <div class="element-select">
                <label class="title">' . $label . '</label>
                <div class="item-cont">
                    <div class="large">
                        <span>
                            <select ' . $id . ' name="' . $name . '" >
                                ';
                $values = json_decode($values);
                foreach ($values->values as $key => $value)
                {
                    $html .= '<option value="' . $key . '">' . $value . '</option>' . "\n";
                }

                $html .= '
                            </select>
                            <i></i>
   
                        </span>
                    </div>
                </div>
            </div>';
                $html .= '</div>';
            }
            else
            {
                if ($type == 'date')
                {
                    $class = 'fecha ' . $class;
                }
                $html .= '<label>' . $label . '</label>';
                $html .= '<input ' . $id . ' type="' . $type . '" name="' . $name . '" class="' . $class . '" value="' . $value . '">';
                $html .= '</div>';
            }
        }
        return $html;
    }

    public function Total($Datos, $id)
    {

        $Res = 0;
        if (!is_null($Datos))
        {
            foreach ($Datos as $Temp)
            {
                $Temp[$id] = str_replace(',', '', $Temp[$id]);
                $Temp[$id] = str_replace('$', '', $Temp[$id]);
                $Res       = $Res + $Temp[$id];
            }
        }
        return $Res;
    }

    public function FunctionTableBoton2($Datos, $id, $function, $NameComponent, $type)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<button class="btn btn-' . $type . ' form form-control" type="button" onclick="' . $function . '(\'' . $Datos[$i][$key] . '\')' . '"><span class="' . $NameComponent . '"></span></button>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function hrefTableBoton($Datos, $id, $Name, $NameComponent, $type)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<a href="' . $Name . $Datos[$i][$key] . '"><button style="width: auto !important;height: auto !important;" class="btn btn-' . $type . '" type="button" "><span class="' . $NameComponent . '"></span></button></a>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function FormatoMoneda($Datos, $id, $Simbolo = '')
    {
        $Res = array();
        if (!is_null($Datos))
        {
            foreach ($Datos as $Temp)
            {
                if (is_float($Temp[$id]))
                {
                    $Temp[$id] = $Simbolo . (number_format($Temp[$id], 2, '.', ','));
                }
                else
                {
                    $Temp[$id] = $Simbolo . (number_format($Temp[$id], 0, '.', ','));
                }
                $Res[] = $Temp;
            }
        }
        return $Res;
    }

    public function FormatoNumerico($Datos, $id, $Decimal = '', $Decenas = '')
    {
        $Res = array();
        if (!is_null($Datos))
        {
            foreach ($Datos as $Temp)
            {
                if (is_float($Temp[$id]))
                {
                    $Temp[$id] = (number_format($Temp[$id], 2, $Decimal, $Decenas));
                }
                else
                {
                    $Temp[$id] = (number_format($Temp[$id], 0, $Decimal, $Decenas));
                }
                $Res[] = $Temp;
            }
        }
        return $Res;
    }

    public function FunctionTable($Datos, $id, $function, $image)
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<a href="javascript:' . $function . '(' . $Temp . ')"><img src="' . $image . '"></a>';
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function Paginar($Tabla, $PaginaActual = '1', $NumeroPaginas = '0', $function = '', $Clase = 'pagination', $Agrupar = 10)
    {

        $Datos  = '<nav align="center"><ul class="' . $Clase . '"><li>';
        if ($PaginaActual > 1)
            $Datos  .= '<a href="javascript:' . $function . '(' . ($PaginaActual - 1) . ')" aria-label="Previous">';
        $Datos  .= '<span aria-hidden="true">&laquo;</span></a></li>';
        $inicio = 0;

        ##INI CODIGO DE LARA
        $Group             = $Agrupar;
        $inicio            = $PaginaActual - 4;
        $pages_for_consult = $NumeroPaginas;

        if ($inicio < 1)
        {
            $inicio = 1;
        }
        $fin = $inicio + $Group;
        if ($fin > $pages_for_consult)
        {
            $fin    = $pages_for_consult + 1;
            $inicio = $fin - $Group;
        }
        if ($inicio < 1)
        {
            $inicio = 1;
        }
        $html = '<ul class="pagination  pagination-lg">';
        if ($inicio > 1)
        {
            $html .= '<li><a href="pacientes_' . ($inicio - 2) . '.html">&laquo;     </a></li>';
        }
        ##FIN CODIGO DE LARA

        for ($i = $inicio; $i < $fin; $i++)
        {
            $Class = '';
            $p     = $i;
            if ($p == $PaginaActual)
                $Class = ' Class="active" ';
            $Datos .= '<li' . $Class . '><a href="javascript:' . $function . '(' . $p . ')">' . $p . '</a></li>';
        }
        $Datos .= '<li>';
        if (($PaginaActual) < $NumeroPaginas)
        {
            $Datos .= '<a href="javascript:' . $function . '(' . ($PaginaActual + 1) . ')" aria-label="Next">';
        }
        $Datos .= '<span aria-hidden="true">&raquo;</span></a></li></ul></nav>';
        return $Tabla . $Datos;
    }

    public function GenerardorLink($Url, $Click = '', $image = '', $texto = '')
    {
        $Script = '';
        if ($Click != '')
        {
            $Script = '<input src="' . $image . '" type="image" onclick="' . $Click . ';">';
        }
        else
        {
            if ($image != '')
                $Script = "<a href=\"$Url\"><img src=\"$image\"></a>";
            else
                $Script = "<a href=\"$Url\">$texto</a>";
        }
        return $Script;
    }

    public function Panel($datos, $class = '')
    {

        $Res = '<ul class="' . $class . '">';
        foreach ($datos as $Temp)
        {
            $Res .= '<li><a href="' . $Temp['url'] . '">' . $Temp['Text'] . '</a></li>';
        }
        $Res .= '</ul>';
        return $Res;
    }

    public function CambiarDatos($Datos, $Valores)
    {
        $Valor = "<table border=1>\n";
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Valor .= "<tr>";
            $Valor .= "<td>$Datos[$i]</td><td>$Valores[$i]</td>\n";
            $Valor .= "</tr>";
        }
        $Valor .= "</table>\n";
        return $Valor;
    }

    public function TextBox($nombre, $Valor = '', $id = '', $Class = '', $Type = 'Text')
    {
        if ($id != '')
        {
            $id = "id=\"$id\"";
        }
        if ($Class != '')
        {
            $Class = "class=\"$Class\"";
        }
        if ($Valor != '')
        {
            $Valor = " value=\"$Valor\" ";
        }
        return "<input name=\"$nombre\"	$id $Valor$Class type=\"$Type\" />";
    }

    private function CombinarColumnas($Datos, $ColumnasCombinar)
    {//No usar, no esta funcionando como se debe
        $tabla        = '';
        $Duplicado    = '';
        $DatosFinales = '';
        $Nombre       = array();
        $Cant         = array();
        $Anterior     = '';
        if ($ColumnasCombinar !== NULL && $ColumnasCombinar !== '')
        {
            foreach ($Datos as $Temp1)
            {
                $Temp2 = '';
                for ($i = 0; !empty($Temp1[$i]); $i++)
                {
                    if (in_array($i, $ColumnasCombinar))
                    {
                        $Temp2[$i] = $Temp1[$i];
                        $Cant[$i]  = 1;
                    }
                }
                $Nombre[] = $Temp2;
            }
        }
        for ($j = 0; $j < count($Datos); $j++)
        {
            $Temp3 = $Datos[$j];
            $tabla .= '<tr>';
            for ($i = 0; !empty($Temp3[$i]); $i++)
            {
                if ($ColumnasCombinar !== NULL && $ColumnasCombinar !== '')
                {

                    if (in_array($i, $ColumnasCombinar))
                    {
                        if ($j == 0)
                        {
                            $Anterior[$i] = $Nombre[$j][$i];
                        }
                        if (!empty($Anterior[$i]) && $Anterior[$i] == $Nombre[$j][$i])
                        {
                            $Cant[$i]      = $Cant[$i] + 1;
                            $Duplicado[$i] = '<td   rowspan="' . $Cant[$i] . '" VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                        }
                        else
                        {
                            $Anterior[$i]  = $Nombre[$j][$i];
                            $Cant[$i]      = 1;
                            $tabla         .= $Duplicado[$i];
                            $Duplicado[$i] = '<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                        }
                    }
                    else
                    {
                        $tabla .= '<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                    }
                }
                else
                {
                    $tabla .= '<td VALIGN="MIDDLE" align="center">' . $Temp3[$i] . '</td>';
                }
            }
            $tabla .= '</tr>';
        }
        $tabla .= "</table>";
        return $tabla;
    }

    public function Tabla2($Datos, $Border = '1', $Encabezado = '', $Class = '', $Id = '', $Contar = FALSE, $ColumnasCombinar = '', $Paginas = '', $NumPag = '', $color = '', $WIDTH = "100%")
    {
        if ((count($Datos) > 0 && $Datos[0] !== '' && $Datos !== NULL))
        {

            $count = 0;
            if ($Id != '')
            {
                $Id = " id=\"$Id\" ";
            }
            if ($Class != "")
            {
                $Class = " class=\"$Class\" ";
            }
            if ($Border != '')
            {
                $Border = " border=\"$Border\" ";
            }
            $WIDTH = 'WIDTH="' . $WIDTH . '"';
            $tabla = "<table$Border$Id$Class $WIDTH>\n";
            if ($Encabezado != '')
            {
                foreach ($Encabezado as $Temp)
                {
                    $tabla .= "<th><center>$Temp</center></th>";
                }
            }
            foreach ($Datos as $Temp1)
            {
                $colores = '';
                if ($color != '')
                {
                    $colores = ' style="background-color: ' . $Temp1[$color] . ';" ';
                }
                $tabla .= '<tr valign="top"' . $colores . '>';

                if ($Contar)
                {
                    $count++;
                    $tabla .= "<td valign=top align=\"center\">$count</td>";
                }
                foreach ($Temp1 as $Temp2)
                {

                    if ($color !== $i)
                    {
                        $tabla .= "<td valign=top align=\"center\">$Temp2</td>";
                    }
                }
                $tabla .= '</tr>';
            }
            $tabla .= "</table>";
            return $tabla;
        }
    }

    public function FunctionTableBoton($Datos, $id, $function, $NameComponent, $type, $name = '', $id_button = '')
    {
        for ($i = 0; $i < count($Datos); $i++)
        {
            foreach ($Datos[$i] as $key => $Temp)
            {
                if ($key == $id)
                {
                    @$html            = '<button id="' . $id_button . '" class="btn btn-' . $type . '" type="button" onclick="' . $function . '(' . $Datos[$i][$key] . ')' . '"><span class="' . $NameComponent . '"></span>' . $name . '</button>' . "\n";
                    $Datos[$i][$key] = $html;
                }
            }
        }
        return $Datos;
    }

    public function FormatoJsonTable($Datos)
    {
        $Res = array();
        if (gettype($Datos) === 'array')
        {
            foreach ($Datos as $Temp1)
            {
                $TempArray = array();
                foreach ($Temp1 as $Temp2)
                {
                    $TempArray[] = $Temp2;
                }
                $Res[] = $TempArray;
            }
            return $Res;
        }
    }

    public function Tabla($Datos, $Border = '1', $Encabezado = '', $Class = '', $Id = '', $Contar = FALSE, $ColumnasCombinar = '', $Paginas = '', $NumPag = '', $color = '', $WIDTH = "100%", $Aling = 'center')
    {
        if ((count($Datos) > 0 && $Datos[0] !== '' && !is_null($Datos)))
        {

            $count = 0;
            if ($Id != '')
            {
                $Id = " id=\"$Id\" ";
            }
            if ($Class != "")
            {
                $Class = " class=\"$Class\" ";
            }
            if ($Border != '')
            {
                $Border = " border=\"$Border\" ";
            }
            $WIDTH = 'WIDTH="' . $WIDTH . '"';
            $tabla = "<table$Border$Id$Class $WIDTH>\n";
                $tabla .= "<thead>" . "\n";
            if ($Encabezado != '')
            {
                foreach ($Encabezado as $Temp)
                {
                    $tabla .= "<th><center>$Temp</center></th>" . "\n";
                }
            }
                $tabla .= "</thead>" . "\n";
                $tabla .= "<tbody>" . "\n";
            foreach ($Datos as $key => $Temp1)
            {
                $colores = '';
                if ($color != '')
                {
                    $colores = ' style="background-color: ' . $Temp1[$color] . ';" ';
                }
                $tabla .= ' <tr valign="top"' . $colores . '>' . "\n";

                if ($Contar)
                {
                    $count++;
                    $tabla .= "     <td valign=top align=\"center\">$count</td>" . "\n";
                }
                foreach ($Temp1 as $i => $Temp2)
                {
                    if ($color !== $i)
                    {
                        $tabla .= "     <td valign=top align=\"{$Aling}\">$Temp2</td>" . "\n";
                    }
                }
                $tabla .= ' </tr>' . "\n";
            }
            $tabla .= "<tbody>" . "\n";
            $tabla .= "</table>" . "\n";
            return $tabla;
        }
    }

    public function TablaRecords($Datos, $Border = '1', $Encabezado = '', $Class = '', $Id = '', $Contar = FALSE, $ColumnasCombinar = '', $Paginas = '', $NumPag = '', $WIDTH = "100%", $Aling = 'center')
    {
        if ((count($Datos) > 0 && $Datos !== NULL))
        {

            $count = 0;
            if ($Id != '')
            {
                $Id = " id=\"$Id\" ";
            }
            if ($Class != "")
            {
                $Class = " class=\"$Class\" ";
            }
            if ($Border != '')
            {
                $Border = " border=\"$Border\" ";
            }
            $WIDTH = 'WIDTH="' . $WIDTH . '"';
            $tabla = "<table$Border$Id$Class $WIDTH>\n";
            if ($Encabezado != '')
            {
                foreach ($Encabezado as $Temp)
                {
                    $tabla .= "<th><center>$Temp</center></th>";
                }
            }
            foreach ($Datos as $Temp1)
            {
                if ($Contar)
                {
                    $count++;
                    $tabla .= "<td valign=top align=\"center\">$count</td>";
                }
                $tabla .= '<tr valign="top">';

                foreach ($Temp1 as $temp2)
                {
                    $tabla .= "<td valign=top align=\"{$Aling}\">$temp2</td>";
                }
                $tabla .= '</tr>';
            }
            $tabla .= "</table>";
            return $tabla;
        }
    }

    private function Inciar($Datos, $Value, $Valueid = '')
    {
        if ($Value == NULL && $Valueid == NULL)
        {
            $Valores = array();
            if ($Value !== FALSE)
            {
                $temp      = array(0 => '-1', 1 => 'SELECCIONE');
                $Valores[] = $temp;
            }
            for ($i = 0; $i < count($Datos); $i++)
            {
                $Valores[] = $Datos[$i];
            }
            $Datos = $Valores;
        }
        return $Datos;
    }

    public function Select($Datos, $Nombre = '', $Value = '', $id = '', $onchange = '', $Valueid = '', $Style = '', $class = '', $iniciarSelecione = true)
    {
        error_reporting(0);
        $Nombre = "name=\"$Nombre\"";
        if ($id != '' && $id != NULL)
        {
            $id = "id=\"$id\"";
        }
        if ($class != '')
        {
            $class = "class=\"$class\"";
        }
        if ($Style != '')
        {
            $Style = "style=\"$Style\"";
        }
        if ($onchange != '')
        {
            $onchange = " onchange=\"$onchange\"";
        }
        $Select = "<select $Nombre$id$onchange$class $Style>\n";
        $total  = count($Datos);
        if ($iniciarSelecione)
        {
            $Datos = $this->Inciar($Datos, $Value, $Valueid);
        }
        if ($total > 0 && $Datos != '')
        {
            foreach ($Datos as $key => $Temp)
            {
                $keys   = array_keys($Temp);
                $Select .= '	<option value="' . $Temp[$keys[0]] . '">' . $Temp[$keys[1]] . '</option>' . "\n";
            }
        }
        $Select .= '</select>';
        return $Select;
    }

    public function VerDatos($Datos)
    {
        $Res = '';
        for ($i = 0; $i < count($Datos); $i++)
        {
            $Res .= "'$Datos[$i]'";
            if ($i < count($Datos) - 1)
            {
                $Res .= ', ';
            }
        }
        return $Res;
    }

}

?>
