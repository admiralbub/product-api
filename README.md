# Product API

##  Requirements

- Docker
- Docker Compose

## Setup

## 1 Instalation

### Clone the repository

Clone the repository to your local machine:

```bash
git clone https://github.com/admiralbub/product-api.git
cd product-api
```

## 2. Build and start the Docker containers

```bash 
docker-compose up -d --build 
```

## 3. Set up the Laravel environment

Once the containers are running, copy the .env.example file to .env:

```bash
docker-compose exec -u 0 php /bin/sh
cp .env.example .env
```



## 4. Generate the application key

```bash 
docker-compose run artisan key:generate
```

## 5. Set up the database

Run the migrations to set up the database:

```bash 
docker-compose run  artisan migrate --seed
```
## 6. Install Laravel dependencies

Install the necessary dependencies for Laravel using Composer:

```bash 
docker-compose run composer install
```

## 7. Access the application

The application will be available at http://localhost:5000. If you want to run on a different port, modify the docker-compose.yml file accordingly.

## 8. API Endpoints (JSON format for request/response):

POST /products – Create a product (name, price, category, attributes)

**Request Body:**

    {
   
        "name": "Product 1001",
        "price": "199.99",
        "category": "Software",
        "attributes": {
            "license": "single-user",
            "platform": "Test"
        }
    }

GET /products/{id} – Retrieve product details

PATCH /products/{id} – Update product (partial update)

**Request Body:**

    {

        "name": "Product 1001",
        "price": "199.99",
        "category": "Software",
        "attributes": {
            "license": "single-user",
            "platform": "Test"
        }
    }
DELETE /products/{id} – Delete product

GET /products – List products (with filtering by category and price)

## 9. PHP UNIT TEST

```bash 
docker-compose run artisan test
```

