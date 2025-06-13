# Gestión Interna de Tickets
Sistema de soporte interno basado en Laravel, que permite a los usuarios crear, listar, editar y eliminar tickets.

🚀 Características
	•	CRUD completo de tickets (Asunto, Cuerpo, Estado)
	•	Estados de ticket personalizables (Abierto, En progreso, Cerrado)
	•	Autenticación con Laravel Breeze
	•	Validación de formularios (frontend y backend)
	•	Eliminación de tickets mediante AJAX y confirmación con SweetAlert2
	•	Arquitectura limpia y buenas prácticas con Laravel 11

 🛠 Requisitos
	•	PHP >= 8.2
	•	Laravel 11
	•	MySQL / MariaDB
	•	Node.js y npm
	•	Composer

 ⚙️ Instalación

  git clone https://github.com/...
  
  # Instala dependencias PHP
  composer install
  
  # Instala dependencias JS
  npm install && npm run build
  
  # Copia archivo .env
  cp .env.example .env
  
  # Configura conexión a la base de datos en .env
  # Luego ejecuta:
  php artisan key:generate
  php artisan migrate --seed (esto te genera automáticamente los estados del ticket)

🧪 Usuarios de prueba (opcional)

Puedes crear usuarios manualmente o configurar seeding para cuentas de prueba.
