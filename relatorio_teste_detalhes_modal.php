
<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
require_once 'relatorio_teste_functions.php';
$relatorio_teste = getRelatorio($_POST['id']);
$relatorio_teste['data_vencimento'] == '00/00/0000' ? $vencimento = 'Não datado' : $vencimento = $relatorio_teste['data_vencimento'];
?>
<style>
.modal-dialog{
    max-width: 80% !important;
    max-height:60% !important;
  }
  .modal-content{
    -webkit-box-shadow: 5px 5px 10px 1px rgba(1,6,23,0.62); 
    box-shadow: 5px 5px 10px 1px rgba(1,6,23,0.62);
    border-radius: 10px;
  }
  .close{
      color: #DC143C;
  }
  .close:hover{
      color:#800000;
  }
</style>
<div class="modal" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">DETALHES</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="atendente">Atendente:</label>
                    <input type="text" class="form-control" name="atendente" value="<?= utf8_decode( $relatorio_teste['atendente'])?>" disabled>
                </div>    
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="extranet">Extranet:</label>
                    <input type="text" class="form-control" name="extranet" value="<?= utf8_decode( $relatorio_teste['extranet'])?>" disabled>
                </div>    
            </div>
          </div>
          <div class="row">
              <div class="col-4">
                  <div class="form-group">
                      <label for="tester">Tester:</label>
                      <input type="text" class="form-control" name="tester" value="<?= utf8_decode( $relatorio_teste['tester'])?>" disabled>
                  </div>
              </div>
              <div class="col-2">
                  <div class="form-group">
                      <label for="n_solicitacao">N° Solicitação:</label>
                      <input type="number" name="num_solicitacao" class="form-control" value="<?= $relatorio_teste['num_solicitacao']?>" disabled>
                  </div>
              </div>
              <div class="col-2">
                  <div class="form-group">
                      <label for="insercao">Data Inserção:</label>
                      <input type="text" name="insercao" class="form-control" value="<?= $relatorio_teste['data_insercao']?>" disabled>
                  </div>
              </div>
              <div class="col-2">
                  <div class="form-group">
                      <label for="vencimento">Data Vencimento:</label>
                      <input type="text" class="form-control" name="vencimento" value="<?= $vencimento?>" disabled>
                  </div>
              </div>
              <div class="col-2">
                  <div class="form-group">
                      <label for="data_teste">Data Teste:</label>
                      <input type="text" class="form-control" name="data_teste" value="<?= $relatorio_teste['data_teste']?>" disabled>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-6">
                  <div class="form-group">
                      <label for="tipo_teste">Tipo:</label>
                      <input type="text" class="form-control" name="tipo_teste" value="<?= utf8_decode( $relatorio_teste['tipo_teste'])?>" disabled>
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group">
                      <label for="link">Link:</label>
                      <input type="text" class="form-control" name="link" value="<?= utf8_decode( $relatorio_teste['link'])?>" disabled>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-12">
                  <div class="form-group">
                      <label for="observacao">Observações:</label>
                      <textarea class="form-control" name="observacao" id="observacao" disabled><?=utf8_decode( $relatorio_teste['observacao'])?></textarea>
                  </div>
              </div>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>
<script>
j = jQuery.noConflict();
j( document ).ready(function() {
    CKEDITOR.replace('observacao');
});
</script>