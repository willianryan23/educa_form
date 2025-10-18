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

// Busca preferências do usuário
$id_usuario = $_SESSION['usuario_id'];

$stmt = $conn->prepare("SELECT * FROM estudos WHERE aluno_id = ?");
$stmt->bind_param("s", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "
    <script>
    alert('Por favor, preencha o formulário antes de acessar as recomendações.');
    window.location.href = 'formulario.php';</script>

    ";
} 
else{

    if($linha = $result->fetch_assoc()) {
        
        $dificuldade = $linha['a_d'];
        $metodo_preferido = $linha['f_e'];
        $horario_estudo = $linha['t_e'];
        $prefere = $linha['p_e'];
        $atrapalha = $linha['o_a'];

        //======================respostas do formulário========================
        echo "
            <div>
                <div class='card_r shadow-lg p-4 border-0 bg-light-orange'>
                    <h4 class='text-orange text-center mb-3'>Com base nas suas respostas, aqui estão algumas recomendações:</h4>
                    <ul class='list-group'>
                        <li class='list-group-item'><p>Área de Dificuldade: <strong>" . htmlspecialchars($dificuldade) . "</strong></p></li>
                        <li class='list-group-item'><p>Método de Estudo Preferido: <strong>" . htmlspecialchars($metodo_preferido) . "</strong></p></li>
                        <li class='list-group-item'><p>Horário de Estudo: <strong>" . htmlspecialchars($horario_estudo) . "</strong></p></li>
                        <li class='list-group-item'><p>O que Prefere: <strong>" . htmlspecialchars($prefere) . "</strong></p></li>
                        <li class='list-group-item'><p>O que Atrapalha: <strong>" . htmlspecialchars($atrapalha) . "</strong></p></li>
                    </ul>
                </div>
              
                
                <div class='card_r shadow-lg p-4 border-0 bg-light-orange'>
                <h1 class='text-orange mb-3 text-center'>Recomendações Personalizadas</h1>
        ";
                //====================== inicio 1. Qual área você sente mais dificuldade?=================

                //======================recomendações para ciencias da natureza========================

                    //====================== recomendações para Ciências da Natureza ========================
if ($dificuldade === "natureza") {
    echo "
    <h4 class='text-orange mb-3'>Dificuldade em Ciências da Natureza</h4>
    <table style='width: 100%; border-collapse: collapse;'>
        <tr style='background-color: #fff3e0;'>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
            <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
        </tr>

        <tr>
            <td style='padding: 10px;'><p><b>Método Feynman</b></p></td>
            <td style='padding: 10px;'><p>Explicar o conteúdo com suas próprias palavras, como se ensinasse a outra pessoa. Isso ajuda muito em Biologia e Química.</p></td>
            <td style='padding: 10px;'>
                <a href='https://napratica.org.br/noticias/aprenda-rapido-com-tecnica-feynman' class='btn bg-orange text-white' target='_blank'>
                    <p>Ver método Feynman</p>
                </a>
            </td>
        </tr>

        <tr>
            <td style='padding: 10px;'><p><b>Aprendizagem Ativa</b></p></td>
            <td style='padding: 10px;'><p>Em vez de só ler, resolva problemas experimentais ou questões de provas anteriores.</p></td>
            <td></td>
        </tr>
    </table>

    <hr>
    <h4 class='text-orange mb-3'>Vídeo Aulas</h4>
    <table style='width: 100%; border-collapse: collapse;'>
        <tr style='background-color: #fff3e0;'>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Canal</p></th>
            <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
        </tr>

        <tr>
            <td><p><b>Professor Noslen (Química)</b></p></td>
            <td><p>Didática clara, ótimo para Olimpíadas e provas.</p></td>
            <td><a href='https://www.youtube.com/@ProfessorNoslen' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>

        <tr>
            <td><p><b>Paulo Jubilut (Biologia)</b></p></td>
            <td><p>Explicações detalhadas, muito usado no ENEM e vestibulares.</p></td>
            <td><a href='https://www.youtube.com/@paulojubilut' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>

        <tr>
            <td><p><b>Física Universitária</b></p></td>
            <td><p>Física explicada de forma acessível.</p></td>
            <td><a href='https://www.youtube.com/c/FisicaUniversit%C3%A1riaUSP' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>

        <tr>
            <td><p><b>Ciência em Show</b></p></td>
            <td><p>Experimentos práticos e explicações visuais.</p></td>
            <td><a href='https://www.youtube.com/@CienciaemShowOficial' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>

        <tr>
            <td><p><b>Manual do Mundo</b></p></td>
            <td><p>Ótimo para despertar curiosidade científica com experimentos simples.</p></td>
            <td><a href='https://www.youtube.com/@manualdomundo' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>
    </table>";
}

//====================== recomendações para Matemática ========================
if ($dificuldade === "matematica") {
    echo "
    <h4 class='text-orange mb-3'>Dificuldade em Matemática</h4>
    <table style='width: 100%; border-collapse: collapse;'>
        <tr style='background-color: #fff3e0;'>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
            <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
        </tr>

        <tr>
            <td style='padding: 10px;'><p><b>Resolução Espaçada (Spaced Practice)</b></p></td>
            <td style='padding: 10px;'><p>Estude problemas hoje, revisite em 2 dias e depois em 1 semana. Fixação comprovada pela neurociência.</p></td>
            <td style='padding: 10px;'><a href='https://oxfordlearning.com/what-is-spaced-practice/' class='btn bg-orange text-white' target='_blank'><p>Ver método</p></a></td>
        </tr>

        <tr>
            <td style='padding: 10px;'><p><b>Prática Deliberada</b></p></td>
            <td style='padding: 10px;'><p>Escolha exercícios difíceis e foque nos erros até dominar o conteúdo.</p></td>
            <td></td>
        </tr>
    </table>

    <hr>
    <h4 class='text-orange mb-3'>Vídeo Aulas</h4>
    <table style='width: 100%; border-collapse: collapse;'>
        <tr style='background-color: #fff3e0;'>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Canal</p></th>
            <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
        </tr>

        <tr>
            <td><p><b>Professor Ferretto</b></p></td>
            <td><p>Explica matemática de forma objetiva, do básico ao avançado.</p></td>
            <td><a href='https://www.youtube.com/@professorferretto' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>

        <tr>
            <td><p><b>Matemática Rio (Rafael Procópio)</b></p></td>
            <td><p>Aulas dinâmicas, com humor e exemplos práticos.</p></td>
            <td><a href='https://www.youtube.com/@MatematicaRio' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>

        <tr>
            <td><p><b>Me Salva!</b></p></td>
            <td><p>Vídeos rápidos, foco em resolver questões de forma direta.</p></td>
            <td><a href='https://www.youtube.com/@mesalva' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>

        <tr>
            <td><p><b>Portal da Matemática OBMEP</b></p></td>
            <td><p>Questões comentadas e resoluções focadas em olimpíadas de matemática.</p></td>
            <td><a href='https://www.youtube.com/@portalmatematicaobmep' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>

        <tr>
            <td><p><b>Khan Academy Brasil</b></p></td>
            <td><p>Excelente para revisão passo a passo de conteúdos.</p></td>
            <td><a href='https://www.youtube.com/@khanacademyportugues' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
        </tr>
    </table>";
}

                    //======================recomendações para linguagens========================
                    //====================== recomendações para Linguagens ========================
if ($dificuldade === "linguagens") {
    echo "
        <h4 class='text-orange mb-3'>Dificuldade Linguagens</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td style='padding: 10px;'><p><b>Leitura Ativa (SQ3R)</b></p></td>
                <td style='padding: 10px;'><p>Método para leitura de textos (Survey, Question, Read, Recite, Review).</p></td>
                <td>
                    <a href='https://exame.com/carreira/guia-de-carreira/como-usar-o-metodo-sq3r-para-melhorar-a-leitura-e-absorcao-de-informacao/' 
                        class='btn bg-orange text-white' target='_blank'>
                        <p>Método Leitura Ativa (SQ3R)</p>
                    </a>
                </td>
            </tr>
            <tr>
                <td style='padding: 10px;'><p><b>Flashcards</b></p></td>
                <td style='padding: 10px;'><p>Flashcards para vocabulário e regras gramaticais.</p></td>
                <td>
                    <a href='https://quizlet.com/br/features/flashcards' class='btn bg-orange text-white' target='_blank'>
                        <p>Método com Flashcards</p>
                    </a>
                </td>
            </tr>
        </table>

        <hr>
        <h4 class='text-orange mb-3'>Vídeo Aulas</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Canal</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Professor Noslen</b></p></td>
                <td><p>Muito usado por estudantes de Ensino Fundamental e Médio.</p></td>
                <td><a href='https://www.youtube.com/@ProfessorNoslen' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
            </tr>
            <tr>
                <td><p><b>Profa. Pamba</b></p></td>
                <td><p>Foco em redação e gramática, linguagem leve.</p></td>
                <td><a href='https://www.youtube.com/@ProfessoraPamba' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
            </tr>
            <tr>
                <td><p><b>Português com Letícia</b></p></td>
                <td><p>Português prático e bem explicado.</p></td>
                <td><a href='https://www.youtube.com/@portuguescomleticia' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
            </tr>
            <tr>
                <td><p><b>English in Brazil</b></p></td>
                <td><p>Ótimo para inglês acessível.</p></td>
                <td><a href='https://www.youtube.com/@CarinaFragozo' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
            </tr>
        </table>";
}

//====================== recomendações para Humanas ========================
if ($dificuldade === "humanas") {
    echo "
        <h4 class='text-orange mb-3'>Dificuldade em Ciências da Humanas</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td style='padding: 10px;'><p><b>Mapas Conceituais</b></p></td>
                <td style='padding: 10px;'><p>Ligar causas, consequências e personagens em diagramas para fixar melhor o conteúdo.</p></td>
                <td><a href='https://www.mindmeister.com/pt' class='btn bg-orange text-white' target='_blank'><p>Ver método Mapas Conceituais</p></a></td>
            </tr>
            <tr>
                <td style='padding: 10px;'><p><b>Storytelling</b></p></td>
                <td style='padding: 10px;'><p>Transformar fatos históricos em narrativas para melhorar a compreensão e a memória.</p></td>
                <td><a href='https://www.bernoulli.com.br/blog/como-transformar-suas-aulas-em-experiencias-inesqueciveis-com-o-storytelling/' class='btn bg-orange text-white' target='_blank'><p>Ver método Storytelling</p></a></td>
            </tr>
        </table>

        <hr>
        <h4 class='text-orange mb-3'>Vídeo Aulas</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Canal</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Canal do Pirula</b></p></td>
                <td><p>Explicações históricas e sociais aprofundadas, mas acessíveis.</p></td>
                <td><a href='https://www.youtube.com/@Pirulla25' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
            </tr>
            <tr>
                <td><p><b>Nerdologia</b></p></td>
                <td><p>História, Sociologia e Filosofia de forma leve e divertida.</p></td>
                <td><a href='https://www.youtube.com/@nerdologia' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
            </tr>
            <tr>
                <td><p><b>Se Liga Nessa História</b></p></td>
                <td><p>Revisões rápidas e diretas para o ENEM e vestibulares.</p></td>
                <td><a href='https://www.youtube.com/@seliganessahistoriaa' class='btn bg-orange text-white' target='_blank'><p>Ver canal</p></a></td>
            </tr>
        </table>";
}
                
                    //======================fim 1. Qual área você sente mais dificuldade?======================

                    //====================== inicio 2. Qual formato de estudo você prefere?========================
                    //======================recomendações para texto========================
                    //====================== recomendações para texto ========================
if ($metodo_preferido === "texto") {
    echo "
        <hr>
        <h4 class='text-orange mb-3'>Prefere estudar por Textos e Resumos</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Técnica de Cornell</b></p></td>
                <td><p>Divida a folha em 3 partes: anotações, palavras-chave e resumo final.</p></td>
                <td><a href='https://conexao.pucminas.br/blog/dicas/metodo-cornell/' class='btn bg-orange text-white' target='_blank'><p>Ver método</p></a></td>
            </tr>
            <tr>
                <td><p><b>Active Recall (Recordação Ativa)</b></p></td>
                <td><p>Feche o resumo e tente relembrar o conteúdo sem olhar.</p></td>
                <td><a href='https://exame.com/carreira/guia-de-carreira/5-formas-de-aplicar-a-recordacao-ativa-para-estudar-melhor/' class='btn bg-orange text-white' target='_blank'><p>Ver método</p></a></td>
            </tr>
        </table>";
}

//====================== recomendações para vídeo ========================
if ($metodo_preferido === "video") {
    echo "
        <h4 class='text-orange mb-3'>Prefere estudar por Vídeos Explicativos</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Método de Anotação em 2 Colunas</b></p></td>
                <td><p>No lado esquerdo anote o que o professor explica e, no direito, dúvidas ou exemplos próprios.</p></td>
                <td><a href='https://estudeemcasa.educacao.pe.gov.br/metodo-de-anotacao' class='btn bg-orange text-white' target='_blank'><p>Ver exemplo</p></a></td>
            </tr>
            <tr>
                <td><p><b>Aprendizado Multimodal</b></p></td>
                <td><p>Assista a vídeos e depois consolide o conteúdo com exercícios.</p></td>
                <td><a href='https://www.iseazy.com/br/blog/aprendizagem-multimodal/' class='btn bg-orange text-white' target='_blank'><p>Ver método</p></a></td>
            </tr>
        </table>";
}

//====================== recomendações para exercício ========================
if ($metodo_preferido === "exercicio") {
    echo "
        <h4 class='text-orange mb-3'>Prefere estudar por Exercícios Práticos</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Prática Intercalada</b></p></td>
                <td><p>Alterne tipos de questões, como álgebra e geometria, para treinar o cérebro em diferentes conexões.</p></td>
                <td><a href='https://www.educamaisbrasil.com.br/enem/noticias/como-usar-a-pratica-intercalada-nos-estudos' class='btn bg-orange text-white' target='_blank'><p>Ver método</p></a></td>
            </tr>
            <tr>
                <td><p><b>Teste Prático (Practice Testing)</b></p></td>
                <td><p>Simule condições reais de prova para melhorar o desempenho.</p></td>
                <td><a href='https://guiadoestudante.abril.com.br/estudo/metodo-de-testes-praticos/' class='btn bg-orange text-white' target='_blank'><p>Ver dica</p></a></td>
            </tr>
        </table>";
}

//====================== recomendações para mapa ========================
if ($metodo_preferido === "mapa") {
    echo "
        <h4 class='text-orange mb-3'>Prefere estudar por Mapas Mentais e Flashcards</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Flashcards com Spaced Repetition</b></p></td>
                <td><p>Use repetição espaçada para reforçar a memória de longo prazo.</p></td>
                <td><a href='https://quizlet.com/latest' class='btn bg-orange text-white' target='_blank'><p>Ver método</p></a></td>
            </tr>
            <tr>
                <td><p><b>Dual Coding</b></p></td>
                <td><p>Combine imagens e palavras no mesmo mapa mental para aumentar a retenção.</p></td>
                <td><a href='https://www.innerdrive.co.uk/blog/what-is-dual-coding/' class='btn bg-orange text-white' target='_blank'><p>Ver método</p></a></td>
            </tr>
        </table>";
}

                    //======================fim 2. Qual formato de estudo você prefere?========================

                    //====================== inicio 3. Quanto tempo por dia você consegue estudar?========================
//====================== Recomendações para menos de 30min ========================
if ($horario_estudo === "menos_30min") {
    echo "
        <hr>
        <h4 class='text-orange mb-3'>Consegue estudar por até 30 minutos</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Técnica Pomodoro Curta</b></p></td>
                <td><p>Tempo de estudos curto (15 min foco + 5 min pausa).</p></td>
                <td><a href='https://tecnicapomodoro.com.br/' class='btn bg-orange text-white' target='_blank'><p>Ver Método</p></a></td>
            </tr>
            <tr>
                <td><p><b>Microlearning</b></p></td>
                <td><p>Aprender em pequenas doses (vídeos curtos, 3-5 flashcards).</p></td>
                <td><a href='https://www.iseazy.com/br/comparativo/melhores-aplicativos-de-microlearning/' class='btn bg-orange text-white' target='_blank'><p>Ver Método</p></a></td>
            </tr>
        </table>";
}

//====================== Recomendações para 30min a 1h ========================
if ($horario_estudo === "30min_1h") {
    echo "
        <hr>
        <h4 class='text-orange mb-3'>Consegue estudar de 30 minutos a 1 hora</h4> 
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Pomodoro Padrão</b></p></td>
                <td><p>Foco intenso seguido de pausa curta (25 min foco + 5 min pausa).</p></td>
                <td><a href='https://tecnicapomodoro.com.br/' class='btn bg-orange text-white' target='_blank'><p>Ver Método</p></a></td>
            </tr>
            <tr>
                <td><p><b>Revisão Diária Rápida</b></p></td>
                <td><p>Ao final do estudo, gastar 5 minutos para revisar mentalmente.</p></td>
                <td></td>
            </tr>
        </table>";
}

//====================== Recomendações para 1h a 2h ========================
if ($horario_estudo === "1h_2h") {
    echo "
        <hr>
        <h4 class='text-orange mb-3'>Consegue estudar de 1 hora a 2 horas</h4> 
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Blocos de Estudo (Study Blocks)</b></p></td>
                <td><p>50 minutos de estudo + 10 minutos de pausa.</p></td>
                <td><a href='https://cursoagoraeupasso.com.br/glossario/qual-e-a-importancia-dos-blocos-de-estudo/' class='btn bg-orange text-white' target='_blank'><p>Ver Método</p></a></td>
            </tr>
            <tr>
                <td><p><b>Método Leitner</b></p></td>
                <td><p>Usar caixas de flashcards organizadas por nível de dificuldade.</p></td>
                <td><a href='https://www.cursoevidente.com.br/destaques?code=235' class='btn bg-orange text-white' target='_blank'><p>Ver Método</p></a></td>
            </tr>
        </table>";
}

//====================== Recomendações para mais de 2h ========================
if ($horario_estudo === "mais_2h") {
    echo "
        <hr>
        <h4 class='text-orange mb-3'>Consegue estudar por mais de 2 horas</h4> 
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Ciclo de Estudo 4-3-2-1</b></p></td>
                <td><p>40 minutos de estudo, 30 minutos de revisão, 20 minutos de prática e 10 minutos de resumo.</p></td>
                <td></td>
            </tr>
            <tr>
                <td><p><b>Estudo Intercalado</b></p></td>
                <td><p>Alternar matérias a cada 1 hora para evitar cansaço mental.</p></td>
                <td></td>
            </tr>
        </table>";
}

//====================== Prefere estudar sozinho ========================
if ($metodo_preferido === "sozinho") {
    echo "
        <hr>
        <h4 class='text-orange mb-3'>Prefere estudar sozinho</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Autoexplicação</b></p></td>
                <td><p>Falar em voz alta o raciocínio durante a resolução de problemas.</p></td>
                <td><a href='https://guiadoestudante.abril.com.br/coluna/dicas-estudo/ler-em-voz-alta-ajuda-a-fixar-coisas-na-memoria-diz-estudo/' class='btn bg-orange text-white' target='_blank'><p>Ver Método</p></a></td>
            </tr>
            <tr>
                <td><p><b>Método Feynman</b></p></td>
                <td><p>Ensinar para si mesmo ou explicar para objetos/paredes como se estivesse dando uma aula.</p></td>
                <td><a href='https://napratica.org.br/noticias/aprenda-rapido-com-tecnica-feynman' class='btn bg-orange text-white' target='_blank'><p>Ver Método Feynman</p></a></td>
            </tr>
        </table>";
}

//====================== Prefere estudar em grupo ========================
if ($metodo_preferido === "grupo") {
    echo "
        <hr>
        <h4 class='text-orange mb-3'>Prefere estudar em grupo</h4>
        <table style='width: 100%; border-collapse: collapse;'>
            <tr style='background-color: #fff3e0;'>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Método</p></th>
                <th style='text-align: left; padding: 10px; width: 40%; color: #ff8c00;'><p>Descrição</p></th>
                <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
            </tr>
            <tr>
                <td><p><b>Estudo Cooperativo</b></p></td>
                <td><p>Dividir tarefas, ensinar uns aos outros e discutir dúvidas para reforçar o aprendizado.</p></td>
                <td><a href='https://www.scielo.br/j/rbedu/a/3jR7kD7L6Zf7sfYkqfxpz6F/?lang=pt' class='btn bg-orange text-white' target='_blank'><p>Ver Método</p></a></td>
            </tr>
            <tr>
                <td><p><b>Grupos de Discussão</b></p></td>
                <td><p>Debater temas para aprofundar o entendimento e desenvolver pensamento crítico.</p></td>
                <td><a href='https://www.todamateria.com.br/grupo-de-estudo/' class='btn bg-orange text-white' target='_blank'><p>Ver Método</p></a></td>
            </tr>
        </table>";
}
                   // ====================== início - O que mais atrapalha seus estudos? =========================
if ($atrapalha === "falta_concentracao") {
    echo "
    <hr>
    <h4 class='text-orange mb-3'>Falta de concentração</h4>
    <table style='width: 100%; border-collapse: collapse;'>
        <tr style='background-color: #fff3e0;'>
            <th style='text-align: left; padding: 10px; width: 25%; color: #ff8c00;'><p>Método</p></th>
            <th style='text-align: left; padding: 10px; width: 55%; color: #ff8c00;'><p>Descrição</p></th>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
        </tr>
        <tr>
            <td><p><b>Técnica Pomodoro (25+5)</b></p></td>
            <td><p>Estude por 25 minutos com foco total e descanse 5 minutos. Isso ajuda o cérebro a manter a concentração por mais tempo.</p></td>
            <td><a href='https://tecnicapomodoro.com.br/' target='_blank' class='btn bg-orange text-white'><p>Ver método</p></a></td>
        </tr>
        <tr>
            <td><p><b>Ambientação Sensorial</b></p></td>
            <td><p>Estude sempre no mesmo local e horário. Isso ajuda o cérebro a “entrar no modo estudo” com mais facilidade.</p></td>
        </tr>
    </table>";
}

// ====================== falta de organização =========================
if ($atrapalha === "falta_organizacao") {
    echo "
    <hr>
    <h4 class='text-orange mb-3'>Falta de organização</h4>
    <table style='width: 100%; border-collapse: collapse;'>
        <tr style='background-color: #fff3e0;'>
            <th style='text-align: left; padding: 10px; width: 25%; color: #ff8c00;'><p>Método</p></th>
            <th style='text-align: left; padding: 10px; width: 55%; color: #ff8c00;'><p>Descrição</p></th>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
        </tr>
        <tr>
            <td><p><b>Bullet Journal</b></p></td>
            <td><p>Crie um diário visual para organizar suas metas, tarefas e prazos de estudo.</p></td>
            <td><a href='https://napratica.org.br/noticias/bullet-journal' target='_blank' class='btn bg-orange text-white'><p>Ver método</p></a></td>
        </tr>
        <tr>
            <td><p><b>Kanban de Estudos</b></p></td>
            <td><p>Monte um quadro com colunas “A Fazer”, “Fazendo” e “Feito” para acompanhar o progresso dos estudos.</p></td>
            <td><a href='https://checklistfacil.com/blog/metodologia-kanban/?utm_source=google&utm_medium=cpc&utm_campaign=BR-PT-PAID-CF-GOOGLE-SEARCH-MATERIAIS_NOVOS_LEADS--DSA-BLOG&utm_term&gclid=Cj0KCQjw9czHBhCyARIsAFZlN8TxmoRBQrSCluJbcE826N9DdsNSmb79Sb1Jkbfw_nHx756pCuehDp8aApBjEALw_wcB' target='_blank' class='btn bg-orange text-white'><p>Ver modelo</p></a></td>
        </tr>
    </table>";
}

// ====================== preguiça ou falta de motivação =========================
if ($atrapalha === "preguica") {
    echo "
    <hr>
    <h4 class='text-orange mb-3'>Preguiça / Falta de motivação</h4>
    <table style='width: 100%; border-collapse: collapse;'>
        <tr style='background-color: #fff3e0;'>
            <th style='text-align: left; padding: 10px; width: 25%; color: #ff8c00;'><p>Método</p></th>
            <th style='text-align: left; padding: 10px; width: 55%; color: #ff8c00;'><p>Descrição</p></th>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
        </tr>
        <tr>
            <td><p><b>Gamificação</b></p></td>
            <td><p>Transforme o estudo em um jogo com recompensas e desafios. Use apps como Habitica para aumentar a motivação.</p></td>
            <td><a href='https://habitica.com/' target='_blank' class='btn bg-orange text-white'><p>Ver app</p></a></td>
        </tr>
        <tr>
            <td><p><b>Metas SMART</b></p></td>
            <td><p>Defina metas específicas, mensuráveis, alcançáveis, relevantes e com prazos claros.</p></td>
            <td><a href='https://www.napratica.org.br/metas-smart/' target='_blank' class='btn bg-orange text-white'><p>Ver método</p></a></td>
        </tr>
    </table>";
}

// ====================== não entender a explicação =========================
if ($atrapalha === "nao_entender") {
    echo "
    <hr>
    <h4 class='text-orange mb-3'>Dificuldade em entender explicações</h4>
    <table style='width: 100%; border-collapse: collapse;'>
        <tr style='background-color: #fff3e0;'>
            <th style='text-align: left; padding: 10px; width: 25%; color: #ff8c00;'><p>Método</p></th>
            <th style='text-align: left; padding: 10px; width: 55%; color: #ff8c00;'><p>Descrição</p></th>
            <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
        </tr>
        <tr>
            <td><p><b>Método Multimodal</b></p></td>
            <td><p>Estude o mesmo conteúdo de formas diferentes: lendo, assistindo vídeos e fazendo exercícios.</p></td>
            <td><a href='https://www.iseazy.com/br/blog/aprendizagem-multimodal/' target='_blank' class='btn bg-orange text-white'><p>Ver método</p></a></td>
        </tr>
        <tr>
            <td><p><b>Estudo por Analogias</b></p></td>
            <td><p>Transforme conceitos difíceis em exemplos do cotidiano para facilitar o entendimento.</p></td>
        </tr>
    </table>";
}
// ====================== fim - O que mais atrapalha seus estudos? =========================


// ====================== início - Sites e Aplicativos úteis =========================
echo "
<hr>
<h4 class='text-orange mb-3'>Sites e Aplicativos que podem te ajudar a estudar melhor</h4>
<table style='width: 100%; border-collapse: collapse;'>
    <tr style='background-color: #fff3e0;'>
        <th style='text-align: left; padding: 10px; width: 25%; color: #ff8c00;'><p>Nome</p></th>
        <th style='text-align: left; padding: 10px; width: 55%; color: #ff8c00;'><p>Descrição</p></th>
        <th style='text-align: left; padding: 10px; width: 20%; color: #ff8c00;'><p>Link</p></th>
    </tr>

    <tr>
        <td><p><b>VestCards</b></p></td>
        <td><p>Plataforma de <b>flashcards</b> com perguntas prontas, ideal para revisar conteúdos de vestibulares e ENEM.</p></td>
        <td><a href='https://vestcards.com.br/' target='_blank' class='btn bg-orange text-white'><p>Acessar</p></a></td>
    </tr>

    <tr>
        <td><p><b>TILF</b></p></td>
        <td><p>Ferramenta de <b>correção de redações</b> com feedback sobre gramática, coesão e estrutura do texto.</p></td>
        <td><a href='https://www.tilf.io/pt' target='_blank' class='btn bg-orange text-white'><p>Acessar</p></a></td>
    </tr>

    <tr>
        <td><p><b>Notebook LM</b></p></td>
        <td><p>Gera <b>resumos e podcasts</b> automaticamente a partir de PDFs e arquivos de estudo. Disponível como site e app.</p></td>
        <td><a href='https://notebooklm.google.com/' target='_blank' class='btn bg-orange text-white'><p>Acessar</p></a></td>
    </tr>

    <tr>
        <td><p><b>Gauth Math</b></p></td>
        <td><p>Auxilia na <b>resolução de questões de exatas</b> (matemática, física, química) usando reconhecimento de imagem.</p></td>
        <td><a href='https://www.gauthmath.com/' target='_blank' class='btn bg-orange text-white'><p>Acessar</p></a></td>
    </tr>

    <tr>
        <td><p><b>Quizlet</b></p></td>
        <td><p>Aplicativo de <b>flashcards personalizados</b>. Crie seus próprios cards com base em livros, anotações ou aulas.</p></td>
        <td><a href='https://quizlet.com/' target='_blank' class='btn bg-orange text-white'><p>Acessar</p></a></td>
    </tr>

    <tr>
        <td><p><b>Quiz da Tabela Periódica</b></p></td>
        <td><p>Jogo educativo que ajuda na <b>memorização dos elementos químicos</b> de forma divertida.</p></td>
        <td><a href='https://pt.quizur.com/tag/9ux-tabela-periodica#google_vignette' target='_blank' class='btn bg-orange text-white'><p>Acessar</p></a></td>
    </tr>

    <tr>
        <td><p><b>Study Bunny</b></p></td>
        <td><p>Aplicativo lúdico em que um coelho fica mais feliz conforme você estuda. Permite criar um <b>cronograma de estudos</b> e usar flashcards.</p></td>
        <td><a href='https://play.google.com/store/apps/details?id=com.superbyte.studybunny' target='_blank' class='btn bg-orange text-white'><p>Acessar</p></a></td>
    </tr>

    <tr>
        <td><p><b>Meu Horário</b></p></td>
        <td><p>App simples de <b>agendamento de tarefas e matérias</b>. Ideal para planejar sua rotina de estudos.</p></td>
        <td><a href='https://play.google.com/store/apps/details?id=bies.ar.monplanning&hl=pt_BR' target='_blank' class='btn bg-orange text-white'><p>Acessar</p></a></td>
    </tr>
</table>
";
    }}

 
include "includes/footer.php";
?>

