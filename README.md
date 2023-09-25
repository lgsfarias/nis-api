<p align="center">
  <a href="https://github.com/lgsfarias/nis-api">
    <img src="https://www.gesuas.com.br/wp-content/themes/gesuas/img/logo-gesuas.png" alt="readme-logo" height="80">
  </a>

  <h3 align="center">
    NIS API
  </h3>
  <p align="center">
    Sistema de cadastro NIS
    <br />
    <a href="https://github.com/lgsfarias/nis-api"><strong>Explore a documentação »</strong></a>
    <br />
</p>

## 🎯 Objetivo

Este projeto foi desenvolvido como desafio técnico para a vaga de Desenvolvedor Back End na empresa [GESUAS](https://www.gesuas.com.br/) e tem como objetivo criar um sistema de cadastro e gerenciamento de NIS.

<br/>

## ⛏️ Ferramentas utilizadas

![php](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![symfony](https://img.shields.io/badge/symfony-%23000000.svg?style=for-the-badge&logo=symfony&logoColor=white)
![doctrine](https://img.shields.io/badge/doctrine-%23F05033.svg?style=for-the-badge&logo=doctrine&logoColor=white)
![phpunit](https://img.shields.io/badge/phpunit-%23E34F26.svg?style=for-the-badge&logo=phpunit&logoColor=white)
![nextjs](https://img.shields.io/badge/nextjs-%23000000.svg?style=for-the-badge&logo=next.js&logoColor=white)
![typescript](https://img.shields.io/badge/typescript-%23007ACC.svg?style=for-the-badge&logo=typescript&logoColor=white)
![docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)
![mysql](https://img.shields.io/badge/mysql-%2300000F.svg?style=for-the-badge&logo=mysql&logoColor=white)
![phpmyadmin](https://img.shields.io/badge/phpmyadmin-%23000000.svg?style=for-the-badge&logo=phpmyadmin&logoColor=white)

<br/>

## 🏛 Arquitetura & Design

- O projeto segue uma estrutura MVC (Model-View-Controller) providenciada pelo framework Symfony. O padrão MVC permite uma separação clara entre a apresentação, lógica de negócios e acesso a dados, garantindo uma manutenção mais fácil e uma estrutura modular.

- O frontend, desenvolvido em Next.js, consome a API RESTful construída no backend e proporciona uma interface amigável ao usuário para operações CRUD relacionadas ao cadastro de NIS.

- Ambos os módulos, frontend e backend, são encapsulados em containers Docker para garantir um ambiente de execução consistente, independentemente do sistema host.

<br/>

## 🔍 Padrões & Práticas de Desenvolvimento

- **Clean Code**: O código foi escrito de forma clara e concisa, priorizando legibilidade e manutenção. Segui convenções de nomeação e organização para garantir que o código seja autoexplicativo.
- **SOLID Principles**: Durante o desenvolvimento, aderi aos princípios SOLID para garantir um design de software robusto e modular.
- **DRY (Don't Repeat Yourself)**: Evitei repetições desnecessárias no código, reutilizando lógicas comuns e criando funções e componentes reutilizáveis.
- **Test-Driven Development (TDD)**: Adotei o TDD para garantir que todas as funções críticas tenham cobertura de teste e funcionem como esperado.

<br/>

## 📂 Diretórios

```bash
📂 nis-api/
│
├── 📂 nginx/                   # Configurações do Nginx
│   ├── default.conf
│   └── Dockerfile
│
├── 📂 frontend/                # Pasta principal do front-end (Next.js)
│   ├── 📂 .next/
│   ├── 📂 app/
│   ├── 📂 components/
│   ├── 📂 public/
│   ├── 📂 utils/
│   ├── package.json
│   └── ...
│
├── 📂 bin/                     # Diretórios e arquivos do Symfony
├── 📂 config/
├── 📂 public/
├── 📂 src/                     # Pasta principal do back-end (Symfony)
│   ├── 📂 Controller/
│   ├── 📂 Entity/
│   ├── 📂 Repository/
│   ├── 📂 Service/
│   ├── 📂 Util/
│   └── ...
├── 📂 templates/
├── 📂 translations/
├── 📂 tests/
│   ├── 📂 Service/
│   ├── 📂 Util/
│   └── ...
├── docker-compose.yml
├── Dockerfile                  # Para PHP
├── .env
├── .gitignore
├── composer.json
└── README.md
```

## 🚀 Como rodar o projeto

Para rodar este projeto, você precisará ter o [Docker](https://www.docker.com/) e o [Docker Compose](https://docs.docker.com/compose/) instalados em sua máquina.

Clone o repositório

```bash
git clone https://github.com/lgsfarias/nis-api.git
```

Accesse a pasta do projeto

```bash
cd nis-api
```

Preencha o arquivo .env com as variáveis de ambiente conforme o arquivo .env.dist

```bash
cp .env.dist .env
```

Inicie os serviços usando Docker Compose

```bash
docker-compose up -d
```

Na primeira vez que rodar o projeto, instale as dependências do Symfony

```bash
docker exec -it php_container composer install
```

Ainda dentro do container, execute as migrações do Doctrine para criar as tabelas necessárias:

```bash
docker exec -it php_container php bin/console doctrine:migrations:migrate
```

<br/>

## 💻 Acesso a aplicação

- A aplicação frontend e o backend estarão disponíveis em [http://localhost:8080](http://localhost:8080) e [http://localhost:8080/api](http://localhost:8080/api) respectivamente.
- O PhpMyAdmin estará disponível em [http://localhost:8081](http://localhost:8081)

<br/>

## 🧪 Testes de unidades

Para rodar os testes de unidade, execute o comando:

```bash
docker exec -it php_container bin/phpunit
```

<br/>

## 📡 Endpoints

```yml
POST /api/citizen
  - Descrição: Adicionar um cidadão na base de dados.
  - Body: {
    name: "Nome do Cidadão",
  }
  - Resposta de Sucesso (201 Created): {
    nis: "12345678900",
    name: "Nome do Cidadão",
  }
  - Respostas de Erro:
    - 400 Bad Request: {
      message: "Nome é obrigatório",
    }
```

```yml
GET /api/citizen/{nis}
  - Descrição: Retornar os dados de um cidadão com base no NIS fornecido.
  - Sucesso (200 OK): {
    nis: "12345678900",
    name: "Nome do Cidadão",
  }
  - Respostas de Erro:
    - 400 Bad Request: {
      message: "NIS inválido",
    }
    - 404 Not Found: {
      message: "Cidadão não encontrado",
    }
```

```yml
POST /api/validate
  - Descrição: Validar o NIS fornecido.
  - Body: {
    nis: "12345678900"
  }
  - Resposta de Sucesso (200 OK): {
    nis: "12345678900",
    isValid: true ou false,
  }
  - Respostas de Erro:
    - 400 Bad Request: {
      message: "NIS é obrigatório",
    }
```

<br/>

## 📱 Front-end

Junto com este back-end, um front-end simples foi desenvolvido para consumir esta API. Como ele está no mesmo repositório, você pode acessar o código-fonte na pasta /frontend deste projeto. Para visualizar a aplicação em execução, siga as instruções de instalação e inicialização descritas acima.

## 📞 Contact

<div>
  <a href="https://www.linkedin.com/in/lgsfarias" target="_blank"><img src="https://img.shields.io/badge/-LinkedIn-%230077B5?style=for-the-badge&logo=linkedin&logoColor=white" target="_blank"></a>
  <a href = "mailto:lgsfarias.dev@gmail.com"><img src="https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white" target="_blank"></a>
</div>
