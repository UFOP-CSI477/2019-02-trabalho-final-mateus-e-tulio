# **CSI477-2019-02 - Proposta de Trabalho Final**
## *Grupo: Mateus Martins Pereira & Túlio Silva Jardim*

![alt-text][logo]

--------------

<!-- Descrever um resumo sobre o trabalho. -->

### Resumo

  O objetivo deste documento é apresentar uma proposta para o trabalho a ser desenvolvido na disciplina CSI477 -- Sistemas WEB I. Será abordada uma plataforma web que servirá como meio para prestação e contratação de serviços gerais. A plataforma se chamará **Trampo**.

<!-- Apresentar o tema. -->
### 1. Tema

  O trabalho final tem como tema o desenvolvimento de uma plataforma para contratação e prestação de serviços em diversas áreas, denominada **Trampo**.
  
  A plataforma **Trampo** tem como principal foco serviços de curta duração e sua estrutura será separada entre categorias, entre solicitar ou oferecer um serviço e entre bairros/cidades/estados.

<!-- Descrever e limitar o escopo da aplicação. -->
### 2. Escopo

  Este projeto terá as seguintes funcionalidades:
  
   * Cadastro e gerenciamento de dados pessoais;
   * Prestador poderá anunciar um serviço;
   * Contratante poderá anunciar um serviço;
   * Prestador poderá indicar interesse em atender um serviço anunciado por um contratante;
   * Contratante poderá contratar um serviço anunciado por um prestador;
   * Dar *feedback* como prestador ou contratante sobre determinado serviço.
   * Analisar perfil de outros usuários;

<!-- Apresentar restrições de funcionalidades e de escopo. -->
### 3. Restrições

  Neste trabalho não serão considerados...
  * Um fluxo muito alto de requisições;
  * Meios de comunicação privada, como *chat*, embutidos no sistema (usuários poderão divulgar telefone celular ou e-mail e fazer a comunicação a partir disso);

<!-- Construir alguns protótipos para a aplicação, disponibilizá-los no Github e descrever o que foi considerado. //-->
### 4. Protótipo

  A seguir estão os protótipos para:
  * Listagem de serviços: ![alt-text][servicos]
  * Perfil dos usuários: ![alt-text][perfil]
  * Criação de publicações: ![alt-text][publicacao]
  * Respostas à publicação: ![alt-text][respostas]
  * Avaliação do serviço prestado: ![alt-text][feedback]
  * Cadastro de usuários: ![alt-text][cadastro]
  * Login de usuários: ![alt-text][login]

  ### 5. Configuração do Ambiente

  1. Criar um banco de dados vazio chamado `trampo`
  2. Acessar a pasta Trampo:
      1. Copiar `.env.example` para `.env`
      2. Definir no `.env` as credenciais de acesso ao banco de dados
      3. Executar no terminal/cmd -> `composer install`
      4. Executar no terminal/cmd -> `php artisan key:generate`
      5. Executar no terminal/cmd -> `php artisan migrate`
      5. Para acessar o projeto -> Executar no terminal/cmd -> `php artisan serve`
  
  [publicacao]: https://raw.githubusercontent.com/UFOP-CSI477/2019-02-trabalho-final-mateus-e-tulio/master/Prototypes/publicacao.png "Tela de criação de publicações"
  [servicos]: https://raw.githubusercontent.com/UFOP-CSI477/2019-02-trabalho-final-mateus-e-tulio/master/Prototypes/servicos.png "Tela de listagem de serviços"
  [perfil]: https://raw.githubusercontent.com/UFOP-CSI477/2019-02-trabalho-final-mateus-e-tulio/master/Prototypes/perfil.png "Tela de perfil do usuário"
  [cadastro]: https://raw.githubusercontent.com/UFOP-CSI477/2019-02-trabalho-final-mateus-e-tulio/master/Prototypes/cadastro.png "Tela de cadastro"
  [login]: https://raw.githubusercontent.com/UFOP-CSI477/2019-02-trabalho-final-mateus-e-tulio/master/Prototypes/login.png "Tela de login"
  [respostas]: https://raw.githubusercontent.com/UFOP-CSI477/2019-02-trabalho-final-mateus-e-tulio/master/Prototypes/respostas.png "Tela de publicação e suas respostas"
  [feedback]: https://raw.githubusercontent.com/UFOP-CSI477/2019-02-trabalho-final-mateus-e-tulio/master/Prototypes/feedback.png "Tela de avaliação do prestador"
  [logo]: https://raw.githubusercontent.com/UFOP-CSI477/2019-02-trabalho-final-mateus-e-tulio/master/Prototypes/logo.png "Logotipo da marca Trampo"