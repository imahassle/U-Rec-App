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
`file`        | :heavy_minus_sign: | `base64 encoded`
`extension`   | :heavy_minus_sign: |
`category_id` | :heavy_check_mark: | 

#
Output          | Type      | Format
---------       | :-------: | -----------------
`id`            | `integer` | 
`file_location` | `string`  | `(relative path)`
`caption`       | `string`  |
`category_id`   | `integer` |
