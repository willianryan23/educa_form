<?php
session_start();
include "includes/header.php";
include "includes/navbar.php";
?>

    <!-- Seção de Boas-Vindas -->
    <div>

        <div class="card_r shadow-lg p-4 border-0 bg-light-orange">
            <h1 class="fw-bold text-orange mb-4">Bem-vindo ao <span class="text-orange">EducaForms</span>!</h1>
            <p>
                Transforme sua forma de estudar com uma plataforma interativa que une <strong>tecnologia e inclusão</strong>.
            </p>
            <a href="formulario.php" class="btn bg-orange text-white fw-semibold py-2 px-4 shadow-sm">Começar Agora</a>
        </div>

        <!-- Seção Sobre Nós -->
        <div class="card_r shadow-lg p-4 border-0 bg-light-orange">
            <h2 class="fw-bold text-orange mb-3">Sobre Nós</h2>
            <p>
                O <strong>EducaForms</strong> é um projeto que transforma o conteúdo escolar em <strong>formulários interativos</strong> 
                para facilitar o estudo dos alunos. Em vez de estudar apenas por textos longos, o estudante responde perguntas, 
                faz atividades e recebe <strong>feedback imediato</strong>, tornando o aprendizado mais dinâmico e eficiente.
            </p>
            <p>
                Além disso, o projeto se preocupa com o <strong>meio ambiente</strong> ao utilizar materiais ecológicos no kit de estudos 
                e também busca ser <strong>inclusivo</strong>, adaptando os formulários para alunos autistas ou com TDAH.
                Ele acompanha a <strong>evolução do aluno</strong> ao longo do tempo, servindo como uma ferramenta de apoio pedagógico.
            </p>
            <p>
                O EducaForms será apresentado em uma <strong>Feira de Ciências</strong>, mostrando como a tecnologia, a sustentabilidade 
                e a inclusão podem caminhar juntas para melhorar a educação.
            </p>
        </div>

        <!-- Seção de Utilidades -->
        <div class="card_r shadow-lg p-4 border-0 bg-light-orange">
            <h2 class="fw-bold text-orange mb-3">Utilidades da Plataforma</h2>

            <div class="row justify-content-center" style="gap: 10px;">
            
                <div class="card p-3 shadow-sm border-0">
                    <h5 class="fw-bold text-orange mb-2">📚 Formulário Prático</h5>
                    <p>Os alunos respondem um formulários que que busca aprender sobre seus hábitos de estudos para ajudar da melhor forma possível.</p>
                </div>

            
                <div class="card p-3 shadow-sm border-0">
                    <h5 class="fw-bold text-orange mb-2">💡 Feedback Imediato</h5>
                    <p>Ao responder o formulário, o aluno recebe retorno automático, entendendo onde precisa melhorar e reforçar os seus estudos, e recebe dicas de materiais para estudos.</p>
                </div>
            
                <div class="card p-3 shadow-sm border-0">
                    <h5 class="fw-bold text-orange mb-2">🤝 materiais adaptados</h5>
                    <p>A plataforma fornece materiais de estudos com base nas suas necessidades.</p>
                </div>
            </div>
        </div>

        <!-- Chamada final -->
        <div class="card_r shadow-lg p-4 border-0 bg-light-orange">
            <h2 class="fw-bold text-orange mb-3">Comece a aprender de forma inteligente 🌟</h2>
            <p class="lead mb-4">Participe do EducaForms e descubra um novo jeito de estudar com interatividade e propósito.</p>
            <a href="login.php" class="btn bg-orange text-white fw-semibold py-2 px-4 shadow-sm">Acessar minha conta</a>
        </div>

    </div>

<?php
include "includes/footer.php";
?>
