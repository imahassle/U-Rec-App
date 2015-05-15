//
//  About
//  urec_ios
//
//  Created by Hannah Gamiel on 4/9/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

class AboutViewController: ParentPageViewController, UIWebViewDelegate  {
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if(firstTime) {
            println("First time viewing ABOUT viewcontroller!")
            if(url == "") {
                self.navigationBar.title = "ABOUT"
                url = theHost + "#about"
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

