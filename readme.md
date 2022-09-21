## Estrutura básica para MVC
> Aqui temos uma estrutura de arquivos para o desenvolvimento de uma aplicação Web seguindo o padrão de desenvolvimento de software MVC.
A aplicação se divide em três partes:
- Área pública (acesso para todos que tiverem o endereço);
- Aplicação do usuário (acesso restrito ao usuário, autenticação por e-mail e senha);
- Área administrativa do site (somente o(s) administrador(es) do site/sistema acessam, autenticação também é feita por email e senha)
> Os acessos são feitos pelas seguintes uri:
- /
- /sobre
- /app
- /app/lista
- /app/pdf
- /admin
### Módulos externos instalados via Composer
> Não esqueçam de rodar o “composer update” para fazer o download dos arquivos das bibliotecas.
- coffeecode/router (controlador de rotas)
- dompdf/dompdf (criação de arquivos em PDF)
- league/plates (sistema de templates PHP nativo que é rápido, fácil de usar e fácil de estender)