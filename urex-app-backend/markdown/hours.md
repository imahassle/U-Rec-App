### **Hours**

X-Authorization?   | HTTP Verb | URI                                        | Description
:----------------: | --------- | ------------------------------------------ | -----------------------------------------------------------------
:heavy_minus_sign: | GET       | api/hour                                   | Retrieves all hour information entries.
:heavy_minus_sign: | GET       | api/hour/category/{***category_id***}      | Retrieves all hour information entries within specified category.
:heavy_minus_sign: | GET       | api/hour/category/{***category_id***}/week | Retrieves all hour information entries within specified category for a week from specified `day`
:heavy_minus_sign: | GET       | api/hour/{***id***}                        | Retrieves specified hour information entry.
:heavy_check_mark: | POST      | api/hour                                   | Creates new hour information entry.
:heavy_check_mark: | PUT       | api/hour/{***id***}                        | Updates specified hour information entry.
:heavy_check_mark: | DELETE    | api/hour/{***id***}                        | Deletes specified hour information entry.

#
Input         | Optional?          | Validation Rules
------------- | :----------------: | ----------------
`open`        | :heavy_minus_sign: | `time`
`close`       | :heavy_minus_sign: | `time`
`closed`      | :heavy_minus_sign: | `boolean`
`day_of_week` | :heavy_minus_sign: | 
`category_id` | :heavy_check_mark: |

#
Output        | Type      | Format
------------- | :-------: | ---------------
`id`          | `integer` |
`open`        | `string`  | `hh:mm[am|pm]`
`close`       | `string`  | `hh:mm[am|pm]`
`day_of_week` | `integer` |
`category_id` | `integer` |

#
**Specific details for `GET api/hour/category/{category_id}/week`**

Input | Validation Rules
----- | ----------------
`day` | `date`

Output will look like:
```javascript
[
    {
        'day': 'Monday',
        'closed': true
    },
    {
        'day': 'Tuesday',
        'times': [
            '12:00am - 12:00pm',
            '01:00pm - 06:00pm'
        ]
    },
    ...
]

Seven days will be given, starting with the date given as `day` for input. *Note that this takes into account any hours exceptions.*
