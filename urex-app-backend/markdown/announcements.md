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
`date`          | `string`  | `mm dd, yyyy hh:mm[am|pm]`
`user_id`       | `integer` |
`category_id`   | `integer` |
