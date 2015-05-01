# How to Use

### **General Notes**

Sign               | Meaning
---------------- | -------------------
:heavy_check_mark: | **Yes**
:x:                | **No**
:heavy_minus_sign: | **Does not matter**

#
---

### **Authorization Notes**

If a route is specified to require **X-Authorization**, a header must be attached to the request with the name **X-Authorization** and value of the user's API key (returned from POST api/login). In either jQuery or Backbone (which uses `$.ajax()` behind the scenes), this can be accomplished for all future requests with:

```javascript
$.ajaxSetup(
    headers: { "X-Authorization" : api_key }
);
```

Preferably, `api_key` will be retrieved from a cookie so that client sessions are persistent.

Routes that are specified to require **Administration** user keys will require an `api_key` related to a user within the **Administration** category.

#
---

### **Request Notes**

Unless otherwise specified, for each resource in this document:
 * The **Input** table relates only to **POST** and **PUT** requests.
 * All **Input** parameters are required for both **POST** and **PUT** requests unless otherwise specified.
 * The **Output** table relates only to **GET** requests.
 * Routes that have an optional `category_id` parameter will use the authenticated user's `category_id` if not specified.

Validation Rules: `!!TODO!!`

#
---


### **Response Notes**

**I strongly recommend that we display error and success messages to the user via in-document alerts.**

Error response codes for these requests will be **400**, **401**, **403**, or **500**.

For **401** errors (representing an authentication error), the response will be:
```javascript
{ 
    "error": {
        "code": "GEN_UNAUTHORIZED",
        "http_code": 401,
        "message": "Unauthorized"
    }
}
```

For all other errors, the response will be of this format:
```javascript
{
    "error" : message
}
```
where `error` is a string.

#

Successful responses from:
* GET requests
* POST requests of the form `api/resource`
* PUT requests of the form `api/resource/{id}`  

#
will be one of these two formats (depending on if the request is for a specific resource or a collection):
```javascript
{
    "output_1" : output_1,
    "output_2" : output_2,
    ...
}
```
```javascript
[
    {
        "output_1" : output_1,
        "output_2" : output_2,
        ...
    },
    {
        "output_1" : output_1,
        "output_2" : output_2,
        ...
    },
    ...
]
```

Successful responses from all other request types will be of the format:
```javascript
{
    "success": true
}
```

#
---

### **Resource Route Explanations**
* [Login](markdown/login.md)
* [Announcements](markdown/announcements.md)
* [Categories](markdown/categories.md)
* [Events](markdown/events.md)
* [Feedback](markdown/feedback.md)
* [Hours](markdown/hours.md)
* [Hours Exceptions](markdown/hours_exceptions.md)
* [Images](markdown/images.md)
* [Incentive Programs](markdown/incentive_programs.md)
* [Item Rentals](markdown/item_rentals.md)
* [Users](markdown/users.md)
