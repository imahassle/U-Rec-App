### **Item Rentals**

**Item rental pricing parameters follow convention from current [Outdoor Rec Website](http://www.whitworthoutdoors.com/#!rentals/c1sx5).**

X-Authorization?   | HTTP Verb | URI                                           | Description
:----------------: | --------- | --------------------------------------------- | ------------------------------------------------------
:heavy_minus_sign: | GET       | api/item_rental                               | Retrieves all item rentals.
:heavy_minus_sign: | GET       | api/item_rental/{***id***}                    | Retrieves specified item rental.
:heavy_check_mark: | POST      | api/item_rental                               | Creates new item rental.
:heavy_check_mark: | PUT       | api/item_rental/{***id***}                    | Updates specified item rental.
:heavy_check_mark: | DELETE    | api/item_rental/{***id***}                    | Deletes specified item rental.

#
Input               | Validation Rules
------------------- | ----------------
`name`              | 
`faculty_pricing_1` | `number`
`faculty_pricing_2` | `number`
`faculty_pricing_3` | `number`
`faculty_pricing_4` | `number`
`student_pricing_1` | `number`
`student_pricing_2` | `number`
`student_pricing_3` | `number`
`student_pricing_4` | `number`

#
Output              | Type      
------------------- | :-------: 
`id`                | `integer` 
`name`              | `string`  
`faculty_pricing_1` | `string`  
`faculty_pricing_2` | `string`  
`faculty_pricing_3` | `string`  
`faculty_pricing_4` | `string`  
`student_pricing_1` | `string`  
`student_pricing_2` | `string`  
`student_pricing_3` | `string`  
`student_pricing_4` | `string`