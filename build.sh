#!/bin/bash

echo "Ejecutando composer install..."
composer install
if [ $? -ne 0 ]; then
  echo "Error en composer install. Saliendo."
  exit 1
fi

echo "Ejecutando npm install..."
npm install
if [ $? -ne 0 ]; then
  echo "Error en npm install. Saliendo."
  exit 1
fi

echo "Ejecutando npm run build..."
npm run build
if [ $? -ne 0 ]; then
  echo "Error en npm run build. Saliendo."
  exit 1
fi

echo "Ejecutando php artisan migrate --force..."
php artisan migrate --force
if [ $? -ne 0 ]; then
  echo "Error en php artisan migrate. Saliendo."
  exit 1
fi

echo "Ejecutando php artisan optimize..."
php artisan optimize
if [ $? -ne 0 ]; then
  echo "Error en php artisan optimize. Saliendo."
  exit 1
fi

echo "Cambiando permisos en storage..."
chmod -R 775 storage/
if [ $? -ne 0 ]; then
  echo "Error al cambiar permisos en storage. Saliendo."
  exit 1
fi

echo "Cambiando permisos en bootstrap/cache..."
chmod -R 775 bootstrap/cache
if [ $? -ne 0 ]; then
  echo "Error al cambiar permisos en bootstrap/cache. Saliendo."
  exit 1
fi

echo "Ejecutando php artisan storage:link..."
php artisan storage:link
if [ $? -ne 0 ]; then
  echo "Error en php artisan storage:link. Saliendo."
  exit 1
fi

echo "Proceso de construcción completado."