# Konum API Yolları

Bu API, konumları yönetmek ve iki konum arasındaki rotaları almak için çeşitli yollar sunar.

GET|HEAD        api/locations ........................................... locations.index › LocationController@index
POST            api/locations ........................................... locations.store › LocationController@store
GET|HEAD        api/locations/{location} .................................. locations.show › LocationController@show
PUT|PATCH       api/locations/{location} .............................. locations.update › LocationController@update
DELETE          api/locations/{location} ............................ locations.destroy › LocationController@destroy
