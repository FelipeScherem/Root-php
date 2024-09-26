# Root404

## Descrição

**Root404** é um CRUD desenvolvido para estudo do PHP e suas tecnologias.
Seu nome root é para ser uma brincadeira com "raiz não encontrada" assim como meu conhecimento inicial em PHP.  
Este projeto visa ser parte do meu portifolio para atrair recrutadores.


## Funcionalidade

- **Funcionalidade**: Criar, autenticar e gerenciar usuarios, categorias, produtos.

## Tecnologias Usadas

O projeto foi desenvolvido utilizando as seguintes tecnologias:

- [PHP 8.3](https://www.php.net/) - Linguagem de programação
- [MySQL](https://www.mysql.com/) - Sistema de gerenciamento de banco de dados
- [Laravel Eloquent](https://laravel.com/docs/11.x/eloquent) - ORM do Laravel para interações com o banco de dados
- [Swagger](https://swagger.io/) - Documentação da API

## Instalação

Para instalar e configurar o projeto localmente, siga os passos abaixo:

1. Clone o repositório:
   ```bash
   git clone https://github.com/FelipeScherem/Root404-php
   ```

2. Navegue até o diretório do projeto:
   ```bash
   cd projeto-root
   ```

3. Instale as dependências do Composer:
   ```bash
   composer install
   ```
4. **Configuração do Docker**

   As instruções para configurar o projeto utilizando Docker podem ser encontradas no arquivo `README.md` localizado no diretório `project-root/Dockerfile`.

   

5. Inicie o servidor:
   ```bash
   php -S localhost:8080 -t public
   ```

# Uso

## Rotas da API
Até a documentação do swagger estar pronta, estarei comentando e disponibilizando informações por aqui.

### Produtos

- **Cria um novo produto.**
   - **Método:** `POST`
   - **URL:** `localhost:8080/produtos`

- **Atualiza um produto existente.**
   - **Método:** `PUT`
   - **URL:** `localhost:8080/produtos`

- **Lista todos os produtos.**
   - **Método:** `GET`
   - **URL:** `localhost:8080/produtos`

- **Busca um produto pelo ID.**
   - **Método:** `GET`
   - **URL:** `localhost:8080/produtos/{id}`
   - **Parâmetro:**
      - `id`: ID do produto (número).

- **Deleta um produto pelo ID.**
   - **Método:** `DELETE`
   - **URL:** `localhost:8080/produtos/{id}`
   - **Parâmetro:**
      - `id`: ID do produto (número).

### Categorias (Comentadas)

- **Cria uma nova categoria.**
   - **Método:** `POST`
   - **URL:** `localhost:8080/categoria`

- **Lista todas as categorias.**
   - **Método:** `GET`
   - **URL:** `localhost:8080/categoria`

- **Atualiza uma categoria existente.**
   - **Método:** `PUT`
   - **URL:** `localhost:8080/categoria`

- **Deleta uma categoria.**
   - **Método:** `DELETE`
   - **URL:** `localhost:8080/categoria`

### Usuários (Comentadas)

- **Cria um novo usuário.**
   - **Método:** `POST`
   - **URL:** `localhost:8080/usuario`

- **Lista todos os usuários.**
   - **Método:** `GET`
   - **URL:** `localhost:8080/usuario`

- **Atualiza um usuário existente.**
   - **Método:** `PUT`
   - **URL:** `localhost:8080/usuario`

- **Deleta um usuário.**
   - **Método:** `DELETE`
   - **URL:** `localhost:8080/usuario`


## Contato

Se você tiver alguma dúvida ou sugestão, sinta-se à vontade para entrar em contato:

- Nome: Felipe Scherem
- Email: felipe.scherem2014@gmail.com
