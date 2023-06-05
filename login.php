<?php include_once "php/header.php";?>
  <body>
    <div class="wrapper">
      <section class="form login">
        <header><i class="fas fa-comment-alt"></i> Chat App</header>
        <form action="#">
          <div class="error-txt"></div>
          <div class="field input">
            <label>E-mail</label>
            <input type="text" name="email" autocomplete="off" placeholder="Digite o seu e-mail" />
          </div>
          <div class="field input">
            <label>Senha</label>
            <input type="password" name="password" autocomplete="off" placeholder="Digite sua senha" />
            <i class="fas fa-eye"></i>
          </div>
          <div class="field button">
            <input type="submit" value="Entrar" />
          </div>
        </form>
        <div class="link">Não possui uma cadastro? <a href="index.php">Criar conta</a></div>
      </section>
    </div>

    <script src="js/pass-show-hider.js"></script>
    <script src="js/login.js"></script>
  </body>
</html>
