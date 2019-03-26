---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#User management

APIs for managing users
<!-- START_12e37982cc5398c7100e59625ebb5514 -->
## Create a new user

Make an empty POST request to register a new user.
The endpoint returns an `api_token` that you should store on the client.
The `api_token` **cannot** be displayed in plain text again.

> Example request:

```bash
curl -X POST "http://localhost/api/users" 
```

```javascript
const url = new URL("http://localhost/api/users");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "meta": {
        "api_token": "q6gi1gCeDA7nc4gTHs1LUuBPTgjuYXy8X8Zze33QFxCAGthQ7ebhApluudhr"
    },
    "data": {
        "id": "b395592d-26f1-4da4-af8b-51ea294d0128",
        "created_at": "2019-03-11T21:21:26+00:00"
    }
}
```

### HTTP Request
`POST api/users`


<!-- END_12e37982cc5398c7100e59625ebb5514 -->

<!-- START_3ca88e6b55f726e5ed4bec5eca15f0b8 -->
## Display the authenticated user resource.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/users/self" 
```

```javascript
const url = new URL("http://localhost/api/users/self");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": {
        "id": "b395592d-26f1-4da4-af8b-51ea294d0128",
        "created_at": "2019-03-11T21:21:26+00:00"
    }
}
```

### HTTP Request
`GET api/users/self`


<!-- END_3ca88e6b55f726e5ed4bec5eca15f0b8 -->

<!-- START_8653614346cb0e3d444d164579a0a0a2 -->
## Display the specified user resource.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET -G "http://localhost/api/users/{user}" 
```

```javascript
const url = new URL("http://localhost/api/users/{user}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "data": {
        "id": "b395592d-26f1-4da4-af8b-51ea294d0128",
        "created_at": "2019-03-11T21:21:26+00:00"
    }
}
```

### HTTP Request
`GET api/users/{user}`


<!-- END_8653614346cb0e3d444d164579a0a0a2 -->

<!-- START_d2db7a9fe3abd141d5adbc367a88e969 -->
## Remove the specified user from storage.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE "http://localhost/api/users/{user}" 
```

```javascript
const url = new URL("http://localhost/api/users/{user}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


### HTTP Request
`DELETE api/users/{user}`


<!-- END_d2db7a9fe3abd141d5adbc367a88e969 -->


