### **Events**

X-Authorization?   | HTTP Verb | URI                                         | Description
:----------------: | --------- | ------------------------------------------- | -------------------------------------------------
:heavy_minus_sign: | GET       | api/event                                   | Retrieves all events.
:heavy_minus_sign: | GET       | api/event/category/{***category_id***}      | Retrieves all events within specified category.
:heavy_minus_sign: | GET       | api/event/{***id***}                        | Retrieves specified event.
:heavy_check_mark: | POST      | api/event                                   | Creates new event.
:heavy_check_mark: | PUT       | api/event/{***id***}                        | Updates specified event.
:heavy_check_mark: | DELETE    | api/event/{***id***}                        | Deletes specified event.

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
------------- | :----------------: | --------------------------
`id`          | `integer`          |
`title`       | `string`           |
`description` | `string`           |
`start`       | `string`           | `mm dd, yyyy hh:mm[am|pm]`
`end`         | `string`           | `mm dd, yyyy hh:mm[am|pm]`
`cost`        | `string`           |
`spots`       | `integer`          |
`gear_needed` | `string`           |
`user_id`     | `integer`          |
`category_id` | `integer`          |
`image`       | `string` or `null` | `(url of image location)`
