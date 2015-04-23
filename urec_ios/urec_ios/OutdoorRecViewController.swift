//
//  OutdoorRecViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/9/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

class OutdoorRecViewController: ParentPageViewController, UIWebViewDelegate {

    override func viewDidLoad() {
        super.viewDidLoad()
        
        if(firstTime) {
            println("First time viewing OUTDOOR REC viewcontroller!")
            if(url == "") {
                self.navigationBar.title = "OUTDOOR REC"
                url = "http://www.whitworth.edu/Administration/RecreationCenter/OutdoorRec.htm"
                
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
