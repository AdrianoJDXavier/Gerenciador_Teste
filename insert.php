<?php
require_once 'conexao.php';
require_once 'header.php';
?>
<div class="container">
<?php
$atendentes = getAtendentes();
print_r($atendentes);

if(isset($_POST['addnew'])){
    if( empty($_POST['firstname']) || empty($_POST['lastname'])
        || empty($_POST['address']) || empty($_POST['contact']) )
    {
        echo "Please fillout all required fields";
    }else{
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $sql = "INSERT INTO users(firstname,lastname,address,contact)
        VALUES('$firstname','$lastname','$address','$contact')";


        if( $con->query($sql) === TRUE){
            echo "<div class='alert alert-success'>Successfully added new user</div>";
        }else{
            echo "<div class='alert alert-danger'>Error: There was an error while adding new user</div>";
        }
    }
}
?>

<div class="card">
  <div class="card-header text-center bg-default">
    REGISTRO DE TESTE
  </div>
    <div style="width: 95% !important; align-self: center;">
        <form action="/action_page.php">
            <div class="form-group">
                <label for="atendente">Atendente:</label>
                <select name="atendente" id="atendente" class="form-control">
                    <option>----</option>
                    <?
                    foreach($atendentes as $key=>$value){
                        ?>
                        <option value="<?=$value['id']?>"><?=$value['nome']?></option>
                    <?}?>
                </select>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" placeholder="Enter password" id="pwd">
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember me
                </label>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form> 
    </div>
</div>

<?php
require_once 'footer.php';
