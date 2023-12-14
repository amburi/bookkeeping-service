# Bookkeeping Service API Documentation

### Transaction Endpoints

- **POST /transactions/deposit**
    - Creates a new deposit transaction.
    - Request body should include: party, counterparty, amount, transaction date and time.

- **POST /transactions/withdrawal**
    - Creates a new withdrawal transaction.
    - Request body should include: party, counterparty, amount, transaction date and time.

- **POST /transactions/buy**
    - Creates a new buy transaction.
    - Request body should include: party, counterparty, asset, amount, transaction date and time.

- **POST /transactions/sell**
    - Creates a new sell transaction.
    - Request body should include: party, counterparty, asset, amount, transaction date and time.

### Account and Balance Endpoints

- **GET /accounts/{accountId}/balance**
    - Retrieves the current balance of the specified account.
    - Path parameter: accountId.

- **GET /accounts/{accountId}/transactions**
    - Retrieves the transaction history for the specified account.
    - Path parameter: accountId.

### Asset Endpoints

- **GET /assets/{assetId}**
    - Retrieves details about a specific asset.
    - Path parameter: assetId.

- **GET /assets/{assetId}/owners**
    - Retrieves a list of current owners for the specified asset.
    - Path parameter: assetId.

### User Endpoints

- **POST /users**
    - Creates a new user account.
    - Request body should include: username, email, password.

- **GET /users/{userId}**
    - Retrieves details about a specific user.
    - Path parameter: userId.

- **PUT /users/{userId}**
    - Updates user account information.
    - Path parameter: userId.
    - Request body should include fields that are allowed to be updated.

### Authentication Endpoints

- **POST /auth/login**
    - Authenticates a user and returns an access token.
    - Request body should include: username, password.

- **POST /auth/logout**
    - Logs out a user and invalidates the access token.

These endpoints are designed to provide a comprehensive set of functionalities for managing transactions, accounts, assets, and user information within the bookkeeping service. It's important to implement proper authentication and authorization mechanisms to secure these endpoints and protect sensitive data. Additionally, consider using appropriate HTTP status codes and response messages to indicate the success or failure of API requests.