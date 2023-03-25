# Fashion E-commerce API
## Requirements
- PHP 8.1
- Symfony 6
- Docker
- Docker-Compose

## Installation
To get started with the API, you need to perform the following steps:

1. Clone the project from the repository:
`git clone https://github.com/Santttal/betoola_test_case.git`
2. Change into the project directory:
`cd betoola_test_case`
3. Build and start the Docker container:
`docker-compose up -d --build`
4. Run the database migrations to create the database schema and load sample data:
`docker-compose exec app bin/console doctrine:migrations:migrate`

## Usage
To use the API, you can perform the following request

### Create/update price for a product
#### Request body for Shoes category:
```json
{
  "product_name": "red shoes",
  "category": "Shoes",
  "price": 400,
  "currency": "EUR",
  "size": "39"
}
```
#### Request body for Jewelry category:
```json
{
  "product_name": "bracelet",
  "category": "Jewelry",
  "price": 1000,
  "currency": "EUR",
  "size": "Small"
}
```
#### Responses:
```json
{
  "success": true
}
```
```json
{
  "errors": {
    "category": "The value you selected is not a valid choice."
  }
}
```
```json
{
  "errors": {
    "product": "Product size not found with name: 319"
  }
}
```

## Database connection
To connect to the MySQL database, use the following credentials:

- Host: 127.0.0.1
- Port: 33306
- Database name: ecommerce
- Username: root
- Password: password
