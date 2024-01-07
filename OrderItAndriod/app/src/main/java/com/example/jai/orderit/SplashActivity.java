package com.example.jai.orderit;

import android.content.Intent;
import android.content.res.Configuration;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.LinearLayout;

import com.example.jai.orderit.utils.SessionManager;

public class SplashActivity extends AppCompatActivity {
    private static int SPLASH_TIME_OUT = 3000;
    final int sdk = android.os.Build.VERSION.SDK_INT;
    SessionManager sessionManager;
    LinearLayout layout;
    Intent i;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);
        sessionManager=new SessionManager(getApplicationContext());

        new Handler().postDelayed(new Runnable() {

            /*
             * Showing splash screen with a timer. This will be useful when you
             * want to show case your app logo / company
             */

            @Override
            public void run() {
                // This method will be executed once the timer is over
                // Start your app main activity
                if(sessionManager.isLoggedIn()){
                    if(sessionManager.isCustomerLoggedIn()){
                        i = new Intent(SplashActivity.this, CustomerActivity.class);
                    }
                    else {
                        i = new Intent(SplashActivity.this, HomeActivity.class);
                    }

                }else
                {
                    i = new Intent(SplashActivity.this, LoginActivity.class);

                }
                startActivity(i);
                finish();
                // close this activity
                finish();
            }
        }, SPLASH_TIME_OUT);

    }

    @Override
    public void onConfigurationChanged(Configuration newConfig) {
        super.onConfigurationChanged(newConfig);
        // Checks the orientation of the screen
        if (newConfig.orientation == Configuration.ORIENTATION_LANDSCAPE) {


            Log.d("Land", "ORIENTATION_LANDSCAPE");

        } else if (newConfig.orientation == Configuration.ORIENTATION_PORTRAIT) {

            Log.d("Port", "ORIENTATION_PORTRAIT");
        }
    }


}
