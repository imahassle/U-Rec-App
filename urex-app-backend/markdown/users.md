### **Users**

**Requires "Administration" user key.**

HTTP Verb | URI                                   | Description
--------- | ------------------------------------- | --------------------------------------------
GET       | api/user                              | Returns all users.
GET       | api/user/category/{***category_id***} | Returns all users within specified category.
GET       | api/user/{***id***}                   | Returns specified user.
POST      | api/user                              | Creates new user.
PUT       | api/user/{***id***}                   | Updates specified user.
PUT       | api/user/{***id***}/password          | Updates specified user's password.
DELETE    | api/user/{***id***}                   | Deletes specified user.

#
**POST api/user inputs**

Input         | Validation Rules
------------- | ----------------
`username`    | 
`password`    |
`first_name`  |
`last_name`   |
`email`       | `email`
`category_id` |

#
**PUT api/user/{id} inputs**

Input         | Validation Rules
------------- | ----------------
`username`    | 
`first_name`  |
`last_name`   |
`email`       | `email`
`category_id` |

#
**PUT api/user/{id}/password inputs**

Input          | Validation Rules
-------------- | ----------------
`new_password` |  

Outputs       | Type
------------- | :-------:
`id`          | `integer`
`username`    | `string`
`first_name`  | `string`
`last_name`   | `string`
`email`       | `string`
`category_id` | `integer`
