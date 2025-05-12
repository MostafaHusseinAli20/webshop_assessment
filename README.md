# Project Summary

This document summarizes the work completed for the **RESTful API** project, developed using **Laravel**. The API allows managing **products** with the following functionalities: CRUD operations, authentication with **JWT**, price adjustment algorithm, rate limiting, and comprehensive testing.

## Project Overview

In this project, I developed a **RESTful API** with the following key features:

1. **Product Management**: Implemented CRUD operations (Create, Read, Update, Delete) for managing products.
2. **JWT Authentication**: Added authentication using JWT for secure login and logout functionality.
3. **Price Adjustment Algorithm**: Implemented a dynamic pricing mechanism based on stock quantity.
4. **Rate Limiting**: Applied a rate limit of 10 requests per minute to prevent abuse and ensure fair usage.
5. **Testing**: Fully tested the API endpoints to ensure they work correctly and meet the project requirements.

## Features Implemented

### 1. **Product Management (CRUD)**
   - **Create**: Allows adding new products to the system with details like name, description, price, and stock quantity.
   - **Read**: Retrieves a list of all products or details of a specific product by its ID.
   - **Update**: Allows updating product details (name, description, price, stock quantity).

### 2. **JWT Authentication**
   - **Login**: Users can log in using their email and password, generating a JWT token.
   - **Logout**: Users can log out, invalidating their JWT token.

### 3. **Price Adjustment Algorithm**
   - **Low Stock (less than 5)**: Price increases by 10% to account for limited availability.
   - **High Stock (more than 20)**: Price decreases by 10% to encourage sales.

### 4. **Rate Limiting**
   - Implemented a rate limit of **10 requests per minute** to ensure fair usage and protect the API from abuse.

## API Endpoints Overview

- **POST /api/products**: Add a new product to the system.
- **GET /api/products/{id}**: Get details of a specific product by its ID.
- **PUT /api/products/{id}**: Update an existing product's details.
- **POST /api/auth/login**: Authenticate a user and generate a JWT token.
- **POST /api/auth/logout**: Log out the user and invalidate the JWT token.

## Testing

### Test Coverage

- **Authentication Tests**: 
  - Verifying user login and token generation.
  - Verifying user logout and token invalidation.
  
- **Product Tests**: 
  - Creating, reading, updating, and deleting products.
  - Verifying correct price adjustments based on stock quantity.
  
- **Price Adjustment Algorithm Tests**: 
  - Ensuring the price increases by 10% when stock quantity is below 5.
  - Ensuring the price decreases by 10% when stock quantity exceeds 20.

- **Rate Limiting Tests**: 
  - Ensuring that no more than 10 requests are allowed per minute for each user.

### Tools Used
- **Postman**: For manual testing of all API endpoints.
- **VScode**: For running tests and validating the responses.

### Test Results
- All endpoints are fully functional and respond as expected.
- Price adjustment algorithm works correctly based on stock quantity.
- Rate limiting works as expected, restricting users to 10 requests per minute.

## Conclusion

The API is fully functional and meets all the required specifications. All endpoints have been implemented with the following:
- **Authentication** using JWT.
- **CRUD operations** for managing products.
- **Price adjustment** logic for products based on stock quantity.
- **Rate limiting** to ensure fair usage.

Additionally, **unit tests** were written and executed to verify the correctness of all API endpoints and business logic.

---

## Prerequisites

Before running the application, ensure you have the following installed:

- **PHP** (version 8.x or later)
- **Composer** (dependency manager for PHP)
- **Laravel** (installed via Composer)
- **Database** (MySQL)
- **Node.js and npm** (for frontend if necessary)
- **Postman** (for testing API endpoints)

---

## Setup Steps

1. **Clone the Repository**
   First, clone the repository to your local machine:
   ```bash
   git clone https://github.com/MostafaHusseinAli20/webshop_assessment.git
   cd webshop_assessment
   
2. **Configure Environment**
    ````bash
    cp .env.example .env
    php artisan key:generate

## Api Documentation
[Api Documentation Link](https://documenter.getpostman.com/view/33597755/2sB2jAbTvk)
