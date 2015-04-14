//
//  FacilityViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/9/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

class FacilityViewController: UIViewController {
    
    @IBOutlet var webView: UIWebView!

    override func viewDidLoad() {
        super.viewDidLoad()
        let url = NSURL(string: "http://hannahgamiel.com")
        let request = NSURLRequest(URL: url!)
        webView.loadRequest(request)
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }


}

