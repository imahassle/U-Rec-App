//
//  ClimbingWallViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/14/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

class ClimbingWallViewController: ParentPageViewController, UIWebViewDelegate {
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if(firstTime) {
            println("First time viewing CLIMBING WALL viewcontroller!")
            if(url == "") {
                self.navigationBar.title = "CLIMBING WALL"
                url = "http://localhost:8888/urec/Mobile/climbingwall/index.html"
                isRoot = true
            }
            else {
                println(url);
            }
        }
        
        setInitialWebView()
        setStyle()
        
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
}