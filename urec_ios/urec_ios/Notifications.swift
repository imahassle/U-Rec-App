//
//  Notifications.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/20/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import Foundation
import CoreData

class Notifications: NSManagedObject {

    @NSManaged var urec_notifications: NSNumber
    @NSManaged var outdoorrec_notifications: NSNumber
    @NSManaged var climbingwall_notifications: NSNumber
    @NSManaged var rentals_notifications: NSNumber
    @NSManaged var intramurals_notifications: NSNumber

}
