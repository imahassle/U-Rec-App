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
    
    override func viewDidLoad() {
        super.viewDidLoad()
        //let managedObjectContext = (UIApplication.sharedApplication().delegate as! AppDelegate).managedObjectContext
        
    }
    
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    
}