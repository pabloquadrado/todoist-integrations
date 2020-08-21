# Integração com Todoist

## Setup

Para instalação das dependências do projeto:

``` composer install ```

Em seguida, basta configurar o arquivo ``` config.php ``` dentro da pasta ``` src/Core ``` com base no arquivo ``` config.example.php ``` que está na raiz do projeto.

## Automatizações

### Habit tracker
Esta automatização possibilita o controle de recorrência dos hábitos no Todoist. Basta seguir os seguintes passos:

1. Criar um projeto chamado **Habits**.

2. Criar tarefa com **recorrências diárias** dentro desse projeto.

3. Adicionar ``` [day 0] ``` no nome da tarefa.

3. Quando completar a tarefa, o ``` [day 0] ``` irá se tornar ``` [day 1] ```.

4. Se você falhar em completar a tarefa e atrasá-la, o script vai resetar a recorrência mudando de ``` [day X] ``` para ``` [day 0] ```.

Observação: O script necessita ser executado ao final do dia para que a automatização ocorra.