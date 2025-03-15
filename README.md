# Konum API Yolları

Bu API, konumları yönetmek ve iki konum arasındaki rotaları almak için çeşitli yollar sunar.

## Yollar

### 1. **GET|HEAD `/api/locations`**
   - **Aksiyon:** `LocationController@index`
   - **Açıklama:** Tüm konumların listesini alır.

### 2. **POST `/api/locations`**
   - **Aksiyon:** `LocationController@store`
   - **Açıklama:** Yeni bir konum oluşturur.

### 3. **GET|HEAD `/api/locations/{location}`**
   - **Aksiyon:** `LocationController@show`
   - **Açıklama:** Belirli bir konumun detaylarını ID'si ile alır.

### 4. **PUT|PATCH `/api/locations/{location}`**
   - **Aksiyon:** `LocationController@update`
   - **Açıklama:** Belirli bir konumun bilgilerini ID'si ile günceller.

### 5. **DELETE `/api/locations/{location}`**
   - **Aksiyon:** `LocationController@destroy`
   - **Açıklama:** Belirli bir konumu ID'si ile siler.

### 6. **GET|HEAD `/api/route/{id1}/{id2}`**
   - **Aksiyon:** `LocationController@getRouteBetweenTwoLocations`
   - **Açıklama:** İki konum arasındaki rotayı, her birinin ID'si ile alır.
