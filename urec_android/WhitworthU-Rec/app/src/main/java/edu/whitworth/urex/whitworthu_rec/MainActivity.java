package edu.whitworth.urex.whitworthu_rec;

import android.app.Activity;
import android.content.Intent;
import android.net.Uri;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.content.Context;
import android.os.Build;
import android.os.Bundle;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.support.v4.widget.DrawerLayout;
import android.widget.ArrayAdapter;
import android.widget.TextView;
import android.webkit.WebView;
import android.webkit.WebSettings;
import android.webkit.WebViewClient;
import android.view.KeyEvent;



public class MainActivity extends ActionBarActivity
        implements NavigationDrawerFragment.NavigationDrawerCallbacks {

    /**
     * Fragment managing the behaviors, interactions and presentation of the navigation drawer.
     */
    private NavigationDrawerFragment mNavigationDrawerFragment;
    public boolean backKeyPressed = false;

    /**
     * Used to store the last screen title. For use in {@link #restoreActionBar()}.
     */
    private CharSequence mTitle;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        mNavigationDrawerFragment = (NavigationDrawerFragment)
                getSupportFragmentManager().findFragmentById(R.id.navigation_drawer);
        mTitle = getTitle();

        // Set up the drawer.
        mNavigationDrawerFragment.setUp(
                R.id.navigation_drawer,
                (DrawerLayout) findViewById(R.id.drawer_layout));
    }

    @Override
    public void onNavigationDrawerItemSelected(int position) {
        // update the main content by replacing fragments
        FragmentManager fragmentManager = getSupportFragmentManager();
        switch(position) {
            case 0:
                URecFragment UFragment = new URecFragment();
                fragmentManager.beginTransaction()
                        .replace(R.id.container, UFragment.newInstance(position + 1))
                        .commit();
                break;
            case 1:
                OutdoorRecFragment ORFragment = new OutdoorRecFragment();
                fragmentManager.beginTransaction()
                        .replace(R.id.container, ORFragment.newInstance(position + 1))
                        .commit();
                break;
            case 2:
                RentalsFragment RFragment = new RentalsFragment();
                fragmentManager.beginTransaction()
                        .replace(R.id.container, RFragment.newInstance(position + 1))
                        .commit();
                break;
            case 3:
                ClimbingWallFragment CWFragment = new ClimbingWallFragment();
                fragmentManager.beginTransaction()
                        .replace(R.id.container, CWFragment.newInstance(position + 1))
                        .commit();
                break;
            case 4:
                IntramuralsFragment IFragment = new IntramuralsFragment();
                fragmentManager.beginTransaction()
                        .replace(R.id.container, IFragment.newInstance(position + 1))
                        .commit();
                break;
        }

    }

    public void onSectionAttached(int number) {
        switch (number) {
            case 1:
                mTitle = getString(R.string.title_section1);
                break;
            case 2:
                mTitle = getString(R.string.title_section2);
                break;
            case 3:
                mTitle = getString(R.string.title_section3);
                break;
            case 4:
                mTitle = getString(R.string.title_section4);
                break;
            case 5:
                mTitle = getString(R.string.title_section5);
                break;
        }
    }

    public void restoreActionBar() {
        ActionBar actionBar = getSupportActionBar();
        actionBar.setNavigationMode(ActionBar.NAVIGATION_MODE_STANDARD);
        actionBar.setDisplayShowTitleEnabled(true);
        actionBar.setTitle(mTitle);
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        if (!mNavigationDrawerFragment.isDrawerOpen()) {
            // Only show items in the action bar relevant to this screen
            // if the drawer is not showing. Otherwise, let the drawer
            // decide what to show in the action bar.
            getMenuInflater().inflate(R.menu.main, menu);
            restoreActionBar();
            return true;
        }
        return super.onCreateOptionsMenu(menu);
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

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        // Check if the key event was the Back button and if there's history
        if (keyCode == KeyEvent.KEYCODE_BACK) {
            backKeyPressed = true;
            return true;
        } else

            return super.onKeyDown(keyCode, event);

        // If it wasn't the Back key or there's no web page history, bubble up to the default
        // system behavior (probably exit the activity)
        //return super.onKeyDown(keyCode, event);
    }

    /**
     * A placeholder fragment containing a simple view.
     */
    public static class PlaceholderFragment extends Fragment {
        /**
         * The fragment argument representing the section number for this
         * fragment.
         */
        private static final String ARG_SECTION_NUMBER = "section_number";

        /**
         * Returns a new instance of this fragment for the given section
         * number.
         */
        public static PlaceholderFragment newInstance(int sectionNumber) {
            PlaceholderFragment fragment = new PlaceholderFragment();
            Bundle args = new Bundle();
            args.putInt(ARG_SECTION_NUMBER, sectionNumber);
            fragment.setArguments(args);
            return fragment;
        }

        public PlaceholderFragment() {
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            View rootView = inflater.inflate(R.layout.fragment_main, container, false);
            return rootView;
        }

        @Override
        public void onAttach(Activity activity) {
            super.onAttach(activity);
            ((MainActivity) activity).onSectionAttached(
                    getArguments().getInt(ARG_SECTION_NUMBER));
        }
    }

    public static class ClimbingWallFragment extends Fragment {
        private static final String ARG_SECTION_NUMBER = "section_number";

        /**
         * Returns a new instance of this fragment for the given section
         * number.
         */
        public ClimbingWallFragment newInstance(int sectionNumber) {
            ClimbingWallFragment fragment = new ClimbingWallFragment();
            Bundle args = new Bundle();
            args.putInt(ARG_SECTION_NUMBER, sectionNumber);
            fragment.setArguments(args);
            return fragment;
        }

        public ClimbingWallFragment() {
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            View rootView = inflater.inflate(R.layout.climbingwall_fragment_main, container, false);
            WebView myWebView = (WebView) rootView.findViewById(R.id.webview);
            myWebView.loadUrl("http://www.whitworth.edu/Administration/RecreationCenter/ClimbingWall.htm");
            WebSettings webSettings = myWebView.getSettings();
            webSettings.setJavaScriptEnabled(true);
            myWebView.setWebViewClient(new WebViewClient() {
                @Override
                public boolean shouldOverrideUrlLoading(WebView view, String url) {
                    /*if (Uri.parse(url).getHost().equals("www.whitworth.edu")) {
                        // This is my web site, so do not override; let my WebView load the page
                        return false;
                    }*/
                    // Otherwise, the link is not for a page on my site, so launch another Activity that handles URLs
                    Intent myIntent = new Intent(getActivity(), SecondaryLevelActivity.class);
                    myIntent.putExtra("url", url); //Optional parameters
                    getActivity().startActivity(myIntent);
                    return true;
                }
            });
            return rootView;
        }

        @Override
        public void onAttach(Activity activity) {
            super.onAttach(activity);
            ((MainActivity) activity).onSectionAttached(
                    getArguments().getInt(ARG_SECTION_NUMBER));
        }
    }

    public static class IntramuralsFragment extends Fragment {
        private static final String ARG_SECTION_NUMBER = "section_number";

        /**
         * Returns a new instance of this fragment for the given section
         * number.
         */
        public IntramuralsFragment newInstance(int sectionNumber) {
            IntramuralsFragment fragment = new IntramuralsFragment();
            Bundle args = new Bundle();
            args.putInt(ARG_SECTION_NUMBER, sectionNumber);
            fragment.setArguments(args);
            return fragment;
        }

        public IntramuralsFragment() {
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            View rootView = inflater.inflate(R.layout.intramurals_fragment_main, container, false);
            WebView myWebView = (WebView) rootView.findViewById(R.id.webview);
            myWebView.loadUrl("http://www.whitworth.edu/Administration/RecreationCenter/Intramurals.htm");
            WebSettings webSettings = myWebView.getSettings();
            webSettings.setJavaScriptEnabled(true);
            myWebView.setWebViewClient(new WebViewClient() {
                @Override
                public boolean shouldOverrideUrlLoading(WebView view, String url) {
                    /*if (Uri.parse(url).getHost().equals("www.whitworth.edu")) {
                        // This is my web site, so do not override; let my WebView load the page
                        return false;
                    }*/
                    // Otherwise, the link is not for a page on my site, so launch another Activity that handles URLs
                    Intent myIntent = new Intent(getActivity(), SecondaryLevelActivity.class);
                    myIntent.putExtra("url", url); //Optional parameters
                    getActivity().startActivity(myIntent);
                    return true;
                }
            });
            return rootView;
        }

        @Override
        public void onAttach(Activity activity) {
            super.onAttach(activity);
            ((MainActivity) activity).onSectionAttached(
                    getArguments().getInt(ARG_SECTION_NUMBER));
        }
    }

    public static class RentalsFragment extends Fragment {
        private static final String ARG_SECTION_NUMBER = "section_number";

        /**
         * Returns a new instance of this fragment for the given section
         * number.
         */
        public RentalsFragment newInstance(int sectionNumber) {
            RentalsFragment fragment = new RentalsFragment();
            Bundle args = new Bundle();
            args.putInt(ARG_SECTION_NUMBER, sectionNumber);
            fragment.setArguments(args);
            return fragment;
        }

        public RentalsFragment() {
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            View rootView = inflater.inflate(R.layout.rentals_fragment_main, container, false);
            WebView myWebView = (WebView) rootView.findViewById(R.id.webview);
            myWebView.loadUrl("http://www.whitworth.edu/Administration/RecreationCenter/Fitness.htm");
            WebSettings webSettings = myWebView.getSettings();
            webSettings.setJavaScriptEnabled(true);
            myWebView.setWebViewClient(new WebViewClient() {
                @Override
                public boolean shouldOverrideUrlLoading(WebView view, String url) {
                    /*if (Uri.parse(url).getHost().equals("www.whitworth.edu")) {
                        // This is my web site, so do not override; let my WebView load the page
                        return false;
                    }*/
                    // Otherwise, the link is not for a page on my site, so launch another Activity that handles URLs
                    Intent myIntent = new Intent(getActivity(), SecondaryLevelActivity.class);
                    myIntent.putExtra("url", url); //Optional parameters
                    getActivity().startActivity(myIntent);
                    return true;
                }
            });
            return rootView;
        }

        @Override
        public void onAttach(Activity activity) {
            super.onAttach(activity);
            ((MainActivity) activity).onSectionAttached(
                    getArguments().getInt(ARG_SECTION_NUMBER));
        }
    }

    public static class URecFragment extends Fragment {
        private static final String ARG_SECTION_NUMBER = "section_number";

        /**
         * Returns a new instance of this fragment for the given section
         * number.
         */
        public URecFragment newInstance(int sectionNumber) {
            URecFragment fragment = new URecFragment();
            Bundle args = new Bundle();
            args.putInt(ARG_SECTION_NUMBER, sectionNumber);
            fragment.setArguments(args);
            return fragment;
        }

        public URecFragment() {
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            View rootView = inflater.inflate(R.layout.urec_fragment_main, container, false);
            WebView myWebView = (WebView) rootView.findViewById(R.id.webview);
            myWebView.loadUrl("http://www.whitworth.edu/Administration/RecreationCenter/Index.htm");
            WebSettings webSettings = myWebView.getSettings();
            webSettings.setJavaScriptEnabled(true);
            myWebView.setWebViewClient(new WebViewClient() {
                @Override
                public boolean shouldOverrideUrlLoading(WebView view, String url) {
                    /*if (Uri.parse(url).getHost().equals("www.whitworth.edu")) {
                        // This is my web site, so do not override; let my WebView load the page
                        return false;
                    }*/
                    // Otherwise, the link is not for a page on my site, so launch another Activity that handles URLs
                    Intent myIntent = new Intent(getActivity(), SecondaryLevelActivity.class);
                    myIntent.putExtra("url", url); //Optional parameters
                    getActivity().startActivity(myIntent);
                    return true;
                }
            });


            return rootView;
        }



        @Override
        public void onAttach(Activity activity) {
            super.onAttach(activity);
            ((MainActivity) activity).onSectionAttached(
                    getArguments().getInt(ARG_SECTION_NUMBER));
        }
    }

    public static class OutdoorRecFragment extends Fragment {
        private static final String ARG_SECTION_NUMBER = "section_number";

        /**
         * Returns a new instance of this fragment for the given section
         * number.
         */
        public OutdoorRecFragment newInstance(int sectionNumber) {
            OutdoorRecFragment fragment = new OutdoorRecFragment();
            Bundle args = new Bundle();
            args.putInt(ARG_SECTION_NUMBER, sectionNumber);
            fragment.setArguments(args);
            return fragment;
        }

        public OutdoorRecFragment() {
        }

        @Override
        public View onCreateView(LayoutInflater inflater, ViewGroup container,
                                 Bundle savedInstanceState) {
            View rootView = inflater.inflate(R.layout.outdoorrec_fragment_main, container, false);
            WebView myWebView = (WebView) rootView.findViewById(R.id.webview);
            myWebView.loadUrl("http://www.whitworth.edu/Administration/RecreationCenter/Index.htm");
            WebSettings webSettings = myWebView.getSettings();
            webSettings.setJavaScriptEnabled(true);
            myWebView.setWebViewClient(new WebViewClient() {
                @Override
                public boolean shouldOverrideUrlLoading(WebView view, String url) {
                    /*if (Uri.parse(url).getHost().equals("www.whitworth.edu")) {
                        // This is my web site, so do not override; let my WebView load the page
                        return false;
                    }*/
                    // Otherwise, the link is not for a page on my site, so launch another Activity that handles URLs
                    Intent myIntent = new Intent(getActivity(), SecondaryLevelActivity.class);
                    myIntent.putExtra("url", url); //Optional parameters
                    getActivity().startActivity(myIntent);
                    return true;
                }
            });

            return rootView;
        }



        @Override
        public void onAttach(Activity activity) {
            super.onAttach(activity);
            ((MainActivity) activity).onSectionAttached(
                    getArguments().getInt(ARG_SECTION_NUMBER));
        }
    }

    /*private class CustomWebViewClient extends WebViewClient {

        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url) {
            if (Uri.parse(url).getHost().equals("www.whitworth.edu")) {
                // This is my web site, so do not override; let my WebView load the page
                return false;
            }
            // Otherwise, the link is not for a page on my site, so launch another Activity that handles URLs
            Intent myIntent = new Intent(MainActivity.this, SecondaryLevelActivity.class);
            myIntent.putExtra("url", url); //Optional parameters
            MainActivity.this.startActivity(myIntent);

            //startActivity(intent);
            return true;
        }
    }*/
}
