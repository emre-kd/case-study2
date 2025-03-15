# Location API Routes

This API provides routes for managing locations and retrieving routes between two locations.

## Routes

- **GET|HEAD** `api/locations`  
  **Action:** `locations.index` › `LocationController@index`  
  **Description:** Retrieves a list of all locations.

- **POST** `api/locations`  
  **Action:** `locations.store` › `LocationController@store`  
  **Description:** Creates a new location.

- **GET|HEAD** `api/locations/{location}`  
  **Action:** `locations.show` › `LocationController@show`  
  **Description:** Retrieves details of a specific location.

- **PUT|PATCH** `api/locations/{location}`  
  **Action:** `locations.update` › `LocationController@update`  
  **Description:** Updates a specific location.

- **DELETE** `api/locations/{location}`  
  **Action:** `locations.destroy` › `LocationController@destroy`  
  **Description:** Deletes a specific location.

- **GET|HEAD** `api/route/{id1}/{id2}`  
  **Action:** `LocationController@getRouteBetweenTwoLocations`  
  **Description:** Retrieves the route between two locations.
