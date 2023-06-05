<?php include_once "php/header.php";?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Chat App</header>
      <form action="#" enctype="multipart/form-data">
        <div class="error-txt"></div>
        <div class="name-details">
          <div class="field input">
            <label>Primeiro Nome</label>
            <input type="text" name="fname" placeholder="Primeiro Nome" required>
          </div>
          <div class="field input">
            <label>Sobrenome</label>
            <input type="text" name="lname" placeholder="Sobrenome" required>
          </div>
        </div>
        <div class="field input">
          <label>E-mail</label>
          <input type="text" name="email" placeholder="Digite o seu e-mail" required>
        </div>
        <div class="field input">
          <label>Senha</label>
          <i class="fas fa-eye"></i>
          <input type="password" name="password" placeholder="Digite sua nova senha" required>
        </div>
        <div class="field image">
          <label>Selecione sua Imagem</label>
          <input type="file" name="image" required>
        </div>
        <div class="field button">
          <input type="submit" value="Inicie o Chat">   
        </div>
      </form>
      <div class="link">Já se inscreveu? <a href="login.php">Entrar agora</a></div>
    </section>
  </div>

  <script src="js/pass-show-hider.js"></script>
  <script src="js/signup.js"></script>
</body>

</html>