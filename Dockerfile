# Use the official Laravel Docker image
FROM laravel:8.3

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get install -y nodejs

# Set working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container
COPY . .

# Install PHP dependencies
RUN composer install

# Install Node.js dependencies and build assets
RUN npm install && npm run build

# Expose port 8000 for the Laravel application
EXPOSE 8000

# Expose port 80 for the Vue.js application
EXPOSE 80

# Start the Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
