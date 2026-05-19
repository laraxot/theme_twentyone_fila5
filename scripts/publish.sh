#!/bin/bash

# Colori per l'output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Funzione per stampare messaggi
print_message() {
    echo -e "${YELLOW}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Verifica che siamo nella cartella corretta
if [ ! -f "package.json" ]; then
    print_error "Devi eseguire questo script dalla cartella del tema TwentyOne"
    exit 1
fi

# 1. Installazione dipendenze
print_message "Installazione dipendenze NPM..."
npm install
if [ $? -ne 0 ]; then
    print_error "Errore durante l'installazione delle dipendenze"
    exit 1
fi
print_success "Dipendenze installate con successo"

# 2. Compilazione assets
print_message "Compilazione assets..."
npm run build
if [ $? -ne 0 ]; then
    print_error "Errore durante la compilazione degli assets"
    exit 1
fi
print_success "Assets compilati con successo"

# 3. Copia assets
print_message "Copia assets nella cartella pubblica..."
npm run copy
if [ $? -ne 0 ]; then
    print_error "Errore durante la copia degli assets"
    exit 1
fi
print_success "Assets copiati con successo"

# 4. Pulizia cache Laravel
print_message "Pulizia cache Laravel..."
cd ../..
php artisan cache:clear
php artisan view:clear
php artisan config:clear
if [ $? -ne 0 ]; then
    print_error "Errore durante la pulizia della cache"
    exit 1
fi
print_success "Cache pulita con successo"

print_success "Pubblicazione completata con successo!" 