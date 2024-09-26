# Passos para Configuração do Container PHP e MySQL

## Descrição

Com objetivo de deixar o processo o mais simples, automatizei alguns processos.  
Basta seguir os comandos abaixo para ter seu container rodando 


1. **Construa a imagem Docker**
    ```powershell
    docker build -t meu-container-php-mysql .
    ```

2. **Inicie o contêiner**
    ```powershell
    docker run -d --name meu-container-php-mysql -p 3306:3306 -p 8000:8000 meu-container-php-mysql
    ```

3. **Copie o script SQL para o contêiner**
    ```powershell
    docker cp script.sql meu-container-php-mysql:/tmp/script.sql
    ```

4. **Entre no MySQL**

   Primeiro, entre no contêiner em modo interativo:
    ```bash
    docker exec -it meu-container-php-mysql bash
    ```

5. **Acesse o MySQL**

   Dentro do contêiner, acesse o MySQL com o seguinte comando:
    ```bash
    mysql -uroot -proot
    ```
   
6. **Execute Comandos SQL**

   Agora você pode executar os comandos SQL no prompt do MySQL. Alguns exemplos:

   - **Selecione o banco de dados `loja404`:**
     ```sql
     USE loja404;
     ```

   - **Liste as tabelas no banco de dados:**
     ```sql
     SHOW TABLES;
     ```

   - **Veja dados da tabela `tb_categoria_produto`:**
     ```sql
     SELECT * FROM tb_categoria_produto;
     ```

   - **Veja dados da tabela `tb_produto`:**
     ```sql
     SELECT * FROM tb_produto;
     ```