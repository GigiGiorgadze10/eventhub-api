# EventHub API

EventHub API is a Laravel-based application for managing events, attendees, tickets, reviews, and more. This project showcases a wide range of Laravel features, including routes, middleware, command scheduling, API resources, validation, and email notifications.

---

## Features

### Core Functionalities
- Event Management: Create, view, and list events.
- Ticket Booking: Book tickets for events and view existing bookings.
- Attendee Management: Register or remove attendees for events.
- Review System: Add and view reviews for events.
- User Authentication: Register, log in, and manage user accounts.
- Email Notifications: Send notifications and test emails.

### Advanced Laravel Features
- **Artisan Commands**: Custom commands for tasks like sending test emails.
- **Command Scheduling**: Automate recurring tasks.
- **Route Management**: Organized routes with prefixes, groups, and middleware.
- **Validation**: Primitive and complex request validations, including nested arrays and custom messages in Georgian.
- **Database Operations**:
  - Migrations: Define database schema.
  - Models: Eloquent ORM relationships (One-to-One, One-to-Many, Many-to-Many, Polymorphic).
  - Factories and Seeders: Populate the database with test data.
- **Eloquent Features**:
  - Query filtering.
  - Searching models by relationships.
  - Eager loading.
- **API Resources**: Structured responses for API endpoints.
- **Blade Templates**: Basic UI for demonstration purposes.

---

## Installation

### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or any supported database
- Laravel Installer

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/EventHub-API.git
   ```
2. Navigate to the project directory:
   ```bash
   cd EventHub-API
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Copy the `.env` file and set up environment variables:
   ```bash
   cp .env.example .env
   ```
   Configure database and mail settings in `.env`.
5. Generate the application key:
   ```bash
   php artisan key:generate
   ```
6. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
7. Start the development server:
   ```bash
   php artisan serve
   ```
8. Test the application:
   Access the API at `http://localhost:8000`.

---

## Usage

### API Endpoints

#### Public Endpoints
- **Test API**:
  - `GET /test` - Verify API functionality.
- **Event Search**:
  - `GET /events/search` - Search for events.

#### Authentication
- `POST /register` - Register a new user.
- `POST /login` - Log in a user.
- `POST /forgot-password` - Request a password reset link.

#### Events
- `GET /events` - List all events.
- `GET /events/{id}` - View event details.

#### Authenticated Endpoints
- **User Info**:
  - `GET /user` - Get logged-in user details.
- **Attendees**:
  - `POST /events/{event}/attend` - Register as an attendee.
  - `DELETE /events/{event}/attend` - Remove attendee.
- **Tickets**:
  - `POST /events/{event}/tickets` - Book tickets for an event.
  - `GET /events/{event}/tickets` - View tickets for an event.
- **Reviews**:
  - `POST /events/{event}/reviews` - Add a review for an event.
  - `GET /events/{event}/reviews` - View reviews for an event.

#### Custom Artisan Command Endpoint
- **Send Test Email**:
  - `POST /send-test-email` - Send a test email.
  - Request Body: `{ "email": "recipient@example.com" }`

---

## Custom Artisan Commands

### `send:test-email`
- Command: `php artisan send:test-email {email}`
- Sends a test email to the specified address.

---

## Testing

Use tools like Postman or cURL to test API endpoints. Ensure you provide the required authentication tokens for protected routes.

---

## Folder Structure

- **`app/`**: Application logic (controllers, models, commands).
- **`routes/`**: API route definitions.
- **`database/`**:
  - `migrations/`: Database schema definitions.
  - `seeders/`: Populate test data.
  - `factories/`: Generate model instances for testing.
- **`resources/views/`**: Blade templates.

---

## Key Technologies
- Laravel 10
- Sanctum for API authentication
- MySQL
- Mailtrap for email testing
