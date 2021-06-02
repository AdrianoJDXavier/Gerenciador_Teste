<?php 
include_once('relatorio_teste_functions.php'); 
include_once('PHPExcel/Classes/PHPExcel.php');
$dados = getRelatorioExport();

$style_cabecalho = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('rgb' => '0000CD')
    ),
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFAFA'),
        'size'  => 12,
        'name'  => 'Verdana'
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
        )
    )
);

$style = array(
    'font'  => array(
        'color' => array('rgb' => '000000'),
        'size'  => 11,
        'name'  => 'Verdana'
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
        )
        ),
);

$planilha    =   new PHPExcel();
$planilha->setActiveSheetIndex(0);
$planilha->getActiveSheet()->getStyle('A1:I1')->applyFromArray($style_cabecalho);
$planilha->getActiveSheet()->SetCellValue('A1', 'ID');
$planilha->getActiveSheet()->SetCellValue('B1', 'ATENDENTE');
$planilha->getActiveSheet()->SetCellValue('C1', 'EXTRANET');
$planilha->getActiveSheet()->SetCellValue('D1', 'SOLICITACAO');
$planilha->getActiveSheet()->SetCellValue('E1', 'DATA TESTE');
$planilha->getActiveSheet()->SetCellValue('F1', 'DATA INSERCAO');
$planilha->getActiveSheet()->SetCellValue('G1', 'DATA VENCIMENTO');
$planilha->getActiveSheet()->SetCellValue('H1', 'TIPO TESTE');
$planilha->getActiveSheet()->SetCellValue('I1', 'OBSERVACOES');
 
  
$planilha->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);
 
$contador   =   2;
foreach($dados as $row){
    $planilha->getActiveSheet()->SetCellValue('A'.$contador, mb_strtoupper($row['id'],'UTF-8'));
    $planilha->getActiveSheet()->SetCellValue('B'.$contador, mb_strtoupper($row['atendente'],'UTF-8'));
    $planilha->getActiveSheet()->SetCellValue('C'.$contador, mb_strtoupper($row['extranet'],'UTF-8'));
    $planilha->getActiveSheet()->SetCellValue('D'.$contador, mb_strtoupper($row['num_solicitacao'],'UTF-8'));
    $planilha->getActiveSheet()->SetCellValue('E'.$contador, mb_strtoupper($row['data_teste'],'UTF-8'));
    $planilha->getActiveSheet()->SetCellValue('F'.$contador, mb_strtoupper($row['data_insercao'],'UTF-8'));
    $planilha->getActiveSheet()->SetCellValue('G'.$contador, mb_strtoupper($row['data_vencimento'],'UTF-8'));
    $planilha->getActiveSheet()->SetCellValue('H'.$contador, mb_strtoupper($row['tipo_teste'],'UTF-8'));
    $planilha->getActiveSheet()->SetCellValue('I'.$contador, utf8_encode(strip_tags($row['observacao'])));
    $planilha->getActiveSheet()->getStyle('A'.$contador.':I'.$contador)->applyFromArray($style);
    $contador++;
}

$celula = $planilha->getActiveSheet();
$celulaAtiva = $celula->getRowIterator()->current()->getCellIterator();
$celulaAtiva->setIterateOnlyExistingCells( true );
foreach( $celulaAtiva as $cell ) {
        $celula->getColumnDimension( $cell->getColumn() )->setAutoSize( true );
}

$objDown  =   new PHPExcel_Writer_Excel2007($planilha);
 
 
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); //mime type
header('Content-Disposition: attachment;filename="RELATORIO_TESTES.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objDown = PHPExcel_IOFactory::createWriter($planilha, 'Excel2007');  
$objDown->save('php://output');
?>