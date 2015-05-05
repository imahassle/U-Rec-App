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
    var isRoot = false
    
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
    
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    func setStyle() {
        navigationController?.navigationBar.tintColor = UIColor.whiteColor()
        navigationController?.navigationBar.titleTextAttributes = [NSForegroundColorAttributeName: UIColor.whiteColor(), NSFontAttributeName: UIFont(name: "Lato-Semibold", size: 20)!]
        navigationItem.leftBarButtonItem?.setTitleTextAttributes([NSFontAttributeName: UIFont(name: "Lato-Regular", size: 20)!], forState: UIControlState.Normal)
        navigationItem.rightBarButtonItem?.setTitleTextAttributes([NSFontAttributeName: UIFont(name: "Lato-Regular", size: 20)!], forState: UIControlState.Normal)
        self.tabBarController?.tabBar.selectedImageTintColor = UIColorFromRGB("B9001E", alpha: 1)
    }
    
    func webView(webView: UIWebView, shouldStartLoadWithRequest request: NSURLRequest, navigationType: UIWebViewNavigationType) -> Bool {
        
        var ret : Bool = false
        var newpage : String = request.URL.absoluteString!
        var secondhalf : String = ""
        
        var delimitedstring = newpage.componentsSeparatedByString("#")
        newpage = delimitedstring[0]
        if(delimitedstring.count > 1) {
            secondhalf = delimitedstring[1]
        }
        if ((newpage != url || (secondhalf != "" && secondhalf != url && secondhalf[secondhalf.startIndex] == "/")) && !firstTime && secondhalf != newpage) {
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
                println("Showng new RENTALS view controller...")
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
                println("Pushing new INTRAMURALS view controller...")
            }
            else if (self.isKindOfClass(ClimbingWallViewController)) {
                let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("ClimbingWall") as ClimbingWallViewController
                newVC.url = newURL
                self.navigationController?.pushViewController(newVC, animated: true)
                println("Pushing new CLIMBING WALL view controller...")
            }
            else {
                let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("Facility") as FacilityViewController
                newVC.url = newURL
                self.navigationController?.pushViewController(newVC, animated: true)
                println("Error finding the view controller needed.")
            }
            
            ret = false
        }
        else if (firstTime == false && secondhalf[secondhalf.startIndex] == "/") {
            webView.stopLoading()
            ret = false
        }
        else if (firstTime == true) {
            ret = true
        }
        else if ((secondhalf != "" && secondhalf[secondhalf.startIndex] != "/") && (request.URL.absoluteString?.rangeOfString("#") != nil || request.URL.absoluteString?.rangeOfString("?") != nil)) {
            ret = true
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
        webView.stopLoading()
        if(firstTime) {
            if(!isRoot) {
                self.title = webView.stringByEvaluatingJavaScriptFromString("document.title")
            }
            firstTime = false
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
