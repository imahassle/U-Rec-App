### **Feedback**

X-Authorization?   | HTTP Verb | URI                     | Description
:----------------: | --------- | ----------------------- | -----------
:heavy_check_mark: | GET       | api/feedback            | Retrieves all feedback.
:heavy_check_mark: | GET       | api/feedback/{***id***} | Retrieves specified feedback.
:x:                | POST      | api/feedback            | Creates new feedback.
:heavy_check_mark: | DELETE    | api/feedback/{***id***} | Deletes specified feedback.

#
Input     | Validation Rules
--------- | ----------------
`message` | 
`email`   | `email`
`date`    | `datetime`

#
Output    | Type      | Format
--------- | :-------: | --------------------------
`id`      | `integer` |
`message` | `string`  |
`email`   | `string`  |
`date`    | `string`  | `mm/dd/yyyy hh:mm [AM|PM]`