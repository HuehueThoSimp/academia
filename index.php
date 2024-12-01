<?php
// Variáveis para armazenar as respostas
$nome = $data = $hora = $personal = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $personal = $_POST['personal'];

    // Aqui seria o local para salvar em banco de dados ou enviar para o Discord
    // Para efeito do exemplo, estamos apenas exibindo uma confirmação
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Agende Sua Aula Experimental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
       body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f8;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start; /* Ajustado para alinhar o conteúdo no topo */
    height: 100vh;
    margin: 0;
    text-align: center;
    color: #333;
    padding-bottom: 60px; /* Deixa um espaço para o rodapé */
}

        .container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            width: 100%;
        }

        h1 {
            color: #1f8c95;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .message {
            background-color: #e0f7fa;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            color: #333;
            display: none;
        }

        .response {
            background-color: #f8f8f8;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 18px;
            color: #555;
            display: none;
        }

        input, select {
            padding: 12px;
            margin-bottom: 15px;
            width: 80%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        

        button {
            background-color: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: none;
            margin-top: 20px;
            margin-left: 100px;
        }

        button:hover {
            background-color: #218838;
        }

        #submitButton {
    margin-top: 20px;
    display: block; /* Muda de inline-block para block */
    margin-left: auto; /* Garante o alinhamento automático à esquerda */
    margin-right: auto; /* Garante o alinhamento automático à direita */
    width: auto; /* Ajusta a largura do botão conforme o conteúdo */
}
        #notify {
            background-color: #4caf50;
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 18px;
            display: none;
            max-width: 400px;
            margin: 20px auto;
            text-align: center;
        }

 
        footer {
            background-color: #1f8c95;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
            position: relative;
            bottom: 0;
        }

        footer .contact-info {
            margin: 10px 0;
            font-size: 16px;
        }

        footer .contact-info a {
            color: #fff;
            text-decoration: none;
        }

        footer .contact-info a:hover {
            text-decoration: underline;
        }

        footer .contact-info .icon {
            color: #ccc; /* Cor cinza para os ícones */
            margin-right: 10px;
        }

        .banner {
    width: 100%;
    height: 200px;
    background-image: url('https://via.placeholder.com/1200x200'); /* Substitua pela URL da sua imagem */
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

        .banner p {
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }


        .cta-text {
            font-size: 1.4rem;
            margin-top: 40px;
            color: #1f8c95;
        }

        .copyright {
    color: black;
    text-align: center;
    padding: 10px;
    font-size: 14px;
    margin-top: 20px;
}

.copyright p {
    margin: 0;
}

    </style>
</head>
<body>

    <div class="container">
        <h1>Agende Sua Aula Experimental</h1>
        
        <!-- Mensagens com o efeito de digitação -->
        <div id="message1" class="message">
            <p class="typing">Olá! Estou aqui para marcar sua Aula Experimental! 🎉</p>
            <p> Qual seu Nome?</p>
        </div>
        
        <div id="response1" class="response">
            <input type="text" id="nome" name="nome" placeholder="Seu nome..." maxlength="250" oninput="checkInput('nome')" />
            <button id="nextButton1" onclick="nextStep(1)">Próxima Etapa</button>
        </div>

        <div id="message2" class="message">
            <p class="typing">Qual é a data da sua aula?</p>
        </div>
        
        <div id="response2" class="response">
            <input type="date" id="data" name="data" oninput="checkInput('data')" />
            <button id="nextButton2" onclick="nextStep(2)">Próxima Etapa</button>
        </div>

        <div id="message3" class="message">
            <p class="typing">Que horas você prefere?</p>
        </div>
        
        <div id="response3" class="response">
            <input type="time" id="hora" name="hora" oninput="checkInput('hora')" />
            <button id="nextButton3" onclick="nextStep(3)">Próxima Etapa</button>
        </div>

        <div id="message4" class="message">
            <p class="typing">Agora, escolha seu personal trainer:</p>
        </div>
        
        <div id="response4" class="response">
            <select id="personal" name="personal" oninput="checkInput('personal')">
                <option value="Carlos">Carlos</option>
                <option value="Antonio">Antonio</option>
                <option value="José">José</option>
                <option value="Fabio">Fabio</option>
            </select>
            <button id="submitButton" onclick="submitForm()">Confirmar Agendamento</button>
        </div>

        <!-- Notificação -->
        <div id="notify">
            Agendamento confirmado com sucesso!
        </div>
    </div>

    <div class="banner">
            <p>Agende sua aula experimental agora mesmo!</p>
        </div>

        <!-- Chamada para ação -->
        <div class="cta-text">
            <p>Pronto para treinar junto com a gente?</p>
        </div>
    </div>

    <footer>
        <div class="contact-info">
        <p><i class="fab fa-whatsapp icon"></i> WhatsApp: <a href="https://wa.me/1234567890" target="_blank">+55 12 3456-7890</a></p>
        <p><i class="fas fa-phone icon"></i> Telefone: <a href="tel:+551234567890">+55 12 3456-7890</a></p>
            <p><i class="fas fa-map-marker-alt icon"></i>  Rua Exemplo, 123, Bairro, Cidade - Estado</p>
        </div>
    </footer>

    <!-- Copyright -->
<div class="copyright">
    <p>© 2024 Desenvolvido por Martins</p>
</div>

    <script>
        let step = 0;

        // Função para verificar se o campo foi preenchido e mostrar o botão "Próxima Etapa"
        function checkInput(field) {
            const value = document.getElementById(field).value.trim();
            const nextButton = document.getElementById(`nextButton${field === 'nome' ? 1 : field === 'data' ? 2 : field === 'hora' ? 3 : 4}`);
            if (value !== "") {
                nextButton.style.display = 'block';
            } else {
                nextButton.style.display = 'none';
            }
        }

        // Função para mostrar a próxima pergunta quando o botão "Próxima Etapa" for clicado
        function nextStep(currentStep) {
            // Verifica se o campo atual está preenchido, se sim, passa para a próxima etapa
            if (currentStep === 1 && document.getElementById('nome').value.trim() !== "") {
                showNextStep('message2', 'response2');
            } else if (currentStep === 2 && document.getElementById('data').value.trim() !== "") {
                showNextStep('message3', 'response3');
            } else if (currentStep === 3 && document.getElementById('hora').value.trim() !== "") {
                showNextStep('message4', 'response4');
            } else if (currentStep === 4 && document.getElementById('personal').value.trim() !== "") {
                showNextStep('submitButton');
            }
        }

        function showNextStep(nextMessageId, nextResponseId) {
            if (nextMessageId) {
                document.getElementById(nextMessageId).style.display = 'block';
            }
            if (nextResponseId) {
                document.getElementById(nextResponseId).style.display = 'block';
            }
            // Esconde a etapa anterior
            const currentMessage = document.querySelector('.message[style*="display: block"]');
            const currentResponse = document.querySelector('.response[style*="display: block"]');
            
            if (currentMessage) {
                currentMessage.style.display = 'none';
            }
            if (currentResponse) {
                currentResponse.style.display = 'none';
            }
        }

        // Função para submeter o formulário, enviar ao Discord e exibir a notificação
        async function submitForm() {
            var nome = document.getElementById('nome').value;
            var data = document.getElementById('data').value;
            var hora = document.getElementById('hora').value;
            var personal = document.getElementById('personal').value;

            // Envia os dados para o Discord via Webhook
            const webhookURL = "https://discord.com/api/webhooks/1312858797244551239/Vdw6YaXyhdQtldxwUE0Y73w8NDXV1CLpjen5YpUDmsMYsD64P02X8pQb_xC7H6Y1VaDo"; // Substitua com sua URL do Discord Webhook

            const payload = {
    content: `**Novo Agendamento**\n\n\`\`\`
Nome: ${nome}
Data: ${data}
Hora: ${hora}
Personal: ${personal}
\`\`\``
};


            // Envia para o Discord
            await fetch(webhookURL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            // Exibe a notificação de confirmação
            document.getElementById('notify').style.display = 'block';
        }

        // Inicia a animação da primeira pergunta
        window.onload = function() {
            setTimeout(function() {
                document.getElementById('message1').style.display = 'block';
                document.getElementById('response1').style.display = 'block';
            }, 1000);
        }
    </script>
</body>
</html>
