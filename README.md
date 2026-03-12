# Cadastra Visitante

Aplicação web para cadastro de visitantes a um estabelecimento. Desenvolvida como complemento a um sistema externo,
utilizando o banco de dados desse sistema para persistência dos dados.

> **Atenção:** esta aplicação não gerencia o banco de dados. Ela espera que a tabela `visitantes`
> já exista com a estrutura correta. Caso queira executá-la de forma independente,
> será necessário criar o banco de dados e a tabela manualmente.
> Consulte a seção [Uso independente](#uso-independente) para mais detalhes.

## Requisitos

- Docker
- Docker Compose

## Estrutura do projeto

```
cadastra-visitante/
├── docker/                   # Configurações Docker
│   ├── .env.example          # Modelo de variáveis de ambiente
│   ├── Dockerfile
│   └── docker-compose.yaml
├── public/                   # Ponto de entrada da aplicação
│   └── index.php
├── resources/
│   └── views/                # Templates HTML
├── src/
│   ├── Config/               # Bootstrap, Database, Router e Routes
│   ├── Controllers/          # Controllers da aplicação
│   ├── Models/               # Modelos de acesso ao banco
│   ├── Security/             # CSRF e Rate Limiting
│   └── Validator/            # Validação e sanitização de dados
├── composer.json
├── composer.lock
├── LICENSE
└── README.md
```

## Instalação

**1. Clone o repositório:**

```bash
git clone https://github.com/mafpbiaggi/cadastra-visitante.git
cd cadastra-visitante
```

**2. Configure as variáveis de ambiente:**

```bash
cp docker/.env.example docker/.env
```

Edite o arquivo `docker/.env` com os valores do seu ambiente:

```env
# Banco de dados
DB_HOST=
DB_DATABASE=
DB_USER=
DB_PASS=
DB_PORT=

# Caminho absoluto para a raiz do projeto
ROOT_DIR=

# Porta que a aplicação vai expor
PORT_MAPPING=
```

**3. Suba o container:**

```bash
cd docker
docker compose up -d --build
```

**4. Instale as dependências:**

```bash
docker exec -it app_cadastra_visitante composer install
```

A aplicação estará disponível em `http://localhost:{PORT_MAPPING}`.

## Uso independente

Se você não possui o sistema externo e deseja executar a aplicação de forma independente,
crie o banco de dados e a tabela `visitantes` com a seguinte estrutura:

```sql
CREATE TABLE visitantes (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    dataVisita       DATE NOT NULL,
    nome             VARCHAR(50) NOT NULL,
    idade            INT NOT NULL,
    email            VARCHAR(255) NOT NULL,
    telefone         VARCHAR(20) NOT NULL,
    frequentaIgreja  VARCHAR(70),
    pedidoOracao     VARCHAR(70),
    origem           VARCHAR(100) NOT NULL,
    outroComp        VARCHAR(50),
    redesSociaisComp VARCHAR(50),
    created          DATETIME NOT NULL,
    modified         DATETIME NOT NULL
);
```

> **Observação:** os campos `user_id` e `church_id` fazem parte do schema do sistema externo e
> foram omitidos neste exemplo.
> Caso opte por removê-los, será necessário também ajustar a query de inserção em `src/Models/VisitanteModel.php`,
> removendo esses campos e seus respectivos valores.

## Dados do Desenvolvedor

**Nome**: Marco Aurélio Biaggi ([@mafpbiaggi](https://github.com/mafpbiaggi)).

