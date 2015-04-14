package edu.whitworth.urex.whitworthu_rec;

import android.app.Activity;
import android.content.Intent;
import android.net.Uri;
import android.webkit.WebView;
import android.webkit.WebViewClient;

/**
 * Created by laurenpangborn on 4/13/15.
 */
public class CustomWebViewClient extends WebViewClient {

    @Override
    public boolean shouldOverrideUrlLoading(WebView view, String url) {
        if (Uri.parse(url).getHost().equals("www.whitworth.edu")) {
            // This is my web site, so do not override; let my WebView load the page
            return false;
        }
        // Otherwise, the link is not for a page on my site, so launch another Activity that handles URLs
        //Intent myIntent = new Intent(getActivity(), SecondaryLevelActivity.class);
        //myIntent.putExtra("url", url); //Optional parameters
        //getActivity().startActivity(myIntent);

        //startActivity(intent);
        return true;
    }
}
