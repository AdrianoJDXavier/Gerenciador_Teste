<?php 
include_once('relatorio_teste_functions.php'); 
include_once('PHPExcel/Classes/PHPExcel.php');
$dados = getRelatorioExport();
/* echo "<pre>";
 print_r($dados);
 echo "<pre>";
 exit(); */
 $objPHPExcel    =   new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
 
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Country Code');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Country Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Capital');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Capital');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Capital');
 
$objPHPExcel->getActiveSheet()->getStyle("A1:C1")->getFont()->setBold(true);
 
$rowCount   =   2;
foreach($dados as $row){
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, mb_strtoupper($row['id'],'UTF-8'));
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, mb_strtoupper($row['atendente'],'UTF-8'));
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, mb_strtoupper($row['extranet'],'UTF-8'));
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, mb_strtoupper($row['num_solicitacao'],'UTF-8'));
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, mb_strtoupper($row['data_teste'],'UTF-8'));
    $rowCount++;
}
 
 
$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
 
 
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
header('Content-Disposition: attachment;filename="you-file-name.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');
?>