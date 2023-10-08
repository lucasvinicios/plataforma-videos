
# Plataforma de Compartilhamento de Vídeos

Este é o repositório principal da plataforma de compartilhamento de vídeos. A plataforma permite aos usuários criar categorias personalizadas, organizando seus vídeos favoritos em categorias específicas. Ela foi projetada com foco na experiência do usuário (UX/UI) e implementada com as melhores práticas de desenvolvimento web usando o framework Laravel.



## Requisitos

- PHP >= 8.1.10
- Laravel => 10.20.0
## Instalação

Instale plataforma-videos com composer

```bash
  composer install
  cd plataforma-videos
  php artisan migrate
```
    
## Documentação da API

Abaixo são demonstradas todas as rotas da API para os dois recursos disponíveis: Videos e Categorias.
Para acessar é necessário fazer o login e recuperar o token disponibilizado logo após a autenticaçao. 

### Login

```http
 POST /api/login
``` 

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `header.email` | `string` | **Obrigatório**|
| `header.password` | `string` | **Obrigatório** |

### Videos

#### Retorna todos os videos

```http
  GET /api/videos
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `authorization` | `string` | **Obrigatório**. O token retornado após o login. |

#### Retorna um vídeo

```http
  GET /api/videos/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |
| `id`      | `string` | **Obrigatório**. O ID do vídeo |

#### Armazena um vídeo

```http
  POST /api/videos
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |

**Corpo da Requisição (JSON)**

```json
{
	"titulo": "Teste Caracteres",
	"descricao": "Teste Caracteres",
	"url": "www.google.com.br",
	"categoria_id": 2
}
```
#### Atualiza um vídeo

```http
  PUT /api/videos/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |
| `id`      | `string` | **Obrigatório**. O ID do video |

**Corpo da Requisição (JSON)**

```json
{
	"titulo": "Teste Caracteres",
	"descricao": "Teste Caracteres",
	"url": "www.google.com.br",
	"categoria_id": 1
}
```

#### Exclui um vídeo

```http
  DELETE /api/videos/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |
| `id`      | `string` | **Obrigatório**. O ID do video |

#### Procura um vídeo pelo titulo

```http
  GET /api/videos/search?titulo={titulo}
```
| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |
| `titulo`      | `string` | **Obrigatório**. O titulo do video. |

#### Mostra a quantidade de vídeos cadastrados

```http
  GET /api/videos/free
```

### Categorias

#### Retorna todos as categorias

```http
  GET /api/categorias
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `authorization` | `string` | **Obrigatório**. O token retornado após o login. |

#### Retorna uma categoria

```http
  GET /api/categoria/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |
| `id`      | `string` | **Obrigatório**. O ID da categoria |

#### Armazena uma categoria

```http
  POST /api/categorias
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |

**Corpo da Requisição (JSON)**

```json
{
	"titulo" : "Cor Teste",
	"cor": "Amarelo"
}
```
#### Atualiza uma categoria

```http
  PUT /api/categorias/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |
| `id`      | `string` | **Obrigatório**. O ID da categoria |

**Corpo da Requisição (JSON)**

```json
{
	"titulo" : "Cor Teste",
	"cor": "Amarelo"
}
```

#### Exclui uma categoria

```http
  DELETE /api/categorias/${id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |
| `id`      | `string` | **Obrigatório**. O ID da categoria |

#### Retorna todos os videos de uma determinada categoria

```http
  GET /api/categorias/${id}/videos
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `authorization`      | `string` | **Obrigatório**. O token retornado após o login. |
| `id`      | `string` | **Obrigatório**. O ID da categoria |


## Autores

- [@lucasvinicios](https://www.github.com/lucasvinicios)

