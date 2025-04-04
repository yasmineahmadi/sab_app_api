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

    ```
    
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

    ```
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


### contact us
    ```
    contact@cloudsoftware.tn
    ```
MIT License

Copyright (c) 2025 CloudSoftware

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.