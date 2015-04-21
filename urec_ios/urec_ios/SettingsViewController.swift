//
//  SettingsViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/20/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit
import CoreData

class SettingsViewController: UIViewController {
    
    @IBOutlet weak var urec_notifications: UISwitch!
    @IBOutlet weak var intramurals_notifications: UISwitch!
    @IBOutlet weak var climbingwall_notifications: UISwitch!
    @IBOutlet weak var outdoorrec_notifications: UISwitch!
    @IBOutlet weak var rentals_notifications: UISwitch!
    let managedObjectContext = (UIApplication.sharedApplication().delegate as AppDelegate).managedObjectContext
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        
        println(managedObjectContext)
        
        if(willInsertFirstRow()) {
            println("Inserting entries...")
            createFirstEntities()
        }
        setUpSwitches()
        
    }
    
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func willInsertFirstRow() -> Bool {
        var willInsert : Bool = false
        
        // Create a new fetch request using the LogItem entity
        let fetchRequest = NSFetchRequest(entityName: "Notifications")
        var error: NSError?
        
        // Execute the fetch request, and cast the results to an array of LogItem objects
        var objects = managedObjectContext?.executeFetchRequest(fetchRequest, error: &error)
        if let results = objects {
            if results.count > 0 {
                willInsert = false
            }
            else {
                willInsert = true
            }
            
        }
        
        return willInsert
    }
    
    func createFirstEntities() {
        let newItem = NSEntityDescription.insertNewObjectForEntityForName("Notifications", inManagedObjectContext: self.managedObjectContext!) as Notifications
        newItem.urec_notifications = 1
        newItem.climbingwall_notifications = 1
        newItem.rentals_notifications = 0
        newItem.outdoorrec_notifications = 1
        newItem.intramurals_notifications = 1
    }
    
    func setUpSwitches() {
        
        var switchTextArray: [String] = ["urec_notifications", "intramurals_notifications", "climbingwall_notifications", "outdoorrec_notifications", "rentals_notificaitons"];
        var switchesArray: [UISwitch] = [urec_notifications, intramurals_notifications, climbingwall_notifications, outdoorrec_notifications, rentals_notifications]
        for theswitch in 0...switchTextArray.count-1 {
            setSwitch(switchesArray[theswitch], text: switchTextArray[theswitch])
        }
    }
    
    func setSwitch(theswitch: UISwitch, text: String) {
        let entityDescription = NSEntityDescription.entityForName("Notifications", inManagedObjectContext: managedObjectContext!)
        
        let request = NSFetchRequest()
        request.entity = entityDescription
        
        let pred = NSPredicate(format: "%@ == NO", text)
        request.predicate = pred
        var error: NSError?
        var objects = managedObjectContext?.executeFetchRequest(request, error: &error)
        if let results = objects {
            if results.count > 0 {
                let match = results[0] as NSManagedObject
                theswitch.setOn(false, animated: false)
            } else {
                println("No Match")
            }
        }
    }

    
}