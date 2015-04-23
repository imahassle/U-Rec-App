//
//  ParentPageViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/14/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

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
        navigationController?.navigationBar.barTintColor = UIColor(red: 0.718, green: 0.027, blue: 0.141, alpha: 1)
        navigationController?.navigationBar.tintColor = UIColor.whiteColor()
        navigationController?.navigationBar.titleTextAttributes = [NSForegroundColorAttributeName: UIColor.whiteColor()]
    }
    
    func webView(webView: UIWebView, shouldStartLoadWithRequest request: NSURLRequest, navigationType: UIWebViewNavigationType) -> Bool {
        
        var ret : Bool = false
        var newpage : String = request.URL.absoluteString!
        
        var delimitedstring = newpage.componentsSeparatedByString("#")
        newpage = delimitedstring[0]
        
        if (newpage != url && !firstTime) {
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
            
            stopAnimating()
        }
        else if (request.URL.absoluteString?.rangeOfString("#") != nil || request.URL.absoluteString?.rangeOfString("?") != nil || firstTime == true) {
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
