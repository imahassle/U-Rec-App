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