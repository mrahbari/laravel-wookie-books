
### Objective
I just wanted to cover a sample of the code I did in 3-4 hours as a sample.
It's a REST API using PHP and Laravel 8.x

### Tasks

-   Implement assignment using:
    -   Language: **PHP**
    -   Framework: **Laravel**
-   Implement a REST API returning JSON or XML based on the `Content-Type` header
-   Implement a custom user model with a "author pseudonym" field
-   Implement a book model. Each book should have a title, description, author (your custom user model), cover image and price
    -   Choose the data type for each field that makes the most sense
-   Provide an endpoint to authenticate with the API using username, password and return a JWT
-   Implement REST endpoints for the `/books` resource
    -   No authentication required
    -   Allows only GET (List/Detail) operations
    -   Make the List resource searchable with query parameters
-   Provide REST resources for the authenticated user
    -   Implement the typical CRUD operations for this resource
    -   Implement an endpoint to unpublish a book (DELETE)
-   Implement API tests for all endpoints

### Evaluation Criteria

-   **PHP** best practices
-   If you are using a framework make sure best practices are followed for models, configuration and tests
-   Write API tests for all implemented endpoints
-   Make sure that users may only unpublish their own books
-   Bonus: Make sure the user _Darth Vader_ is unable to publish his work on Wookie Books
