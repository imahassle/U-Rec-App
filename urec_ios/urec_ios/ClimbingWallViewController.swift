//
//  ClimbingWallViewController.swift
//  urec_ios
//
//  Created by Hannah Gamiel on 4/14/15.
//  Copyright (c) 2015 Hannah Gamiel. All rights reserved.
//

import UIKit

class ClimbingWallViewController: UIViewController, UIWebViewDelegate {
    
    @IBOutlet var webView: UIWebView!
    @IBOutlet var activity: UIActivityIndicatorView!
    @IBOutlet var navigationBar: UINavigationItem!
    var isRoot = false
    var firstTime = true
    var url : String = ""
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        if(firstTime) {
            println("FIRST TIME!")
            if(url == "") {
                self.title = "Climbing Wall"
                url = "http://localhost:8888/urec/Mobile/splash.html"
                isRoot = true
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
        var currURL = url
        var newpage = request.URL.absoluteString!
        
        if let dotRange = newpage.rangeOfString("#") {
            newpage.removeRange(newpage.startIndex..<newpage.endIndex)
        }
        
        if (request.URL.absoluteString?.rangeOfString("#") != nil || request.URL.absoluteString?.rangeOfString("?") != nil || firstTime == true) {
            ret = true
        }
        else if (newpage != url && !firstTime) {
            let newURL : String = (request.URL.absoluteString)!
            println(newURL)
            
            webView.stopLoading()
            
            let newVC = self.storyboard?.instantiateViewControllerWithIdentifier("ClimbingWall") as ClimbingWallViewController
            newVC.url = newURL
            self.navigationController?.pushViewController(newVC, animated: true)
            
            stopAnimating()
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