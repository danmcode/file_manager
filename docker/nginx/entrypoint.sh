#!/bin/sh

SSL_DIR="/etc/nginx/ssl"
SSL_CERT="${SSL_DIR}/filemanager.crt"
SSL_KEY="${SSL_DIR}/filemanager.key"

echo "Verificando certificados SSL..."

if [ ! -f "$SSL_CERT" ] || [ ! -f "$SSL_KEY" ]; then
    echo "Certificados no encontrados. Generando nuevos certificados SSL..."
    
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
        -keyout "$SSL_KEY" \
        -out "$SSL_CERT" \
        -subj "/C=CO/ST=Bogota/L=Bogota/O=FileManager/OU=Development/CN=filemanager.local" \
        2>/dev/null
    
    chmod 600 "$SSL_KEY"
    chmod 644 "$SSL_CERT"
    
    echo "Certificados SSL generados exitosamente"
else
    echo "Certificados SSL ya existen"
fi

echo "Iniciando Nginx..."
exec nginx -g 'daemon off;'