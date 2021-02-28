<?php session_start(); ?>
<html>
<head>
    <title>Login</title>
</head>
 
<body>
<a href="index.php">Home</a> <br/>
// Inicialização de Login
$login = $_POST['login'];
$senha = MD5($_POST['senha']);
$connect = mysql_connect('nome_do_servidor','nome_de_usuario','senha');
$db = mysql_select_db('nome_do_banco_de_dados');
$query_select = "SELECT login FROM usuarios WHERE login = '$login'";
$select = mysql_query($query_select,$connect);
$array = mysql_fetch_array($select);
$logarray = $array['login'];

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
  if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
      header("Location: index.php"); exit;
  }
  // Validação do usuário/senha digitados
  $sql = "SELECT `id`, `nome`, `nivel` FROM `usuarios` WHERE (`usuario` = '".$usuario ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1";
  $query = mysql_query($sql);
  if (mysql_num_rows($query) != 1) {
      // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
      echo "Login inválido!"; exit;
  } else {
      // Salva os dados encontados na variável $resultado
      $resultado = mysql_fetch_assoc($query);
  }  
      // Se a sessão não existir, inicia uma
      if (!isset($_SESSION)) session_start();

      // Salva os dados encontrados na sessão
      $_SESSION['UsuarioID'] = $resultado['id'];
      $_SESSION['UsuarioNome'] = $resultado['nome'];
      $_SESSION['UsuarioNivel'] = $resultado['nivel'];

      // Redireciona o visitante
      header("Location: restrito.php"); exit;
  }
  // A sessão precisa ser iniciada em cada página diferente
  if (!isset($_SESSION)) session_start();

  // Verifica se não há a variável da sessão que identifica o usuário
  if (!isset($_SESSION['UsuarioID'])) {
      // Destrói a sessão por segurança
      session_destroy();
      // Redireciona o visitante de volta pro login
      header("Location: index.php"); exit;
  }
  
   // A sessão precisa ser iniciada em cada página diferente
  if (!isset($_SESSION)) session_start();

  $nivel_necessario = 2;

  // Verifica se não há a variável da sessão que identifica o usuário
  if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] <$nivel_necessario)) {
      // Destrói a sessão por segurança
      session_destroy();
      // Redireciona o visitante de volta pro login
      header("Location: index.php"); exit;
	  
	  session_start(); session_destroy(); header("Location: index.php");exit
	  	  
  // Tenta se conectar ao servidor MySQL
  mysql_connect('localhost', 'root', '') or trigger_error(mysql_error());
  // Tenta se conectar a um banco de dados MySQL
  mysql_select_db('usuarios') or trigger_error(mysql_error());

  $usuario = mysql_real_escape_string($_POST['usuario']);
  $senha = mysql_real_escape_string($_POST['senha']);

  if($login == "" || $login == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O campo login deve ser preenchido');window.location.href='
    cadastro.html';</script>";

    }else{
      if($logarray == $login){

        echo"<script language='javascript' type='text/javascript'>
        alert('Esse login já existe');window.location.href='
        cadastro.html';</script>";
        die();

      }else{
        $query = "INSERT INTO usuarios (login,senha) VALUES ('$login','$senha')";
        $insert = mysql_query($query,$connect);

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Usuário cadastrado com sucesso!');window.location.
          href='login.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário');window.location
          .href='cadastro.html'</script>";
        }
      }
    }
	
	 $login_cookie = $_COOKIE['login'];
    if(isset($login_cookie)){
		if($login == "adm001" && $senha == "010203A"){
		echo"Seja bem vindo, $login_cookie administrador!";}
		if($login == "usuario001" && $senha == "030201U"){
		echo"Seja bem vindo, $login_cookie usuário!";}
    }else{
      echo"Bem-Vindo, convidado <br>";
      echo"Essas informações NÃO PODEM ser acessadas por você";
      echo"<br><a href='login.html'>Faça Login</a> Para ler o conteúdo";
    }
	</body>
	</html>