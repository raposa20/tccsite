<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Tela do Administrador</title>
    <script>
		function confirmar(numero) {  
    		if (confirm('Excluir coleta?')) {  
        		location.href = 'apagarcoleta.php?numero=' + numero;
    		}
		}
	</script>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header("location:loginAdm.html");
    }
    include_once("navbar.php");
    ?>
    
    <div class="container">
    <?php
	  
      //Conexao com o BD
      include_once("conexao.php");
  
      //Consulta SQL para exibir os dados da tabela tbalunos
      $sqlexibir = "select * from tbagendamento;";
      
      $resultado = mysqli_query($conn, $sqlexibir);
      
      if(mysqli_num_rows($resultado) > 0){
        echo "<table id='tbresultado'><tr>";
        echo "<th>ID</TH><th>ENDEREÇO</TH><th>TIPO DE MATERIAL</TH><th>Data</th><th>EXCLUIR</th></TR>";
        while($coleta = mysqli_fetch_assoc($resultado)){
            
            echo "<tr>";
            echo "<td>".$coleta['numero']."</td>";
            echo "<td>".$coleta['endereco']."</td>";
            echo "<td>".$coleta['material']."</td>";
            echo "<td>".$coleta['data']."</td>";
            echo "<td> <a href='javascript: confirmar(".$coleta['numero'].");'><img src='img/excluir.png' class='icone'></a> </td>";
            echo "</tr>";
        }
        echo "</table>";
    }else{
        echo "Nenhuma coleta encontrado.";
    }
  
      mysqli_close($conn);	
  
  ?>

    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>