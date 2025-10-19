<?php 
  session_start();

  if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Faça o login antes de acessar a página!');</script>";
    header("Location: login.php");
    exit();
  }

  include "includes/banco.php";
  include "includes/header.php";
  include "includes/navbar.php";
?>


<div class="card_r shadow-lg p-4 border-0 bg-light-orange">
  <h2 class="text-center text-orange mb-4 fw-bold">Formulário Estudantil</h2> 

  <?php 
    $id_usuario = $_SESSION['usuario_id'];

    //============== Verifica se o aluno já possui respostas =============
    $stmt = $conn->prepare("SELECT * FROM estudos WHERE aluno_id = ?");
    $stmt->bind_param("s", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // Se já existe, carrega os dados
      $dados = $result->fetch_assoc();
  ?>

      <!-- Formulário já preenchido (para edição) -->
      <form action="edit_form.php" method="POST" class="needs-validation" novalidate>

        <input type="hidden" name="aluno_id" value="<?= htmlspecialchars($id_usuario) ?>">

        <!-- Dificuldade -->
        <div class="mb-3">
          <label for="dificuldade" class="form-label fw-semibold">Qual área você sente mais dificuldade?</label>
          <select name="dificuldade" id="dificuldade" class="form-select" required>
            <option value="linguagens" <?= $dados['a_d'] == 'linguagens' ? 'selected' : '' ?>>Linguagens (Português, Literatura, Inglês, Artes)</option>
            <option value="humanas" <?= $dados['a_d'] == 'humanas' ? 'selected' : '' ?>>Ciências Humanas (História, Geografia, Sociologia, Filosofia)</option>
            <option value="natureza" <?= $dados['a_d'] == 'natureza' ? 'selected' : '' ?>>Ciências da Natureza (Física, Química, Biologia)</option>
            <option value="matematica" <?= $dados['a_d'] == 'matematica' ? 'selected' : '' ?>>Matemática</option>
          </select>
        </div>

        <!-- Método Preferido -->
        <div class="mb-3">
          <label for="metodo_preferido" class="form-label fw-semibold">Qual formato de estudo você prefere?</label>
          <select name="metodo_preferido" id="metodo_preferido" class="form-select" required>
            <option value="texto" <?= $dados['f_e'] == 'texto' ? 'selected' : '' ?>>Ler textos e resumos</option>
            <option value="video" <?= $dados['f_e'] == 'video' ? 'selected' : '' ?>>Vídeos explicativos</option>
            <option value="exercicio" <?= $dados['f_e'] == 'exercicio' ? 'selected' : '' ?>>Exercícios práticos</option>
            <option value="mapa" <?= $dados['f_e'] == 'mapa' ? 'selected' : '' ?>>Mapas mentais / flashcards</option>
          </select>
        </div>

        <!-- Horário de Estudo -->
        <div class="mb-3">
          <label for="horario_estudo" class="form-label fw-semibold">Quanto tempo por dia você consegue estudar?</label>
          <select name="horario_estudo" id="horario_estudo" class="form-select" required>
            <option value="menos_30min" <?= $dados['t_e'] == 'menos_30min' ? 'selected' : '' ?>>Menos de 30 minutos</option>
            <option value="30min_1h" <?= $dados['t_e'] == '30min_1h' ? 'selected' : '' ?>>30 minutos a 1 hora</option>
            <option value="1h_2h" <?= $dados['t_e'] == '1h_2h' ? 'selected' : '' ?>>1 a 2 horas</option>
            <option value="mais_2h" <?= $dados['t_e'] == 'mais_2h' ? 'selected' : '' ?>>Mais de 2 horas</option>
          </select>
        </div>

        <!-- Preferência -->
        <div class="mb-3">
          <label for="prefere" class="form-label fw-semibold">Você prefere estudar:</label>
          <select name="prefere" id="prefere" class="form-select" required>
            <option value="sozinho" <?= $dados['p_e'] == 'sozinho' ? 'selected' : '' ?>>Sozinho(a)</option>
            <option value="grupo" <?= $dados['p_e'] == 'grupo' ? 'selected' : '' ?>>Em dupla ou grupo</option>
            <option value="com_tutor" <?= $dados['p_e'] == 'com_tutor' ? 'selected' : '' ?>>Com ajuda de professor / tutor</option>
          </select>
        </div>

        <!-- O que atrapalha -->
        <div class="mb-4">
          <label for="atrapalha" class="form-label fw-semibold">O que mais atrapalha seus estudos?</label>
          <select name="atrapalha" id="atrapalha" class="form-select" required>
            <option value="falta_concentracao" <?= $dados['o_a'] == 'falta_concentracao' ? 'selected' : '' ?>>Falta de concentração</option>
            <option value="falta_organizacao" <?= $dados['o_a'] == 'falta_organizacao' ? 'selected' : '' ?>>Falta de organização</option>
            <option value="preguica" <?= $dados['o_a'] == 'preguica' ? 'selected' : '' ?>>Preguiça / falta de motivação</option>
            <option value="nao_entender" <?= $dados['o_a'] == 'nao_entender' ? 'selected' : '' ?>>Não entender a explicação</option>
          </select>
        </div>

        <!-- Botão de salvar alterações -->
        <div class="text-center">
          <button type="submit" class="btn bg-orange text-white px-5 py-2 fw-semibold shadow-sm">
            Salvar Alterações
          </button>
        </div>
      </form>

      <?php
    } else {
        // Caso o aluno ainda não tenha preenchido o formulário
      ?>

      <form action="create_form.php" method="POST" class="needs-validation" novalidate>
        <!-- Formulário novo -->
        <div class="mb-3">
          <label for="dificuldade" class="form-label fw-semibold">Qual área você sente mais dificuldade?</label>
          <select name="dificuldade" id="dificuldade" class="form-select" required>
            <option value="linguagens">Linguagens (Português, Literatura, Inglês, Artes)</option>
            <option value="humanas">Ciências Humanas (História, Geografia, Sociologia, Filosofia)</option>
            <option value="natureza">Ciências da Natureza (Física, Química, Biologia)</option>
            <option value="matematica">Matemática</option>
          </select>
        </div>

        <!-- Método Preferido -->
        <div class="mb-3">
          <label for="metodo_preferido" class="form-label fw-semibold">Qual formato de estudo você prefere?</label>
          <select name="metodo_preferido" id="metodo_preferido" class="form-select" required>
            <option value="texto">Ler textos e resumos</option>
            <option value="video">Vídeos explicativos</option>
            <option value="exercicio">Exercícios práticos</option>
            <option value="mapa">Mapas mentais / flashcards</option>
          </select>
        </div>
        
        <!-- Horário de Estudo -->
        <div class="mb-3"> 
          <label for="horario_estudo" class="form-label fw-semibold">Quanto tempo por dia você consegue estudar?</label>
          <select name="horario_estudo" id="horario_estudo" class="form-select" required>
            <option value="menos_30min">Menos de 30 minutos</option>
            <option value="30min_1h">30 minutos a 1 hora</option>
            <option value="1h_2h">1 a 2 horas</option>
            <option value="mais_2h">Mais de 2 horas</option>
          </select>
        </div>

        <!-- Preferência -->
        <div class="mb-3">
          <label for="prefere" class="form-label fw-semibold">Você prefere estudar:</label>
          <select name="prefere" id="prefere" class="form-select" required> 
            <option value="sozinho">Sozinho(a)</option> 
            <option value="grupo">Em dupla ou grupo</option> 
            <option value="com_tutor">Com ajuda de professor / tutor</option> 
          </select> 
        </div>

        <!-- O que atrapalha --> 
        <div class="mb-4"> 
          <label for="atrapalha" class="form-label fw-semibold">O que mais atrapalha seus estudos?</label> 
          <select name="atrapalha" id="atrapalha" class="form-select" required> 
            <option value="falta_concentracao">Falta de concentração</option> 
            <option value="falta_organizacao">Falta de organização</option> 
            <option value="preguica">Preguiça / falta de motivação</option> 
            <option value="nao_entender">Não entender a explicação</option> 
          </select> 
        </div>

        <div class="text-center">
          <button type="submit" class="btn bg-orange text-white px-5 py-2 fw-semibold shadow-sm">
            Enviar Respostas
          </button>
        </div>
      </form>

      <?php
    }
      ?>
</div>

<?php 
  include "includes/footer.php";
?>
