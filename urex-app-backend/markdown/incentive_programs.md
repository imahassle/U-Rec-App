### **Incentive Programs**

X-Authorization?   | HTTP Verb | URI                                                     | Description
:----------------: | --------- | ------------------------------------------------------- | ----------------------------------------------------
:heavy_minus_sign: | GET       | api/incentive_program                                   | Retrieves all programs.
:heavy_minus_sign: | GET       | api/incentive_program/{***id***}                        | Retrieves specified program.
:heavy_check_mark: | POST      | api/incentive_program                                   | Creates new program.
:heavy_check_mark: | PUT       | api/incentive_program/{***id***}                        | Updates specified program.
:heavy_check_mark: | DELETE    | api/incentive_program/{***id***}                        | Deletes specified program.

#
Input         | Optional?          | Validation Rules
------------- | :----------------: | ----------------
`title`       | :heavy_minus_sign: | 
`description` | :heavy_minus_sign: |
`image`       | :heavy_check_mark: | `see below example`

#
```javascript
{
  ...
  "image": {
    "file" : "data:image..."
    "extension" : "jpg"
  }
}
```
or
```javascript
{
  "image": {}
}
```

#
Output        | Type               | Format
------------- | :----------------: | ------------------------
`id`          | `integer`          |
`title`       | `string`           |
`description` | `string`           |
`user_id`     | `integer`          |
`image`       | `string` or `null` | `(url of image location)`
