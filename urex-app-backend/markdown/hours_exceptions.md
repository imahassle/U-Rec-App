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