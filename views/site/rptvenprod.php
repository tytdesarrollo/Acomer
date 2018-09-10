<?php 
	date_default_timezone_set("America/Bogota");
	$fecha = date('d/m/Y-H:i:s');
	
	header('Content-type: application/vnd.ms-excel');
	header("Content-Disposition: attachment; filename=REPORTE_VENTAS_PRODUCTO_".$fecha.".xls"); //Indica el nombre del archivo resultante
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<table border="1">
	<thead>
		<?php
			if ($codi_empre <> ''){
				echo '<tr><td align="center" colspan="3" bgcolor="#52A745"><font size="4"><strong>REPORTE DE VENTAS POR PRODUCTO</strong></font></td></tr>';
				echo '<tr><td align="center" colspan="3"><strong>EMPRESA:</strong> <font size="3" color="blue"><strong>'.$datos_rptvenprod[0]['EMPRESA'].'</strong></font></td></tr>';
				echo '<tr><td align="center" colspan="3"><strong>DESDE: <font color="blue">'.$fech_ini.'</font> - HASTA: <font color="blue">'.$fech_fin.'</font></strong></td></tr>';
			}else {
				echo '<tr><td align="center" colspan="4" bgcolor="#52A745"><font size="4"><strong>REPORTE DE VENTAS POR PRODUCTO</strong></font></td></tr>';
				echo '<tr><td align="center" colspan="4"><font size="4" color="blue"><strong>TODAS LAS EMPRESAS</strong></font></td></tr>';
				echo '<tr><td align="center" colspan="4"><strong>DESDE: <font color="blue">'.$fech_ini.'</font> - HASTA: <font color="blue">'.$fech_fin.'</font></strong></td></tr>';
			}

			if ($codi_empre <> ''){
				echo '<tr>
						<th bgcolor="#929497">PRODUCTO</th>
						<th bgcolor="#929497">CANTIDAD</th>
						<th bgcolor="#929497">TOTAL</th>
					</tr>';
			}else{
				echo '<tr>
						<th bgcolor="#929497">EMPRESA</th>
						<th bgcolor="#929497">PRODUCTO</th>
						<th bgcolor="#929497">CANTIDAD</th>
						<th bgcolor="#929497">TOTAL</th>
					</tr>';
			} ?>
	</thead>
	<tbody>
		<?php
			if ($codi_empre <> ''){
				for ($contador = 0; $contador < count($datos_rptvenprod); $contador++) {
					echo '<tr>
							<td>'.$datos_rptvenprod[$contador]['NOM_PROD'].'</td>
							<td>'.$datos_rptvenprod[$contador]['CANTIDAD'].'</td>
							<td>'.$datos_rptvenprod[$contador]['VLT_TOTAL'].'</td>
					</tr>';
				}
			}else{
				for ($contador = 0; $contador < count($datos_rptvenprod); $contador++) {
					echo '<tr>
							<td>'.$datos_rptvenprod[$contador]['EMPRESA'].'</td>
							<td>'.$datos_rptvenprod[$contador]['NOM_PROD'].'</td>
							<td>'.$datos_rptvenprod[$contador]['CANTIDAD'].'</td>
							<td>'.$datos_rptvenprod[$contador]['VLT_TOTAL'].'</td>
					</tr>';
				}
			}
		?>
	</tbody>	
</table>