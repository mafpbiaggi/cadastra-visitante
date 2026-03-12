function preparaSaida($class, $resp) {
    if (divAlerta) divAlerta.className = $class;
    if (msgAlerta) msgAlerta.innerText = $resp;
}

function confirmaEnvio() {
    return confirm("Tem certeza que deseja enviar os dados? Caso queira revisar os campos, clique em CANCELAR.");
}

const form = document.getElementById("form");
const divAlerta = document.getElementById("divAlerta");
const msgAlerta = document.getElementById("msgAlerta");

if (divAlerta) divAlerta.className = "";
if (msgAlerta) msgAlerta.innerText = "";

if (form) {
    form.addEventListener("submit", async (e) => {
        if (!confirmaEnvio()) {
            e.preventDefault();
            return;
        }

        e.preventDefault();
        const dadosForm = new FormData(form);

        try {
            const dados = await fetch("index.php", {
                method: "POST",
                body: dadosForm
            });

            const resposta = await dados.json();

            const csrfInput = form.querySelector('input[name="csrf_token"]');
            if (csrfInput && resposta['csrf_token']) {
                csrfInput.value = resposta['csrf_token'];
            }

            if (resposta['status']) {
                preparaSaida("alert alert-success", resposta['msg']);
                form.reset();

            } else {
                preparaSaida("alert alert-danger", resposta['msg']);
            }
            
        } catch (error) {
            preparaSaida("alert alert-danger", "Erro ao processar envio.");
            console.log(error);
        }
    });
}
