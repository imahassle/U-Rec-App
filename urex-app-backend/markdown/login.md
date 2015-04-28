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