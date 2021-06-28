<?php
require_once 'conexao.php';
require_once 'header.php';
$atendentes = getAtendentes();
$extranets = getExtranets();
?>
    <div class="card">
        <div class="card-header text-center bg-default">
            REGISTRO DE TESTE
        </div>
        <div class="item_card">
            <form action="relatorio_teste_data.php" method="POST" id="form_testes">
                <input type="hidden" name="Enviar" value="enviar"/>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="atendente">Atendente:</label>
                            <select name="atendente" id="atendente" class="form-control rp_required">
                                <option value="">----</option>
                                <?php
                            foreach($atendentes as $value){
                
                                echo "<option value='".$value['id']."'>".utf8_decode($value['nome'])."</option>";
                                
                            }?>
                            </select>
                        </div>    
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="extranet">Extranet:</label>
                            <select name="extranet" id="extranet" class="form-control rp_required">
                                <option value="">----</option>
                                <?php
                            foreach($extranets as $extranet){
                
                                echo "<option value='".$extranet['id']."'>".utf8_decode($extranet['nome'])."</option>";
                                
                            }?>
                            </select>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tester">Tester:</label>
                            <select name="tester" id="tester" class="form-control rp_required">
                                <option value="">----</option>
                                <?php
                                foreach($atendentes as $atendente){
                    
                                    echo "<option value='".$atendente['id']."'>".utf8_decode($atendente['nome'])."</option>";
                                    
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="n_solicitacao">N° Solicitação:</label>
                            <input type="number" name="num_solicitacao" class="form-control rp_required" id="n_solicitacao">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="insercao">Data Inserção:</label>
                            <input type="date" name="insercao" class="form-control rp_required" id="insercao">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="vencimento">Data Vencimento:</label>
                            <input type="date" class="form-control" name="vencimento" id="vencimento">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tipo_teste">Tipo:</label>
                            <select name="tipo_teste" id="tipo_teste" class="form-control rp_required">
                                <option value="">----</option>
                                <option value="Teste">Teste</option>
                                <option value="Reteste">Reteste</option>
                                <option value="Inspeção">Inspeção</option>
                                <option value="Reinspeção">Reinspeção</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="link">Link:</label>
                            <input type="text" class="form-control" name="link" id="link">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="observacao">Observações:</label>
                            <textarea class="form-control" name="observacao" id="observacao"></textarea>
                        </div>
                    </div>
                </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            </form> 
        </div>
    </div>
</div>
<script>
j = jQuery.noConflict();
j( document ).ready(function() {
    j("#exibir").hide(1000);
    j("#ocultar").hide(1000);
    j("#relatorio").hide(1000);
    j("#inserir").hide(1000);
    j("#dashboard").hide(1000);
    rp_required('form_testes');
    CKEDITOR.replace('observacao');
});

</script>
<?php
require_once 'footer.php';
