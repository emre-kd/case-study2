# Location API

This API provides a set of routes for managing locations and finding routes between two locations.

## API Routes

### 1. **Get All Locations**
- **Endpoint:** `GET|HEAD /api/locations`
- **Controller Action:** `LocationController@index`
- **Description:** Retrieves a list of all locations.
- **Response:** A JSON array of location objects.

### 2. **Create a New Location**
- **Endpoint:** `POST /api/locations`
- **Controller Action:** `LocationController@store`
- **Description:** Creates a new location with the provided data.
- **Request Body:**
  ```json
  {
    "name": "Location Name",
    "latitude": "Lat",
    "longitude": "Long",
    "color": "Hex Decimal Color"
  }
