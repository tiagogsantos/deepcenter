<h1 align="center">🚀 DeepCenter — Sistema em Laravel</h1>
<p align="center">Aplicação desenvolvida em Laravel com Sail, contendo CRUD completo, testes automatizados e boas práticas de arquitetura.</p>

---

## 📚 Tecnologias Utilizadas
- PHP 8+
- Laravel
- Laravel Sail (Docker)
- MySQL / SQLite
- Teste Feature 
- Composer
- Docker

---

## ⚙️ Instalação e Configuração

### 🔧 Instalação completa

```bash
git clone https://github.com/tiagogsantos/deepcenter.git
cd deepcenter
composer install
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
