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