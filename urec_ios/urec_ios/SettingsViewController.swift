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
        //self.navigationController?.navigationBar.backItem = "x.png" -- Need Lauren Slicing
        
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
        newItem.urec_notifications = true
        newItem.climbingwall_notifications = true
        newItem.rentals_notifications = true
        newItem.outdoorrec_notifications = true
        newItem.intramurals_notifications = true
    }
    
    func setUpSwitches() {
        
        var switchTextArray: [String] = ["urec_notifications", "intramurals_notifications", "climbingwall_notifications", "outdoorrec_notifications", "rentals_notifications"];
        var switchesArray: [UISwitch] = [urec_notifications, intramurals_notifications, climbingwall_notifications, outdoorrec_notifications, rentals_notifications]
        for theswitch in 0...switchTextArray.count-1 {
            setSwitch(switchesArray[theswitch], text: switchTextArray[theswitch])
        }
    }
    
    func setSwitch(theswitch: UISwitch, text: String) {
        var error: NSError?
        let entityDescription = NSEntityDescription.entityForName("Notifications", inManagedObjectContext: managedObjectContext!)
        let request = NSFetchRequest()
        var myPredicate : String = text + " == NO"
        request.entity = entityDescription
        request.predicate = NSPredicate(format: myPredicate)

        var results = managedObjectContext?.executeFetchRequest(request, error: &error) as? [Notifications]
        if let var objects = results {
            if objects.count > 0 {
                theswitch.setOn(false, animated: false)
            }
        }
    }
    
    @IBAction func switchValueChanged (sender: UISwitch) {
        var error: NSError?
        let entityDescription = NSEntityDescription.entityForName("Notifications", inManagedObjectContext: managedObjectContext!)
        let request = NSFetchRequest()
        var originalstate : String = (sender.on) ? "NO" : "YES"
        var futurestate : String = (sender.on) ? "YES" : "NO"
        var sendertitle = getSenderAsStringForPredicate(sender)

        var myPredicate : String = sendertitle + " = " + originalstate
        request.entity = entityDescription
        request.predicate = NSPredicate(format: myPredicate)
        
        var results = managedObjectContext?.executeFetchRequest(request, error: &error) as? [Notifications]
        if let var objects = results {
            if objects.count > 0 {
                objects[0].setValue(sender.on, forKey: sendertitle)
                println("Switch for \(sendertitle) has been set to \(futurestate).")
            } else {
                println("No Match")
            }
        }
    }
    
    func getSenderAsStringForPredicate (sender: UISwitch) -> String{
        var sendertitle : String = ""
        if(sender == urec_notifications) {
            sendertitle = "urec_notifications"
        }
        else if(sender == intramurals_notifications) {
            sendertitle = "intramurals_notifications"
        }
        else if (sender == climbingwall_notifications) {
            sendertitle = "climbingwall_notifications"
        }
        else if (sender == rentals_notifications) {
            sendertitle = "rentals_notifications"
        }
        else if (sender == outdoorrec_notifications) {
            sendertitle = "outdoorrec_notifications"
        }
        else {
            println("COULD NOT FIND CORRECT SENDER TITLE.")
        }
        return sendertitle
    }
    
    

    
}