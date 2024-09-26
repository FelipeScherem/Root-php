# Guia de Configuração do PHP e Xdebug

## COMO BAIXAR PHP

1. **Baixar PHP**
    - Acesse o site oficial do PHP: [PHP Downloads](https://windows.php.net/download/).
    - Escolha a versão desejada do PHP e faça o download do arquivo `.zip` correspondente à sua arquitetura (x86 ou x64) e tipo (Thread Safe ou Non-Thread Safe).

2. **Adicionar Variáveis de Ambiente**
    - Extraia o conteúdo do arquivo `.zip` para um diretório, por exemplo, `C:\tools\php`.
    - Adicione o diretório `C:\tools\php` às variáveis de ambiente do sistema:
        - Abra o **Painel de Controle**.
        - Vá para **Sistema e Segurança > Sistema > Configurações Avançadas do Sistema**.
        - Clique em **Variáveis de Ambiente**.
        - Na seção **Variáveis de sistema**, encontre e selecione a variável **Path**, depois clique em **Editar**.
        - Adicione um novo valor para o diretório `C:\tools\php` e clique em **OK**.

3. **Adicionar no PHPStorm**
    - Abra o PHPStorm.
    - Vá para `File > Settings` (ou `Ctrl+Alt+S`).
    - Selecione `Languages & Frameworks > PHP`.
    - Em **CLI Interpreter**, clique no ícone de **+** para adicionar um novo interpretador.
    - Selecione **PHP Executable** e navegue até o diretório onde você extraiu o PHP (por exemplo, `C:\tools\php\php.exe`).
    - Clique em **OK** para confirmar a adição.

## COMO INSTALAR XDEBUG

1. **Usar o Xdebug Wizard**
    - Acesse o [Xdebug Wizard](https://xdebug.org/wizard).
    - Copie e cole o conteúdo da saída do comando `php -i` na caixa de texto e clique em **Analyze**.
    - O Wizard fornecerá o link para a versão correta do arquivo `.dll` do Xdebug compatível com a sua versão do PHP.

2. **Lugar da DLL**
    - Baixe o arquivo `.dll` fornecido pelo Wizard.
    - Copie o arquivo `.dll` para o diretório `ext` do PHP, por exemplo, `C:\tools\php\ext`.

3. **Configurar no PHPStorm**
    - Abra o PHPStorm.
    - Vá para `File > Settings` (ou `Ctrl+Alt+S`).
    - Selecione `Languages & Frameworks > PHP > Debug`.
    - Em **Xdebug**, verifique se a porta está configurada (normalmente a porta padrão é 9003).
    - Vá para `Languages & Frameworks > PHP > Servers` e adicione um novo servidor se necessário, configurando a URL e o caminho do servidor local.

4. **Configurar o PHP para usar o Xdebug**
    - Edite o arquivo `php.ini` localizado no diretório onde você extraiu o PHP (por exemplo, `C:\tools\php\php.ini`).
    - Adicione as seguintes linhas ao final do arquivo:

      ```ini
      [xdebug]
      zend_extension = "C:\tools\php\ext\php_xdebug.dll"
      xdebug.mode = debug
      xdebug.start_with_request = yes
      xdebug.client_host = 127.0.0.1
      xdebug.client_port = 9003
      ```

    - Salve o arquivo `php.ini` e reinicie o servidor PHP embutido ou o servidor web para aplicar as alterações.