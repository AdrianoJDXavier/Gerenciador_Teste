<?php
$atendentes = getAtendentes();
$extranets = getExtranets();
session_start();

if(isset($_POST['filtrar']) && $_POST['filtrar'] == 'filtrar'){
    !empty($_POST['filtro_teste_extranet']) ? $_SESSION['filtro_teste_extranet'] = $_POST['filtro_teste_extranet'] : NULL;
    !empty($_POST['filtro_teste_atendente']) ? $_SESSION['filtro_teste_atendente'] = $_POST['filtro_teste_atendente'] : NULL;
    !empty($_POST['filtro_teste_tester']) ? $_SESSION['filtro_teste_tester'] = $_POST['filtro_teste_tester'] : NULL;
    !empty($_POST['filtro_teste_tipo_teste']) ? $_SESSION['filtro_teste_tipo_teste'] = $_POST['filtro_teste_tipo_teste'] : NULL; 
    !empty($_POST['filtro_teste_inicio']) ? $_SESSION['filtro_teste_inicio'] = $_POST['filtro_teste_inicio'] : NULL;
    !empty($_POST['filtro_teste_fim']) ? $_SESSION['filtro_teste_fim'] = $_POST['filtro_teste_fim'] : NULL;
}

if(isset($_POST['limpar_filtro']) && $_POST['limpar_filtro'] == 'limpar_filtro'){
    unset($_SESSION['filtro_teste_extranet']);
    unset($_SESSION['filtro_teste_atendente']);
    unset($_SESSION['filtro_teste_tester']);
    unset($_SESSION['filtro_teste_tipo_teste']); 
    unset($_SESSION['filtro_teste_inicio']);
    unset($_SESSION['filtro_teste_fim']);
}
isset($_SESSION['filtro_teste_tipo_teste']) && !empty($_SESSION['filtro_teste_tipo_teste']) ? $tipo_teste = $_SESSION['filtro_teste_tipo_teste'] : $tipo_teste = NULL; 

?>
<div class="card" id="filtros" style="display: none;">
    <div class="item_card">
        <form method="POST">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="filtro_teste_extranet">Extranet:</label>
                        <select name="filtro_teste_extranet" id="filtro_teste_extranet" class="form-control">
                            <option value="">----</option>
                                <?php
                                foreach($extranets as $extranet){
                                    $_SESSION['filtro_teste_extranet'] == $extranet['id'] ? $selected = 'selected' : $selected = '';
                                    echo "<option value='".$extranet['id']."' $selected>".utf8_decode($extranet['nome'])."</option>";    
                                }?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="filtro_teste_atendente">Atendente:</label>
                        <select name="filtro_teste_atendente" id="filtro_teste_atendente" class="form-control">
                        <option value="">----</option>
                            <?php
                            foreach($atendentes as $value){
                                $_SESSION['filtro_teste_atendente'] == $value['id'] ? $selected = 'selected' : $selected = '';
                                echo "<option value='".$value['id']."' $selected>".utf8_decode($value['nome'])."</option>";
                                    
                            }?>
                        </select>
                    </div>  
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="filtro_teste_tester">Tester:</label>
                        <select name="filtro_teste_tester" id="filtro_teste_tester" class="form-control">
                            <option value="">----</option>
                                <?php
                                foreach($atendentes as $atendente){
                                    $_SESSION['filtro_teste_tester'] == $atendente['id'] ? $selected = 'selected' : $selected = '';
                                    echo "<option value='".$atendente['id']."' $selected>".utf8_decode($atendente['nome'])."</option>";        
                                }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="filtro_teste_tipo_teste">Tipo:</label>
                        <select name="filtro_teste_tipo_teste" id="filtro_teste_tipo_teste" class="form-control">
                            <option value="">----</option>
                            <option <?=$tipo_teste == 'Teste' ? 'selected' : NULL;?> value="Teste">Teste</option>
                            <option <?=$tipo_teste == 'Reteste' ? 'selected' : NULL;?> value="Reteste">Reteste</option>
                            <option <?=$tipo_teste == 'Inspeção' ? 'selected' : NULL;?> value="Inspeção">Inspeção</option>
                            <option <?=$tipo_teste == 'Reinspeção' ? 'selected' : NULL;?> value="Reinspeção">Reinspeção</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="filtro_teste_inicio">De:</label>
                                <input type="date" name="filtro_teste_inicio" class="form-control" id="filtro_teste_inicio" value="<?=isset($_SESSION['filtro_teste_inicio']) ? $_SESSION['filtro_teste_inicio'] : NULL;?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="filtro_teste_fim">Até:</label>
                                <input type="date" class="form-control" name="filtro_teste_fim" id="filtro_teste_fim" value="<?=isset($_SESSION['filtro_teste_fim']) ? $_SESSION['filtro_teste_fim'] : NULL;?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="btn-filter">
                        <button type="submit" name="filtrar" value="filtrar" class="btn btn-primary">Filtrar</button>
                        <button type="submit" name="limpar_filtro" value="limpar_filtro" class="btn btn-primary">Limpar Filtros</button>
                    </div>
                </div>
            </div>
        </form>
    </div>  
</div>
<br>
