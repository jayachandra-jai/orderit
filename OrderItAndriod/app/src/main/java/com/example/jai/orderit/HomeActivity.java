package com.example.jai.orderit;

import android.app.Fragment;
import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.app.ProgressDialog;
import android.os.Bundle;
import android.util.Log;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;
import com.example.jai.orderit.myfragments.tables.ContactFragment;
import com.example.jai.orderit.myfragments.tables.HelpFragment;
import com.example.jai.orderit.myfragments.tables.HomeFragment;
import com.example.jai.orderit.utils.AppController;
import com.example.jai.orderit.utils.SessionManager;
import com.example.jai.orderit.utils.Urls;
import com.example.jai.orderit.utils.Utils;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class HomeActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {
    private ProgressDialog pDialog;
    SessionManager sessionManager;
    TextView tab_name,tab_id;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);


        pDialog = new ProgressDialog(this);
        sessionManager = new SessionManager(HomeActivity.this);


        pDialog.setMessage("Please wait.....");
        pDialog.setCancelable(false);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        loadFragment(new HomeFragment());

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);
        tab_id   = navigationView.getHeaderView(0).findViewById(R.id.table_id);
        tab_name   = navigationView.getHeaderView(0).findViewById(R.id.table_name);
        tab_name.setText(sessionManager.getTableName());
        tab_id.setText("Table Login ID: "+sessionManager.getTableId());
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }



    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_home) {
            loadFragment(new HomeFragment());
        } else if (id == R.id.nav_contact) {
            loadFragment(new ContactFragment());
        } else if (id == R.id.nav_help) {
            loadFragment(new HelpFragment());
        } else if (id == R.id.nav_logout) {
            showpDialog();
            logoutTable();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }


    private void loadFragment(Fragment fragment) {
        // create a FragmentManager
        FragmentManager fm = getFragmentManager();
        // create a FragmentTransaction to begin the transaction and replace the Fragment
        FragmentTransaction fragmentTransaction = fm.beginTransaction();
        // replace the FrameLayout with new Fragment
        fragmentTransaction.replace(R.id.my_fragment, fragment);
        fragmentTransaction.commit(); // save the changes
    }

    private void logoutTable() {

        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        hidepDialog();
                        Log.d("res", response.toString());

                        try {
                            JSONObject jsonresponse = new JSONObject(response);
                            String message = jsonresponse.getString("message");
                            if (!jsonresponse.getBoolean("error")) {

                                sessionManager.logoutUser();
                                Toast.makeText(getApplicationContext(),message,Toast.LENGTH_SHORT).show();
                            }
                            else{
                                Toast.makeText(getApplicationContext(),message,Toast.LENGTH_SHORT).show();
                                Utils.setAlertMsg(HomeActivity.this,message,"Try again",false,true);
                            }


                        } catch (JSONException e) {
                            e.printStackTrace();
                            Log.e("Error Req", "Error: " + e.getMessage());
                            Utils.setAlertMsg(HomeActivity.this,"DB error","Try again",false,true);

                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        VolleyLog.d("valley ", "Error: " + error.getMessage());
                        Log.e("Error Req", "Error: " + error.getMessage());
                        // hide the progress dialog
                        Utils.setAlertMsg(HomeActivity.this,"DB not Connected","Try again",false,true);

                        hidepDialog();
                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put("userLogout", "true");
                params.put("table_id", ""+sessionManager.getTableId());

                return params;
            }

        };


        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(stringRequest);
    }

    private void showpDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hidepDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }

}
