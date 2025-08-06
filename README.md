
# Teste prático ZAMIX

---

## 🚀 Primeiros Passos

### 1. Clonar o repositório
```bash
git clone https://github.com/Brunoduraess/teste-pratico-zamix
cd /teste-pratico-zamix
```

### 2. Instalar dependências
```bash
composer install
```

### 3. Criar o arquivo `.env`
```bash
cp .env.example .env
php artisan key:generate
```

Configure as variáveis de ambiente do banco de dados no `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

---

## 🛠️ Criando o banco de dados

Você tem **duas opções** para criar o banco de dados:

### 🔹 Opção 1: Usando as migrations do Laravel
```bash
php artisan migrate
```

### 🔹 Opção 2: Usando o script SQL direto
Execute o script disponível em:
```
database/create/tabelas.sql
```
---

## 👤 Criando um usuário administrador

Você pode criar um usuário manualmente com o seguinte script SQL:
```
database/create/usuario.sql
```

Ou executar o **seeder**:
```bash
php artisan db:seed --class=UsersTableSeeder
```

```
Por padrão, a senha para novos usuários 1234
---

---

## 📊 Relatórios e consultas SQL

Os scripts SQL usados nos relatórios estão disponíveis em:
```
database/selects/
```
---

## 🧭 Diagramas da base de dados

Os diagramas do banco de dados estão disponíveis em:
```
database/diagrams/
```
---
