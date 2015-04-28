## **Routes**

### **General Notes**

Sign               | Meaning
:----------------: | -------------------
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
	"code" : code,
    "message" : message
}
```
where `code` is an integer and `message` is a string.

#

Successful responses from a GET request will be one of these two formats (depending on if the request is for a specific resource or a collection):
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
	"message": "<resource> <action>ed successfully."
}
```

#
---

### **Login**

**Note: This POST route returns a resource, not a message.**

HTTP Verb | URI       | Description
--------- | --------- | -----------
POST      | api/login | Retrieves a user's information.

#
Input      | Validation Rules
---------- | ----------------
`username` | 
`password` |

#
Output        | Type      
------------- | :-------: 
`id`          | `integer` 
`username`    | `string`  
`first_name`  | `string`  
`last_name`   | `string`  
`email`       | `string`   
`category_id` | `string`  
`api_key`     | `string`

#
---

### **Announcements**

X-Authorization?   | HTTP Verb | URI                                           | Description
:----------------: | --------- | --------------------------------------------- | ------------------------------------------------------
:heavy_minus_sign: | GET       | api/announcement                              | Retrieves all announcements.
:heavy_minus_sign: | GET       | api/announcement/category/{***category_id***} | Retrieves all announcements within specified category.
:heavy_minus_sign: | GET       | api/announcement/{***id***}                   | Retrieves specified announcement.
:heavy_check_mark: | POST      | api/announcement                              | Creates new announcement.
:heavy_check_mark: | PUT       | api/announcement/{***id***}                   | Updates specified announcement.
:heavy_check_mark: | DELETE    | api/announcement/{***id***}                   | Deletes specified announcement.

#
Input         | Optional?          | Validation Rules
------------- | :----------------: | ----------------
`title`       | :heavy_minus_sign: |
`message`     | :heavy_minus_sign: |
`date`        | :heavy_minus_sign: |
`category_id` | :heavy_check_mark: |

#
Output          | Type      | Format
--------------- | :-------: | ------------
`id`            | `integer` |
`title`         | `string`  |
`message`       | `string`  |
`date`          | `string`  | `mm/dd/yyyy`
`user_id`       | `integer` |
`category_id`   | `integer` |

#
---

### **Categories**

**Requires "Administration" user key.**

HTTP Verb | URI                     | Description
--------- | ----------------------- | ---------------------------
GET       | api/category            | Returns all categories.
GET       | api/category/{***id***} | Returns specified category.
POST      | api/category            | Creates new category.
PUT       | api/category/{***id***} | Updates specified category.
DELETE    | api/category/{***id***} | Deletes specified category.

#
Input  | Validation Rules
------ | ----------------
`name` |

#
Output | Type      
------ | :-------: 
`id`   | `integer`
`name` | `string`

#
---

### **Events**

X-Authorization?   | HTTP Verb | URI                                         | Description
:----------------: | --------- | ------------------------------------------- | -------------------------------------------------
:heavy_minus_sign: | GET       | api/event                                   | Retrieves all events.
:heavy_minus_sign: | GET       | api/event/category/{***category_id***}      | Retrieves all events within specified category.
:heavy_minus_sign: | GET       | api/event/{***id***}                        | Retrieves specified event.
:heavy_minus_sign: | GET       | api/event/{***id***}/image                  | Retrieves images associated with specified event.
:heavy_check_mark: | POST      | api/event                                   | Creates new event.
:heavy_check_mark: | POST      | api/event/{***id***}/image/{***image_id***} | Associates specified image with specified event.
:heavy_check_mark: | PUT       | api/event/{***id***}                        | Updates specified event.
:heavy_check_mark: | DELETE    | api/event/{***id***}                        | Deletes specified event.
:heavy_check_mark: | DELETE    | api/event/{***id***}/image/{***image_id***} | Dissociates specified image from specified event.

#
Input         | Optional?          | Validation Rules
------------- | :----------------: | ----------------
`title`       | :heavy_minus_sign: |
`description` | :heavy_minus_sign: |
`start`       | :heavy_minus_sign: | `datetime`
`end`         | :heavy_minus_sign: | `datetime`
`cost`        | :heavy_minus_sign: | `number`
`spots`       | :heavy_minus_sign: |
`category_id` | :heavy_check_mark: |

#
Output        | Type      | Format
------------- | :-------: | --------------------------
`id`          | `integer` |
`title`       | `string`  |
`description` | `string`  |
`start`       | `string`  | `mm/dd/yyyy hh:mm [AM|PM]`
`end`         | `string`  | `mm/dd/yyyy hh:mm [AM|PM]`
`cost`        | `string`  |
`spots`       | `integer` |
`gear_needed` | `string`  |
`user_id`     | `integer` |
`category_id` | `integer` |

#
---

### **Feedback**

X-Authorization?   | HTTP Verb | URI                     | Description
:----------------: | --------- | ----------------------- | -----------
:heavy_check_mark: | GET       | api/feedback            | Retrieves all feedback.
:heavy_check_mark: | GET       | api/feedback/{***id***} | Retrieves specified feedback.
:x:                | POST      | api/feedback            | Creates new feedback.
:heavy_check_mark: | DELETE    | api/feedback/{***id***} | Deletes specified feedback.

#
Input     | Validation Rules
--------- | ----------------
`message` | 
`email`   | `email`
`date`    | `datetime`

#
Output    | Type      | Format
--------- | :-------: | --------------------------
`id`      | `integer` |
`message` | `string`  |
`email`   | `string`  |
`date`    | `string`  | `mm/dd/yyyy hh:mm [AM|PM]`

#
---

### **Hours**

X-Authorization?   | HTTP Verb | URI                                   | Description
:----------------: | --------- | ------------------------------------- | -----------------------------------------------------------------
:heavy_minus_sign: | GET       | api/hour                              | Retrieves all hour information entries.
:heavy_minus_sign: | GET       | api/hour/category/{***category_id***} | Retrieves all hour information entries within specified category.
:heavy_minus_sign: | GET       | api/hour/{***id***}                   | Retrieves specified hour information entry.
:heavy_check_mark: | POST      | api/hour                              | Creates new hour information entry.
:heavy_check_mark: | PUT       | api/hour/{***id***}                   | Updates specified hour information entry.
:heavy_check_mark: | DELETE    | api/hour/{***id***}                   | Deletes specified hour information entry.

#
Input         | Optional?          | Validation Rules
------------- | :----------------: | ----------------
`open`        | :heavy_minus_sign: | `time`
`close`       | :heavy_minus_sign: | `time`
`day_of_week` | :heavy_minus_sign: | 
`category_id` | :heavy_check_mark: |

#
Output        | Type      | Format
------------- | :-------: | ---------------
`id`          | `integer` |
`open`        | `string`  | `hh:mm [AM|PM]`
`close`       | `string`  | `hh:mm [AM|PM]`
`day_of_week` | `integer` |
`category_id` | `integer` |

#
---

### **Hours Exceptions**

X-Authorization?   | HTTP Verb | URI                                              | Description
:----------------: | --------- | ------------------------------------------------ | ---------------------------------------------------------
:heavy_minus_sign: | GET       | api/hours_exception                              | Retrieves all hours exceptions.
:heavy_minus_sign: | GET       | api/hours_exception/category/{***category_id***} | Retrieves all hours exceptions within specified category.
:heavy_minus_sign: | GET       | api/hours_exception/{***id***}                   | Retrieves specified hours exception.
:heavy_check_mark: | POST      | api/hours_exception                              | Creates new hours exception.
:heavy_check_mark: | PUT       | api/hours_exception/{***id***}                   | Updates specified hours exception.
:heavy_check_mark: | DELETE    | api/hours_exception/{***id***}                   | Deletes specified hours exception.

#
Input         | Optional?          | Validation Rules
------------- | :----------------: | ----------------
`date`        | :heavy_minus_sign: | `date`
`open`        | :heavy_minus_sign: | `time`
`close`       | :heavy_minus_sign: | `time`
`category_id` | :heavy_check_mark: |

#
Output        | Type      | Format
------------- | :-------: | ---------------
`id`          | `integer` |
`date`        | `string`  | `mm/dd/yyyy`
`open`        | `string`  | `hh:mm [AM|PM]`
`close`       | `string`  | `hh:mm [AM|PM]`
`category_id` | `integer` |

#
---

### **Images**

**This API is somewhat tentative. I may have to change it due to the social network requirements.**

X-Authorization?   | HTTP Verb | URI                                    | Description
:----------------: | --------- | -------------------------------------- | -----------------------------------------------
:heavy_check_mark: | GET       | api/image                              | Retrieves all images.
:heavy_check_mark: | GET       | api/image/category/{***category_id***} | Retrieves all images within specified category.
:heavy_check_mark: | GET       | api/image/{***id***}                   | Retrieves specified image.
:heavy_check_mark: | POST      | api/image                              | Creates new image.
:heavy_check_mark: | DELETE    | api/image/{***id***}                   | Deletes specified image.

#
Input         | Optional?          | Validation Rules
------------- | :----------------: | ----------------
`caption`     | :heavy_minus_sign: |
`file`        | :heavy_minus_sign: | `file`
`category_id` | :heavy_check_mark: | 

#
Output          | Type      | Format
---------       | :-------: | -----------------
`id`            | `integer` | 
`file_location` | `string`  | `(relative path)`
`caption`       | `string`  |
`category_id`   | `integer` |

#
---

### **Incentive Programs**

X-Authorization?   | HTTP Verb | URI                                                     | Description
:----------------: | --------- | ------------------------------------------------------- | ----------------------------------------------------
:heavy_minus_sign: | GET       | api/incentive_program                                   | Retrieves all programs.
:heavy_minus_sign: | GET       | api/incentive_program/{***id***}                        | Retrieves specified program.
:heavy_minus_sign: | GET       | api/incentive_program/{***id***}/image                  | Retrieves images associated with specified programs.
:heavy_check_mark: | POST      | api/incentive_program                                   | Creates new program.
:heavy_check_mark: | POST      | api/incentive_program/{***id***}/image/{***image_id***} | Associates specified image with specified program.
:heavy_check_mark: | PUT       | api/incentive_program/{***id***}                        | Updates specified program.
:heavy_check_mark: | DELETE    | api/incentive_program/{***id***}                        | Deletes specified program.
:heavy_check_mark: | DELETE    | api/incentive_program/{***id***}/image/{***image_id***} | Dissociates specified image from specified program.

#
Input         | Validation Rules
------------- | ----------------
`title`       | 
`description` | 

#
Output        | Type      
------------- | :-------:
`id`          | `integer` 
`title`       | `string`
`description` | `string`
`user_id`     | `integer`

#
---

### **Item Rentals**

**Item rental pricing parameters follow convention from current [Outdoor Rec Website](http://www.whitworthoutdoors.com/#!rentals/c1sx5).**

X-Authorization?   | HTTP Verb | URI                                           | Description
:----------------: | --------- | --------------------------------------------- | ------------------------------------------------------
:heavy_minus_sign: | GET       | api/item_rental                               | Retrieves all item rentals.
:heavy_minus_sign: | GET       | api/item_rental/{***id***}                    | Retrieves specified item rental.
:heavy_check_mark: | POST      | api/item_rental                               | Creates new item rental.
:heavy_check_mark: | PUT       | api/item_rental/{***id***}                    | Updates specified item rental.
:heavy_check_mark: | DELETE    | api/item_rental/{***id***}                    | Deletes specified item rental.

#
Input               | Validation Rules
------------------- | ----------------
`name`              | 
`faculty_pricing_1` | `number`
`faculty_pricing_2` | `number`
`faculty_pricing_3` | `number`
`faculty_pricing_4` | `number`
`student_pricing_1` | `number`
`student_pricing_2` | `number`
`student_pricing_3` | `number`
`student_pricing_4` | `number`

#
Output              | Type      
------------------- | :-------: 
`id`                | `integer` 
`name`              | `string`  
`faculty_pricing_1` | `string`  
`faculty_pricing_2` | `string`  
`faculty_pricing_3` | `string`  
`faculty_pricing_4` | `string`  
`student_pricing_1` | `string`  
`student_pricing_2` | `string`  
`student_pricing_3` | `string`  
`student_pricing_4` | `string`  

#
---

### **Users**

**Requires "Administration" user key.**

HTTP Verb | URI                                   | Description
--------- | ------------------------------------- | ---------------------------
GET       | api/user                              | Returns all users.
GET       | api/user/category/{***category_id***} | Returns all users within specified category.
GET       | api/user/{***id***}                   | Returns specified user.
POST      | api/user                              | Creates new user.
PUT       | api/user/{***id***}                   | Updates specified user.
PUT       | api/user/{***id***}/password          | Updates specified user's password.
DELETE    | api/user/{***id***}                   | Deletes specified user.

#
**POST api/user inputs:**

Input         | Validation Rules
------------- | ----------------
`username`    | 
`password`    |
`first_name`  |
`last_name`   |
`email`       | `email`
`category_id` |

#
**PUT api/user/{*id*} inputs:**

Input         | Validation Rules
------------- | ----------------
`username`    | 
`first_name`  |
`last_name`   |
`email`       | `email`
`category_id` |

#
**PUT api/user/{*id*}/password inputs:**

Input          | Validation Rules
-------------- | ----------------
`old_password` | 
`new_password` |

#
Outputs       | Type
------------- | :-------:
`id`          | `integer`
`username`    | `string`
`first_name`  | `string`
`last_name`   | `string`
`email`       | `string`
`category_id` | `integer`

#
---
