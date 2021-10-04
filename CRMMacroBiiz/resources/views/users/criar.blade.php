
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRM Macrobiiz</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a style="color: red" ><b style="color: black">Macrobiiz</b></a>
    </div>
    <!-- /.login-logo -->

    @include('includes.erros')


    <form method="POST" action="store_conta" style="padding: 2em;">

        {{ csrf_field() }}

        <div class="form-group">
            <label for="id_text_nome" style="z-index: 1;">Utilizador:</label>
            <input type="text" class="form-control" id="id_text_nome" name="text_nome" placeholder="Usuário">
        </div>

        <div class="form-group">
            <label for="id_text_password">Senha:</label>
            <input type="password" class="form-control" id="id_text_password" name="text_password" placeholder="Senha">
        </div>

        <div class="form-group">
            <label for="id_text_password_rep">Repetir Senha:</label>
            <input type="password" class="form-control" id="id_text_password_rep" name="text_password_rep" placeholder="Senha">
        </div>

        <div class="form-group">
            <label for="id_text_email" style="z-index: 1;">Email:</label>
            <input type="email" class="form-control" id="id_text_email" name="text_email" placeholder="Email">
        </div>




        <div class="text-center">
            <a href="login"><button type="submit" class="btn btn-primary">Criar Conta</button></a>
        </div>

        <div class="text-center">
            <a href="login">Voltar</a>
        </div>


    </form>

</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>