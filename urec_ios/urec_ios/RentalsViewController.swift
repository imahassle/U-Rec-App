//
//  RentalsViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/14/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

class RentalsViewController: ParentPageViewController, UIWebViewDelegate {
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if(firstTime) {
            println("First time viewing RENTALS viewcontroller!")
            if(url == "") {
                self.title = "Rentals"
                url = "http://hannahgamiel.com"
                isRoot = true
            }
            else {
                println(url);
            }
        }
        
        setInitialWebView()
        
        //navigationController?.pushViewController(newVC, animated: true)
        
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
}