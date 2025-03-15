

## Location Api Routes


  GET|HEAD        api/locations ........................................... locations.index › LocationController@index
  POST            api/locations ........................................... locations.store › LocationController@store
  GET|HEAD        api/locations/{location} .................................. locations.show › LocationController@show
  PUT|PATCH       api/locations/{location} .............................. locations.update › LocationController@update
  DELETE          api/locations/{location} ............................ locations.destroy › LocationController@destroy
  GET|HEAD        api/route/{id1}/{id2} ............................... LocationController@getRouteBetweenTwoLocations






