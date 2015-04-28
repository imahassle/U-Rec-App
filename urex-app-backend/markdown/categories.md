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