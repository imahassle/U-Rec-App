//
//  FacilityViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/9/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

class FacilityViewController: UIViewController, UIWebViewDelegate {
    
    @IBOutlet var webView: UIWebView!
    @IBOutlet var activity: UIActivityIndicatorView!
    @IBOutlet var navigationBar: UINavigationItem!
    //var newVC: FacilityViewController!
    var firstTime = true
    var url : String = ""

    override func viewDidLoad() {
        super.viewDidLoad()
        
        if(firstTime) {
            println("FIRST TIME!")
            if(url == "") {
                self.title = "U-Rec"
                url = "http://localhost:8888/urec/Mobile/splash.html"
            }
            else {
                println(url);
            }
        }
        
        setInitialWebView()

        //navigationController?.pushViewController(newVC, animated: true)
 
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
    
    func webView(webView: UIWebView, shouldStartLoadWithRequest request: NSURLRequest, navigationType: UIWebViewNavigationType) -> Bool {
        
        var ret : Bool = false
        
        if(request.URL.absoluteString?.rangeOfString("#") != nil || firstTime == true) {
            ret = true
        }
        else if (!firstTime) {
            let newURL : String = (request.URL.absoluteString)!
            println(newURL)
            
            webView.stopLoading()
            
            let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("Facility") as FacilityViewController
            
            newVC.title = "Testing"
            newVC.url = newURL
            
            self.navigationController?.pushViewController(newVC, animated: true)
            
            stopAnimating()
            
            firstTime = true
        }
        
        return ret
    }
    
    func webViewDidStartLoad(webView: UIWebView){
        startAnimating()
        if(!firstTime && webView.loading) {
            
            let newURL : String = (webView.request?.URL.absoluteString)!
            println(newURL)
            webView.stopLoading()
            firstTime = true
            
            let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("Facility") as FacilityViewController

            //let newVC = FacilityViewController(nibName: "FacilityViewController", bundle: nil)
            
            newVC.title = "Testing"
            newVC.url = newURL
            
            self.navigationController?.pushViewController(newVC, animated: true)
            
            stopAnimating()
        }
    }
    
    func goBack() {
        navigationController?.popViewControllerAnimated(true);
    }
    
    func webViewDidFinishLoad(webView: UIWebView){
        if(firstTime) {
            firstTime = false
            //navigationController?.pushViewController(newVC, animated: true)
        }
        stopAnimating()
        
    }
    
    func startAnimating(){
        activity.startAnimating()
        activity.hidesWhenStopped = true
    }
    
    func stopAnimating(){
        activity.stopAnimating()
        activity.hidesWhenStopped = true
        
    }
}

