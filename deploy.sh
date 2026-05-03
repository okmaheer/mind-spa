#!/bin/bash
set -e

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

echo -e "${GREEN}Starting Laravel deployment...${NC}"

# Set deployment path (change if needed)
DEPLOY_PATH="/home/mahefcuw/cbt.ieltsprepandpractice.com"
cd $DEPLOY_PATH

# Enter maintenance mode
echo -e "${YELLOW}Entering maintenance mode...${NC}"
php artisan down --message 'The app is being updated. Please try again in a minute.' || true

# Update codebase
echo -e "${GREEN}Pulling latest code from GitHub...${NC}"
git fetch origin main
git checkout main
git reset --hard origin/main
git pull origin main

# Install Composer dependencies
echo -e "${GREEN}Installing Composer dependencies...${NC}"
/opt/cpanel/composer/bin/composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Clear and optimize Laravel caches
echo -e "${GREEN}Clearing caches...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run database migrations
echo -e "${GREEN}Running database migrations...${NC}"
php artisan migrate --force

# Optimize for production
echo -e "${GREEN}Optimizing for production...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
echo -e "${GREEN}Setting permissions...${NC}"
chmod -R 755 $DEPLOY_PATH/storage
chmod -R 755 $DEPLOY_PATH/bootstrap/cache

# Exit maintenance mode
echo -e "${GREEN}Exiting maintenance mode...${NC}"
php artisan up

echo -e "${GREEN}Deployment completed!${NC}"