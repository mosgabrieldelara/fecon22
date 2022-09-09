<?php

require_once("../models/connection.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Celke - Como criar o formulario de contato e enviar e-mail e salvar no bd</title>
    </head>
    <body>
        <h2>Enviar Mensagem</h2>
       
        <?php

        
            $nomeDoBancoDeDados = "contatos";

            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($data['SendAddMsg'])) {
                //var_dump($data);
                $query_msg = "INSERT INTO $nomeDoBancoDeDados (nome, email, telefone, mensagem, created) VALUES (:nome, :email, :telefone, :mensagem, NOW())";
                $add_msg = $conn->prepare($query_msg);

                $add_msg->bindParam(':nome', $data['nome'], PDO::PARAM_STR);
                $add_msg->bindParam(':email', $data['email'], PDO::PARAM_STR);
                $add_msg->bindParam(':telefone', $data['telefone'], PDO::PARAM_STR);
                $add_msg->bindParam(':mensagem', $data['mensagem'], PDO::PARAM_STR);

                $add_msg->execute();

                if ($add_msg->rowCount()) {
                    echo "Mensagem de Contato enviada com sucesso!<br>";
                    } else {
                        echo "Erro: Mensagem de contato não enviada com sucesso!<br>";
                    }
                }
        ?>


        <form name="add_msg" action="" method="POST">
            <label>Nome: </label>
            <input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php
            if (isset($data['nome'])) {
                echo $data['nome'];
            }
            ?>" autofocus required><br><br>


<div class="controls">
<input class="span4" type="text" name="Campo" placeholder="Campo"  value=""  
required oninvalid="this.setCustomValidity('Campo requerido')" 
onchange="try{setCustomValidity('')}catch(e){}">
</div>


            <label>E-mail: </label>
            <input type="email" name="email" id="email" placeholder="O melhor e-mail"  value="<?php
            if (isset($data['email'])) {
                echo $data['email'];
            }
            ?>" required><br><br>

            <label>Telefone: </label>
            <input type="text" name="telefone" id="telefone" placeholder="Seu número de telefone"  value="<?php
            if (isset($data['telefone'])) {
                echo $data['telefone'];
            }
            ?>" required><br><br>

            <label>Mensagem: </label>
            <input type="text" name="mensagem" id="mensagem" placeholder="Conteúdo da mensagem"  value="<?php
                   if (isset($data['mensagem'])) {
                       echo $data['mensagem'];
                   }
                   ?>" required><br><br>

            <input type="submit" value="Enviar" name="SendAddMsg">
        </form>
    
    
    </body>
</html>



<?php
                    if (isset($data['mensagem'])) {
                    echo $data['mensagem'];
                    }
                ?>