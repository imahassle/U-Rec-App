//
//  ParentPageViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/14/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

func UIColorFromRGB(colorCode: String, alpha: Float = 1.0) -> UIColor {
    var scanner = NSScanner(string:colorCode)
    var color:UInt32 = 0;
    scanner.scanHexInt(&color)
    
    let mask = 0x000000FF
    let r = CGFloat(Float(Int(color >> 16) & mask)/255.0)
    let g = CGFloat(Float(Int(color >> 8) & mask)/255.0)
    let b = CGFloat(Float(Int(color) & mask)/255.0)
    
    return UIColor(red: r, green: g, blue: b, alpha: CGFloat(alpha))
}



class ParentPageViewController: UIViewController, UIWebViewDelegate {
    
    @IBOutlet var webView: UIWebView!
    @IBOutlet var activity: UIActivityIndicatorView!
    @IBOutlet var navigationBar: UINavigationItem!
    @IBOutlet var settingsButton : UINavigationItem!
    var rgb_mainColor : [CGFloat]! /*= [CGFloat(Float(185)/255), CGFloat(Float(0)/255), CGFloat(Float(30)/255), CGFloat(Float(1.0))] */
    var isRoot = false
    var jQuery : Bool = true
    //var theHost : String = "http://localhost:8000/mobile/"
    var theHost : String = "http://104.236.181.119/mobile"
    
    var firstTime = true
    var url : String = ""
    
    override func viewDidLoad() {
        super.viewDidLoad()
    }
    
    func setInitialWebView() {
        let request = NSURLRequest(URL: (NSURL(string: url))!)
        webView.delegate = self
        webView.loadRequest(request)
        webView.scalesPageToFit = true
        webView.frame=self.view.bounds
    }
    
    func runRequest(urlString: String) {
        let request = NSURLRequest(URL: (NSURL(string: urlString))!)
        webView.delegate = self
        webView.loadRequest(request)
        webView.scalesPageToFit = true
        webView.frame=self.view.bounds
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func set_rgb_mainColor(red: Float, green: Float, blue: Float, alpha: Float) {
        rgb_mainColor = [CGFloat(red/255), CGFloat(green/255), CGFloat(blue/255), CGFloat(alpha)]
    }
    
    func setStyle() {
        set_rgb_mainColor(185, green: 0, blue: 30, alpha: 1.0)
        navigationController?.navigationBar.tintColor = UIColor.whiteColor()
        navigationController?.navigationBar.titleTextAttributes = [NSForegroundColorAttributeName: UIColor.whiteColor(), NSFontAttributeName: UIFont(name: "Lato-Semibold", size: 20)!]
        navigationItem.leftBarButtonItem?.setTitleTextAttributes([NSFontAttributeName: UIFont(name: "Lato-Regular", size: 20)!], forState: UIControlState.Normal)
        navigationItem.rightBarButtonItem?.setTitleTextAttributes([NSFontAttributeName: UIFont(name: "Lato-Regular", size: 20)!], forState: UIControlState.Normal)
        self.tabBarController?.tabBar.selectedImageTintColor = UIColor(red: rgb_mainColor[0], green: rgb_mainColor[1], blue: rgb_mainColor[2], alpha: rgb_mainColor[3]) // changes tab bar selection tint
    }
    
    func webView(webView: UIWebView, shouldStartLoadWithRequest request: NSURLRequest, navigationType: UIWebViewNavigationType) -> Bool {
        
        var ret : Bool = true
        var newpage : String = request.URL.absoluteString!
        var secondhalf : String = ""
        var part : String = ""
        var baseURL : String = ""
        var delimitedstring = newpage.componentsSeparatedByString("#")
        var parts = secondhalf.componentsSeparatedByString("/")
        
        newpage = delimitedstring[0]
        if(delimitedstring.count > 1) {
            secondhalf = delimitedstring[1]
            if (parts.count >= 1) {
                part = parts[0]
                baseURL = newpage + "#" + part
            }
        }
        
        if(!firstTime) {
            let newURL : String = (request.URL.absoluteString)!
            println(newURL)
            
            webView.stopLoading()
            
            if(self.isKindOfClass(FacilityViewController)) {
                let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("Facility") as FacilityViewController
                newVC.url = newURL
                self.navigationController?.pushViewController(newVC, animated: true)
                println("Showing new FACILITY view controller...")
            }
            else if (self.isKindOfClass(RentalsViewController)) {
                let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("Rentals") as RentalsViewController
                newVC.url = newURL
                self.navigationController?.pushViewController(newVC, animated: true)
                println("Shownig new RENTALS view controller...")
            }
            else if (self.isKindOfClass(OutdoorRecViewController)) {
                let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("OutdoorRec") as OutdoorRecViewController
                newVC.url = newURL
                self.navigationController?.pushViewController(newVC, animated: true)
                println("Showing new OUTDOOR REC view controller...")
            }
            else if (self.isKindOfClass(IntramuralsViewController)) {
                let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("Intramurals") as IntramuralsViewController
                newVC.url = newURL
                self.navigationController?.pushViewController(newVC, animated: true)
                println("Showing new INTRAMURALS view controller...")
            }
            else if (self.isKindOfClass(ClimbingWallViewController)) {
                let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("ClimbingWall") as ClimbingWallViewController
                newVC.url = newURL
                self.navigationController?.pushViewController(newVC, animated: true)
                println("Showing new CLIMBING WALL view controller...")
            }
            else {
                let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("Facility") as FacilityViewController
                newVC.url = newURL
                self.navigationController?.pushViewController(newVC, animated: true)
                println("Error finding the view controller needed.")
            }
            
            // reload current page to be page we left from -- hack to defeat backbone's origin
            if(part != "") {
                firstTime = true
                runRequest(baseURL)
            }
            
            ret = false
        }

        return ret
    }
    
    func webViewDidStartLoad(webView: UIWebView) {
        startAnimating()
    }
    
    
    func goBack() {
        navigationController?.popViewControllerAnimated(true);
    }
    
    func webViewDidFinishLoad(webView: UIWebView){
        
        if(firstTime) {
            if(!isRoot) {
                self.title = webView.stringByEvaluatingJavaScriptFromString("document.title")
            }
            firstTime = false
        }
        else {
            webView.stopLoading()
        }
        stopAnimating()
    }
    
    func startAnimating(){
        activity.hidden = false
        activity.startAnimating()
    }
    
    func stopAnimating(){
        activity.stopAnimating()
    }
}
