<?php
    require_once("../models/connection.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
		<title>Contato - FECON-2022</title>
        <link rel="stylesheet" href="../libraries/reset.css">
		<link rel="stylesheet" href="../libraries/style.css">
    </head>
    <body>
        <header>
            <div class="caixa">
                <h2> <img src="../img/logo.png" alt="Logo do Colégio Estadual Gabriel de Lara"></h2>
                <nav>
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="pagina.php">Página</a></li>
                        <li><a href="contato.php">Contato</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <?php
                $nomeDaTabela = "testefinal";
                $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                if (!empty($data['SendAddMsg'])) {
                //var_dump($data);
                    $query_msg = "INSERT INTO $nomeDaTabela (nome, email, telefone, mensagem, tipoContato, turno, created) VALUES (:nome, :email, :telefone, :mensagem, :tipoContato, :turno, NOW())";
                    $add_msg = $conn->prepare($query_msg);
                    $add_msg->bindParam(':nome', $data['nome'], PDO::PARAM_STR);
                    $add_msg->bindParam(':email', $data['email'], PDO::PARAM_STR);
                    $add_msg->bindParam(':telefone', $data['telefone'], PDO::PARAM_STR);
                    $add_msg->bindParam(':mensagem', $data['mensagem'], PDO::PARAM_STR);
                    $add_msg->bindParam(':tipoContato', $data['tipoContato'], PDO::PARAM_STR);
                    $add_msg->bindParam(':turno', $data['turno'], PDO::PARAM_STR);
                    $add_msg->execute();
                    if ($add_msg->rowCount()) {
                        echo "Mensagem de Contato enviada com sucesso!<br>";
                    } else {
                        echo "Erro: Mensagem de contato não enviada com sucesso!<br>";
                    }
                }   
            ?>
            <form name="add_msg" action="" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="imput-padrao" required value="" required>
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="imput-padrao" required placeholder="seuemail@escola.pr.gov.br" value="" required
                    <?php
                        if(!empty($_SESSION['value_email'])){
                        echo "value='".$_SESSION['value_email']."'";
                        unset($_SESSION['value_email']);
                        }
                    ?>
                >
                <?php
                    if(!empty($_SESSION['vazio_email'])){
                        echo "<p style='color: #f00; '>".$_SESSION['vazio_email']."</p>";
                        unset($_SESSION['vazio_email']);
                    }
                ?></input>
                <label for="telefone">Telefone:</label>
                <input type="tel" name="telefone" id="telefone" class="imput-padrao" required placeholder="(XX)XXXXXXXX" value="" required></input>
                <label for="mensagem">Mensagem:</label>
                <textarea cols="70" rows="10" name="mensagem" id="mensagem" class="imput-padrao" required></textarea>
                <!--
                /*
                <fieldset id>
                    <legend>Como prefere o nosso contato?</legend>
                    <label for="radio-whats"><input type="radio" name="contato" value="whats" id="radio-whats" checked>WhatsApp</label>
                    
                    <label for="radio-email"><input type="radio" name="contato" value="email" id="radio-email">E-mail</label>
                    
                    <label for="radio-telefone"><input type="radio" name="contato" value="telefone" id="radio-telefone">Telefone</label>
                </fieldset>
                */
                -->
                <fieldset>
                    <legend>Como prefere o nosso contato?</legend>
                    <select name="tipoContato" id="tipoContato">
                        <option>WhatsApp</option>
                        <option>email</option>
                        <option>telefone</option>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>Qual horário preferido para contato?</legend>
                    <select name="turno" id="turno">
                        <option>Manhã</option>
                        <option>Tarde</option>
                        <option>Noite</option>
                    </select>
                </fieldset>

                <input type="submit" value="Enviar" name="SendAddMsg" onclick="return validar_form_contato()>
            </form>
        </main>
        <footer>
            <img id="letras" src="../img/iniciais-logo.png" alt="Logo do Colégio Estadual Gabriel de Lara">
            <p class="copyright">&copy; Copyright FECON-2022</p>
        </footer>
        <!--
            /*
                <script type="text/javascript">
                    let email = "test@escola.pr.gov.br";
                    let regex_validation = /^([a-z]){1,}([a-z0-9._-]){1,}[@]escola.pr.gov.br$/i;
                    console.log("É email válido? Resposta: " + regex_validation.test(email));
                
                    let emailtest = add_msg.email.value;

                    if(emailtest !== regex_validation) {
                        alert("É email teste válido? Resposta: " + regex_validation.test(emailtest));
                        add_msg.email.focus();
                    }

                </script>
                */
        -->        
        <script type="text/javascript">
            function validar_form_contato(){
                let nome = add_msg.nome.value;
                let email = add_msg.email.value;
                let assunto = add_msg.assunto.value;
                let mensagem = add_msg.mensagem.value;
                if(nome == ""){
                    alert("Campo nome é obrigatorio");
                    add_msg.nome.focus();
                    return false;
                }
                if (email == "") {
                    alert("Campo email é obrigatorio");
                    add_msg.email.focus();
                } else if(email == /teste@escola.pr.gov.br/){
                    alert("Campo emasdasdsadsdil é obrigatorio");
                    add_msg.email.focus();
                } else {
                    return false;
                }
                if(assunto == ""){
                    alert("Campo assunto é obrigatorio");
                    add_msg.assunto.focus();
                    return false;
                }
                if(mensagem == ""){
                    alert("Campo mensagem é obrigatorio");
                    add_msg.mensagem.focus();
                    return false;
                }
            }
        </script>
    </body>
</html>
