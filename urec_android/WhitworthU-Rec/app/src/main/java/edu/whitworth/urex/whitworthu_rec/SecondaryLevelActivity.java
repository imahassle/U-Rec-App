package edu.whitworth.urex.whitworthu_rec;

import android.content.Intent;
import android.support.v7.app.ActionBar;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;


public class SecondaryLevelActivity extends ActionBarActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Intent intent = getIntent();
        String url = intent.getStringExtra("url");
        setContentView(R.layout.activity_secondary_level);
        WebView SecondaryWebView = (WebView) findViewById(R.id.webview);
        SecondaryWebView.loadUrl(url);
        WebSettings webSettings = SecondaryWebView.getSettings();
        webSettings.setJavaScriptEnabled(true);
        SecondaryWebView.setWebViewClient(new WebViewClient());

        ActionBar actionBar = getSupportActionBar();
        //actionBar.setDisplayShowTitleEnabled(true);
        actionBar.setHomeButtonEnabled(true);

        SecondaryWebView.setWebViewClient(new WebViewClient() {
            @Override
            public void onPageFinished(WebView view, String url) {
                SecondaryLevelActivity.this.setTitle(view.getTitle());
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_secondary_level, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        switch (item.getItemId()) {
            case R.id.preferences:
                // Launch settings activity
                Intent i = new Intent(this, SettingsActivity.class);
                startActivity(i);
                break;
            // more code...
        }

        return super.onOptionsItemSelected(item);
    }
}
