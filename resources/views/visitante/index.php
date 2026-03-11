<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IPVP | Cadastro de Visitante</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/img/logo-fundo-branco.png" rel="icon">
</head>

<body>
    <header class="header">
        <img src="assets/img/logo_branco.svg" alt="Logo IPVP" width="100">
        <h3>Igreja Presbiteriana de Vila Prudente</h3>
    </header>

    <main class="container">
        <section class="row justify-content-center mt-4">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="box hello">
                    <p class="hello-title"><b>Olá visitante, bem vindo(a)!</b></p>

                    <p>Ficamos muito felizes em receber você aqui.</p>

                    <p>Este formulário foi criado para que possamos te conhecer um pouco melhor.
                        Se puder, reserve alguns minutos para preencher os campos abaixo.</p>

                    <p>As informações enviadas serão tratadas com total confidencialidade.
                        Para saber mais sobre a Política de Privacidade da Igreja Presbiteriana do Brasil,
                        acesse<a href="https://ipb.org.br/politica-de-privacidade" target="_blank">
                            ipb.org.br/politica-de-privacidade</a>.</p>

                    <p>Caso tenha dúvidas ou solicitações relacionadas aos seus dados pessoais,
                        entre em contato pelo e-mail <b>conselhoipvp@gmail.com</b>.</p>

                    <p>Agradecemos muito pelo seu tempo e pela sua colaboração.Vamos começar?</p>
                </div>
            </div>
        </section>

        <section class="row justify-content-center mt-4">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <form method="POST" id="form">
                    <div class="box form-group">
                        <label for="dataVisita">Quando você nos visitou? <span class="required">*</span></label>
                        <input class="form-control" name="dataVisita" id="dataVisita" type="date" required>
                    </div>

                    <div class="box form-group">
                        <label for="nome">Qual é o seu nome? <span class="required">*</span></label>
                        <input class="form-control" name="nome" id="nome" maxlength="50" type="text" required>
                    </div>

                    <div class="box form-group">
                        <label for="idade">Quantos anos você tem? <span class="required">*</span></label>
                        <input class="form-control" name="idade" id="idade" maxlength="2" placeholder="Somente números" type="text" required>
                    </div>

                    <div class="box form-group">
                        <label for="telefone">Pode nos informar o seu número? <span class="required">*</span></label>
                        <input class="form-control" name="telefone" id="telefone" type="text" oninput="mask(this, 'CEL')" maxlength="15" placeholder="Somente números com DDD (XX)" required>
                    </div>

                    <div class="box form-group">
                        <label for="email">Qual o seu e-mail? <span class="required">*</span></label>
                        <input class="form-control" name="email" id="email" type="text" autocomplete="off" required>
                    </div>

                    <div class="box form-group">
                        <label for="frequentaIgreja">Você frequenta alguma igreja? Se sim, qual?</label>
                        <input class="form-control" name="frequentaIgreja" id="frequentaIgreja" maxlength="70" type="text">
                    </div>

                    <div class="box form-group">
                        <label for="pedidoOracao">Gostaríamos de orar por você. Há algum pedido especial?</label>
                        <input class="form-control" name="pedidoOracao" id="pedidoOracao" maxlength="70" type="text">
                    </div>

                    <fieldset class="box form-group">
                        <legend class="form-legend">Como você ficou sabendo de nós? <span class="required">*</span></legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="origem" id="indicacao" value="indicacao" required>
                            <label class="form-check-label" for="indicacao">Indicação</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="origem" id="convite" value="convite">
                            <label class="form-check-label" for="convite">Convite</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="origem" id="moroPerto" value="moroPerto">
                            <label class="form-check-label" for="moroPerto">Moro perto</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="origem" id="redesSociais" value="redesSociais">
                            <label class="form-check-label" for="redesSociais">Redes sociais</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="origem" id="outro" value="outro">
                            <label class="form-check-label" for="outro">Outro</label>
                        </div>
                        <input class="form-control mt-2" name="outroComplemento" id="outroComplemento" type="text" disabled="disabled">
                    </fieldset>
                    
                    <div id="divAlerta" role="alert" class="alert">
                        <span id="msgAlerta"></span>
                    </div>

                    <div class="box consent-notice">
                        <p>Ao clicar em <b>Enviar</b>, você declara estar ciente e de acordo com o tratamento
                            de seus dados pessoais conforme os termos acima.</p>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success btn-sm">Enviar</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer text-center mt-3">
        <span>
            <i class="fa-brands fa-instagram"></i><a href="https://www.instagram.com/ipvilaprudente/" target="_blank"> ipvilaprudente</a> |
            <i class="fa-brands fa-instagram"></i><a href="https://www.instagram.com/ipjovens/" target="_blank"> ipjovens</a>
        </span>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="assets/js/app.js"></script>
    <script src="assets/js/mask.js"></script>
    <script src="assets/js/toggleField.js"></script>

</body>
</html>
