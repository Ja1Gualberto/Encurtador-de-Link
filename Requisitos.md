# Requisitos Funcionais

  - Com um URL, sistema tem que gerar um "alias" curto e unico do nome. Esse link deve ser curto o suficiente pra facilitar ser copiado e movimentalo entre aplicacoes.
  - Quando o usuario acessar o link curto, nosso sistema deve redirecionar pro link original.
  - Usuario tem a opcao dee pegar um link costumizado pro seu URL.
  - Os links devem expirar apos um intervalo de tempo(padrao). O usuario deve conseguir especificar o tempo de expiracao.
  
# Requisitos Nao funcionais

  - O sistema tem que ficar disponivel  sempre. Caso o sistema caia o servico comeca a falhar e os redirecionamentos de URLs vao comecar falhar.
  - O redirecionamento deve acontecer em tempo real com o menor tempo de resposta possivel.
  - Os Links encurtados nao devem ser adivinhados(aleatorios).

# Requisitos Adicionais

  - Guardar dados; Exemplo: quantas vezes o redirecionamento aconteceu.
  - Tornar o sistema acessivel por APIs REST 