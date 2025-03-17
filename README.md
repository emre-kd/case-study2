### API Endpoints

- `GET|HEAD` `api/locations` ........................................... `locations.index` › `LocationController@index`
- `POST` `api/locations` ........................................... `locations.store` › `LocationController@store`
- `GET|HEAD` `api/locations/{location}` .................................. `locations.show` › `LocationController@show`
- `PUT|PATCH` `api/locations/{location}` .............................. `locations.update` › `LocationController@update`
- `DELETE` `api/locations/{location}` ............................ `locations.destroy` › `LocationController@destroy`
- `GET|HEAD` `api/route/{id1}` ............................... `route.between.locations` › `LocationController@getRouteBetweenTwoLocationsApi`
- `GET|HEAD` `route/{id1}` ............................... `route.between.locations` › `LocationController@getRouteBetweenTwoLocations`


**Not**: Dakika başına 10 istek sınırı var.
- `'throttle:10,1'`

**Not**: Örnek Routelar

**Görsel Olarak**
- `/route/5?latitude2=50.712776&longitude2=3.00597`

**API**
- `/api/route/5?latitude2=50.712776&longitude2=3.00597`

- `![image](https://github.com/user-attachments/assets/56074d3f-7e32-4e0a-976f-840bf40cbfc6)`
