# 🚀 Checklist de Deploy a Producción

## Pre-Deploy Checklist

### 1. Variables de Entorno (.env)
```bash
# Copiar archivo de entorno
cp .env.example .env

# Configurar variables críticas
APP_NAME="Clínica Salud"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com

# Base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=clinica_produccion
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password_seguro

# Mail (para notificaciones)
MAIL_MAILER=smtp
MAIL_HOST=smtp.tuservidor.com
MAIL_PORT=587
MAIL_USERNAME=noreply@clinicasalud.com
MAIL_PASSWORD=tu_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@clinicasalud.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 2. Generar APP_KEY
```bash
php artisan key:generate
```

### 3. Optimizaciones de Caché
```bash
# Limpiar cachés existentes
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Crear cachés optimizadas
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 4. Base de Datos
```bash
# Ejecutar migraciones
php artisan migrate --force

# Opcional: Seeders para datos iniciales
php artisan db:seed --force
```

### 5. Storage y Permisos
```bash
# Crear enlace simbólico para storage
php artisan storage:link

# Permisos (Linux/Mac)
chmod -R 775 storage bootstrap/cache
chmod -R 775 public/storage
chown -R www-data:www-data storage bootstrap/cache

# Permisos (cPanel/Shared Hosting)
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 6. Filament Específico
```bash
# Actualizar Filament
php artisan filament:upgrade

# Cache de componentes
php artisan filament:cache-components
```

### 7. Optimización de Assets
```bash
# Instalar dependencias de producción
npm ci --production

# Compilar assets optimizados
npm run build
```

### 8. Seguridad
```bash
# Verificar que APP_DEBUG esté en false
# Verificar que APP_ENV sea production
# Configurar HTTPS forzado
# Configurar headers de seguridad en servidor web
```

## Post-Deploy Verificación

### Funcionalidades a Probar
- [ ] Página de inicio carga correctamente
- [ ] Login funciona
- [ ] Panel de administración (Filament) accesible
- [ ] Formularios de citas funcionan
- [ ] Subida de imágenes funciona
- [ ] Envío de emails funciona
- [ ] Mapa de Google se muestra
- [ ] Links de redes sociales funcionan
- [ ] Página de política de privacidad accesible

### Performance
- [ ] Google PageSpeed Insights > 80
- [ ] Imágenes con lazy loading
- [ ] Compresión GZIP habilitada
- [ ] Caché de navegador configurada

### SEO
- [ ] Meta tags presentes
- [ ] Schema.org JSON-LD válido
- [ ] Sitemap.xml generado
- [ ] Robots.txt configurado
- [ ] Favicon visible

### Accesibilidad
- [ ] Contraste de colores adecuado
- [ ] aria-labels presentes
- [ ] Navegación por teclado funciona
- [ ] Skip to content link funciona

## Comandos de Rollback (Emergencia)
```bash
# Restaurar desde backup de base de datos
# Revertir último deploy
git reset --hard HEAD~1

# Limpiar cachés
php artisan cache:clear
php artisan config:clear
```

## Notas Importantes

### Servidor Requerido
- PHP 8.2+
- MySQL 8.0+ o MariaDB 10.6+
- Extensiones PHP: mbstring, xml, ctype, json, tokenizer, openssl, pdo, mysql
- Composer 2.x
- Node.js 18+ (para build)

### Límites Recomendados
- upload_max_filesize: 10M
- post_max_size: 10M
- memory_limit: 256M
- max_execution_time: 60

### Backup Automático
Configurar cron job para backup diario:
```bash
0 2 * * * cd /ruta/proyecto && php artisan backup:run >> /dev/null 2>&1
```
