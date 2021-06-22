<?php
require_once 'conexao.php';

function db_query($sql){
    global $con;
    return $con->query($sql);
}

function db_fetch_array($rs){
    if(!empty($rs)){
    return $rs->fetch_array();
    }
}

function getAtendentes(){
    $sql = "SELECT 
                id,nome
            FROM
                atendentes
            WHERE
                ativo = 'S' ORDER BY nome";
    $result = db_query($sql);
    if(!empty($result)){
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}

function getExtranets(){
    $sql = "SELECT 
                id, nome
            FROM
                extranet
            ORDER BY nome";
    $result = db_query($sql);
    if(!empty($result)){
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}

function insertTeste($id_atendente, $id_extranet, $id_tester, $num_solicitacao, $data_insercao, $data_vencimento, $link, $observacoes, $tipo_teste){
    empty($data_vencimento) ? $data_vencimento = 'NULL' : $data_vencimento = "'".$data_vencimento."'";
 
    $tipo_teste = utf8_encode($tipo_teste);
    $observacoes = utf8_encode($observacoes);
    $sql = "INSERT INTO relatorio_teste(id_atendente, id_extranet, id_tester, num_solicitacao, data_insercao, data_vencimento, data_teste, link, observacoes, tipo_teste) VALUES($id_atendente, $id_extranet, $id_tester, $num_solicitacao, '$data_insercao', $data_vencimento, NOW(), '$link', '$observacoes', '$tipo_teste')";
    
    db_query($sql);
}

function getRelatorioExport(){
  session_start();
    $filtro = getFiltros();
    $sql = "SELECT 
            r.id,
            a.nome AS atendente,
            e.nome AS extranet,
            r.num_solicitacao AS num_solicitacao,
            DATE_FORMAT(r.data_teste, '%d/%m/%Y') AS data_teste,
            DATE_FORMAT(r.data_insercao, '%d/%m/%Y') AS data_insercao,
            DATE_FORMAT(r.data_vencimento, '%d/%m/%Y') AS data_vencimento,
            r.tipo_teste as tipo_teste,
            r.observacoes as observacao,
            r.link AS link,
            e.nome_bd AS nome_db
            FROM
            relatorio_teste AS r
                JOIN
            atendentes AS a ON a.id = r.id_atendente
                JOIN
            extranet AS e ON e.id = r.id_extranet
                WHERE 1 = 1 $filtro ORDER BY r.id DESC";
    
    $result = db_query($sql);
    if(!empty($result)){
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}

function getRelatorio($id){
    $sql = "SELECT 
            r.id,
            a.nome AS atendente,
            e.nome AS extranet,
            a2.nome AS tester,
            r.num_solicitacao AS num_solicitacao,
            DATE_FORMAT(r.data_teste, '%d/%m/%Y') AS data_teste,
            DATE_FORMAT(r.data_insercao, '%d/%m/%Y') AS data_insercao,
            DATE_FORMAT(r.data_vencimento, '%d/%m/%Y') AS data_vencimento,
            r.tipo_teste as tipo_teste,
            r.observacoes as observacao,
            r.link AS link,
            e.nome_bd AS nome_db
            FROM
            relatorio_teste AS r
                JOIN
            atendentes AS a ON a.id = r.id_atendente
                JOIN
            atendentes AS a2 ON a2.id = r.id_tester
                JOIN
            extranet AS e ON e.id = r.id_extranet
                WHERE r.id = $id";
    $result = db_query($sql);
    if(!empty($result)){
        return db_fetch_array($result);
    }
    return NULL;
}

function getAtendentesMaisAtivos(){
  $filtro = getFiltros();
  $condição = utf8_encode('Inspeção');
    $sql = "SELECT 
                a.nome AS nome, COUNT(*) AS num_solicitacoes
            FROM
                relatorio_teste AS r
                    JOIN
                atendentes AS a ON a.id = r.id_atendente
            WHERE
                r.tipo_teste = '$condição' $filtro
            GROUP BY a.nome ORDER BY COUNT(*) DESC LIMIT 8";
    $result = db_query($sql);
    if(!empty($result)){
        $return_array = array();
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}

function getExtranetsMaisAtivos(){
  $filtro = getFiltros();
    $sql = "SELECT 
                e.nome AS nome, COUNT(*) AS num_solicitacoes
            FROM
                relatorio_teste AS r
                    JOIN
                extranet AS e ON e.id = r.id_extranet
            WHERE
                r.tipo_teste = 'Teste' $filtro
            GROUP BY e.nome ORDER BY COUNT(*) DESC LIMIT 8";
    $result = db_query($sql);
    if(!empty($result)){
        $return_array = array();
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}

function getAtendentesAtradados(){
    $filtro = getFiltros();
    $condição = utf8_encode('Inspeção');
      $sql = "SELECT 
                a.nome AS nome,
                COUNT(*) AS num_solicitacoes
            FROM
                relatorio_teste AS r
                    JOIN
                atendentes AS a ON a.id = r.id_atendente
            WHERE
                r.tipo_teste = '$condição'
                    AND data_insercao >= data_vencimento $filtro
              GROUP BY a.nome ORDER BY COUNT(*) DESC";
      $result = db_query($sql);
      if(!empty($result)){
          $return_array = array();
          while( $row = db_fetch_array($result)){
              $return_array[] = $row;
          }
          return $return_array;
      }
      return NULL;
  }

  function getExtranetsMaiorReteste(){
    $filtro = getFiltros();
      $sql = "SELECT 
                CONCAT(e.nome, ' #', r.num_solicitacao) AS nome,
                COUNT(*) AS num_solicitacoes
            FROM
                relatorio_teste AS r
                    JOIN
                extranet AS e ON e.id = r.id_extranet
            WHERE
                r.tipo_teste = 'Reteste' $filtro
              GROUP BY e.nome ORDER BY COUNT(*) DESC LIMIT 10";
              
      $result = db_query($sql);
      if(!empty($result)){
          $return_array = array();
          while( $row = db_fetch_array($result)){
              $return_array[] = $row;
          }
          return $return_array;
      }
      return NULL;
  }

function getTestesDiario(){
    $filtro = getFiltros();
    $sql = "SELECT 
                DATE_FORMAT(data_teste, '%d/%m/%Y') AS 'Dia',
                data_teste,
                (SELECT COUNT(*) FROM relatorio_teste AS r WHERE tipo_teste = 'Teste' and DATE_FORMAT(data_teste, '%d/%m/%Y') = Dia $filtro) AS teste,
                (SELECT COUNT(*) FROM relatorio_teste AS r WHERE tipo_teste = 'Inspecao' and DATE_FORMAT(data_teste, '%d/%m/%Y') = Dia $filtro) AS inspecao,
                (SELECT COUNT(*) FROM relatorio_teste AS r WHERE tipo_teste = 'Reteste' and DATE_FORMAT(data_teste, '%d/%m/%Y') = Dia $filtro) AS reteste,
                (SELECT COUNT(*) FROM relatorio_teste AS r WHERE tipo_teste = 'Reinspecao' and DATE_FORMAT(data_teste, '%d/%m/%Y') = Dia $filtro) AS reinspecao
            FROM
                relatorio_teste AS r
            WHERE 1 = 1 $filtro
            GROUP BY Dia ORDER BY data_teste DESC LIMIT 15";

    $result = db_query($sql);
    if(!empty($result)){
        $return_array = array();
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}

function getFiltros(){
    $filtros = '';

    if(isset($_SESSION['filtro_teste_extranet']) && !empty($_SESSION['filtro_teste_extranet'])){
        $filtros .= " AND r.id_extranet = ".$_SESSION['filtro_teste_extranet'];
      }
      if(isset($_SESSION['filtro_teste_atendente']) && !empty($_SESSION['filtro_teste_atendente'])){
        $filtros .= " AND r.id_atendente = ".$_SESSION['filtro_teste_atendente'];
      }
      if(isset($_SESSION['filtro_teste_tester']) && !empty($_SESSION['filtro_teste_tester'])){
        $filtros .= " AND r.id_tester = ".$_SESSION['filtro_teste_tester'];
      }
      if(isset($_SESSION['filtro_teste_tipo_teste']) && !empty($_SESSION['filtro_teste_tipo_teste'])){
        $filtros .= " AND r.tipo_teste = '".utf8_encode($_SESSION['filtro_teste_tipo_teste'])."'";
      }
      if(isset($_SESSION['filtro_teste_inicio']) && !empty($_SESSION['filtro_teste_inicio'])){
        $filtros .= " AND r.data_teste >= '".$_SESSION['filtro_teste_inicio']."'";
      }
      if(isset($_SESSION['filtro_teste_fim']) && !empty($_SESSION['filtro_teste_fim'])){
        $filtros .= " AND r.data_teste <= '".$_SESSION['filtro_teste_fim']."'";
      }

    return $filtros;
}
?>