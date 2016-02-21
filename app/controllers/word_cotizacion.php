<?php

// EDITADO 23:04  PM

require_once '../PHPWord.php';
require "../conectar2.php";


$sql ="SELECT * FROM registro_equipo WHERE id='$_GET[id]'";
$stat = mysql_query($sql);
$rs = mysql_fetch_assoc($stat);
                                          
                                            $sql1 ="SELECT * FROM clientes WHERE id='$rs[Clientes_idClientes]'";
                                            $stat1 = mysql_query($sql1);
                                            $rs1 = mysql_fetch_assoc($stat1);

                                            $sql2 ="SELECT * FROM usuarios WHERE id='$rs[Usuarios_idUsuarios]'";
                                            $stat2 = mysql_query($sql2);
                                            $rs2 = mysql_fetch_assoc($stat2);
// New Word Document
$PHPWord = new PHPWord();

// New portrait section
$section = $PHPWord->createSection();


$styleTable = array('borderSize'=>6, 'borderColor'=>'000000', 'cellMargin'=>0);
//$styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'66BBFF');

$styleCell = array('valign'=>'center', 'bgColor'=>'D8D8D8');

$paragraphStyle = array('align' => 'center');
$header = $section->createHeader();

$styleTable = array('borderSize' => 6, 'borderColor' => '000000');
$PHPWord->addTableStyle('estilotabla', $styleTable);
$table1 = $header->addTable('estilotabla');
$table1->addRow();
$table1->addCell(2000)->addImage("../img/logo.jpg", array('width' => 150, 'height' => 60, 'align' => 'center'));
$cell = $table1->addCell(6000);
$cell->addText("COTIZACION Y PROGRAMA DE ACTIVIDADES DE INSPECCION",array('name'=>'Arial Narrow', 'size'=>16, 'bold'=>true),$paragraphStyle);
$cell->addText("AFERRUZ CONSULTORES Y AUDITORES E.I.R.L.",array('name'=>'Arial Narrow', 'size'=>10, 'bold'=>false),$paragraphStyle);
$cell = $table1->addCell(2000);
$cell->addText("",array('name'=>'Arial Narrow', 'size'=>16, 'bold'=>true),$paragraphStyle);
$cell->addText("Código FPSI02-2",array('name'=>'Arial Narrow', 'size'=>10, 'bold'=>false),$paragraphStyle);

// Add table
$PHPWord->addTableStyle('myOwnTableStyle', $styleTable);
$table = $section->addTable('myOwnTableStyle');



$table->addRow();
$table->addCell(3000)->addText("Señores", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3000)->addText($rs1[empresa],'',$paragraphStyle);

$table->addRow();
$table->addCell(3000)->addText("Objetivo General", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3000)->addText($rs[objetivogeneral],'',$paragraphStyle);


$table->addRow();
$table->addCell(3000)->addText("Fecha de Inspeccion", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3000)->addText($rs[fecharevision],'',$paragraphStyle);




$table->addRow();
$table->addCell(3000)->addText("Lugar de Ejecución", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3000)->addText($rs[lugarins],'',$paragraphStyle);

$table->addRow();
$table->addCell(3000)->addText("Horario de atención", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3000)->addText($rs[horarioatencion],'',$paragraphStyle);

$table->addRow();
$table->addCell(3000)->addText("Inspector Asignado", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3000)->addText($rs2[nombre]." ".$rs2[apellido],'',$paragraphStyle);




$section->addTextBreak();


$table = $section->addTable('myOwnTableStyle');
$table->addRow();

$cell = $table->addCell(200);
$cell->getStyle()->setGridSpan(4);
$cell->addText("                                                                                    PROCEDIMINETO APLICADO                                   ",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addRow();
$cell = $table->addCell(3000)->addText("Equipos de arrastre \n                 PAFIEA-01",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$cell = $table->addCell(3000)->addText("Puentes Grúas.                PAFIPG-01",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$cell = $table->addCell(3000)->addText("Grúas Móviles               PAFIGM-01",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$cell = $table->addCell(3000)->addText("Movimiento de Tierra \n          PAFIMT-01",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addRow();
$cell = $table->addCell(3000)->addText("",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$cell = $table->addCell(3000)->addText("",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$cell = $table->addCell(3000)->addText("",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$cell = $table->addCell(3000)->addText("",array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));





$section->addTextBreak();
$section->addText("Consideraciones del cliente para  la Actividad:", array('name'=>'Arial Narrow', 'size'=>11, 'bold'=>true));
$section->addText("Para cada actividad de inspección se requiere  que el equipo a inspeccionar  este limpio, cuente con combustible,  que el cliente disponga de  un operador titular, que el personal que participe en la actividad cuente con implementos de seguridad, que se considere el  espacio físico suficiente para hacer pruebas de funcionamiento del equipo y los permisos asociados. 
En particular, para la certificación de  equipos de izaje,  se debe coordinar directamente con el Gerente Técnico  Alejandro Ferruz (76686962) y consultar detalles de la actividad. 
De no cumplirse las consideraciones anteriores al momento de realizar la visita técnica, no se podrá completar la inspección, pero de igual forma se  cobrará la visita.
Visitas en las que por descoordinaciones del cliente puedan impedir la realización del servicio de inspección serán cobradas como servicio realizado.
No se realizarán inspecciones en las que se ponga en peligro la integridad de los participantes de la actividad.
Las no conformidades  encontradas en la visita de inspección deben ser regularizadas en un plazo máximo de 15 días una vez emitido el informe. De no ser justificado oportunamente  el retraso,  se procederá a invalidar  los resultados de la visita inicial y se cobrará por  una segunda visita nuevamente.
El inspector no está facultado para manipular o intervenir los equipos.
Compromisos:", array('name'=>'Arial Narrow', 'size'=>11, 'bold'=>false));

$section->addText("Compromisos:", array('name'=>'Arial Narrow', 'size'=>11, 'bold'=>true));
$section->addText("AFERRUZ se compromete a enviar un informe de las no conformidades un Certificado con una antelación a 48 horas. De no ser así, se justificará oportunamente al cliente.
AFERRUZ se compromete  a mantener la confidencialidad de los datos que se obtengan de sus clientes.
AFERRUZ se compromete a asegurar el cuidado de los  equipos y personas que colaboran  en la inspección, para eso se compromete a planificar en conjunto con el operador designado y supervisor a cargo toda actividad a realizar.
AFERRUZ  cuenta con fondos y reservas para asegurar la responsabilidad de sus trabajos y dispondrá de ellos si una vez desarrollada la investigación correspondiente  se determina responsabilidad de AFERRUZ.
Estos fondos y reservas serán utilizados para cubrir eventos que puedan ocurrir durante la inspección  y/o eventos que puedan ser derivados de una omisión, negligencia o error producto del servicio de inspección.
El tiempo de cobertura de este seguro de responsabilidad será desde el momento en que realiza inspección y se extenderá por el plazo un mes.
AFERRUZ no asume ninguna responsabilidad sobre equipos  que, una vez  inspeccionados y entregados al Cliente, presenten problemas producto de una operación inadecuada o que hayan sido intervenidos por personas ajenas a nuestro servicio.
AFERRUZ no asumirá responsabilidad por pérdidas o daños a equipos e instrumentos ocasionados por hechos fortuitos o de fuerza mayor, tales como robo, incendios, terremotos, inundaciones, traslados desde AFERRUZ  a cliente o viceversa, etc
Los fondos y reservas destinados  para asegurar nuestra responsabilidad aparecen declarados en nuestro manual de calidad, el cual está disponible de modo controlado en nuestras instalaciones de Tomas Davis  n°411 Salamanca.
Con la aceptación mediante el envió de Orden de compra, correo electrónico u otro documento formal, sin reparos y observaciones a la presente cotización, AFERRUZ dará por aceptados la totalidad de los puntos indicados en estas condiciones generales.
:", array('name'=>'Arial Narrow', 'size'=>11, 'bold'=>false));



$table = $section->addTable('myOwnTableStyle');

$table->addRow();
$table->addCell(3333)->addText("Razón Social", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3333)->addText("Aferruz Consultores y Auditores Ltda", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3333)->addText("RUT: 76654330-8", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));

$table->addRow();
$table->addCell(3333)->addText("Dirección", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3333)->addText("Tomas Davis 411, Salamanca", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3333)->addText("IV Región ", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));

$table->addRow();
$table->addCell(3333)->addText("Fonos", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3333)->addText("053-2553662", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3333)->addText("Cel: 76686962 ", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));
$table->addCell(3333)->addText("aferruz@aferruz.cl ", array('name'=>'Arial Narrow', 'size'=>9, 'bold'=>true));




// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save('wordcotizacion.docx');

//echo "<a href='Informe2.docx'>Descargar word</a>";
header("Location: wordcotizacion.docx");
?>