#   API

A RESTful API


## API Endpoints

### Authentication
- `POST /auth/login`
  - Authenticates users and returns a JWT token
  - Required fields: `username`, `password`

### Schedule Management
- `GET /api/schedule`
  - Returns schedule data
- `GET /api/schedule?student={name}`
  - Filters schedule by student name
- `GET /api/schedule?teacher={name}`
  - Filters schedule by teacher name

### Subscription Management
- `GET /api/subscriptions`
  - Returns all subscription data
  - Supports filtering by status, date, etc.

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/cloudsoftwareoff/sab_app_api

   composer install
   ```
2. Start the server:
   ```bash
   php -S localhost:8000 .
   ```
## Example Usage 💻

### Authenticating:

    ```bash
    
    fetch('/auth/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
    username: 'cloudsoftware',
    password: 'admin123'
    })
    })
    .then(response => response.json())
    .then(data => console.log(data.token));
    ```

### Accessing Protected Routes:

    ```bash
    fetch('/api/subscription.php', {
    headers: {
    'Authorization': 'Bearer YOUR_JWT_TOKEN',
    'Content-Type': 'application/json'
    }
    })
    .then(response => response.json())
    .then(data => console.log(data));
    ```

### Sample  
![Schedule Data Example](./shot.png)