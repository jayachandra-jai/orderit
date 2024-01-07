package com.example.jai.orderit;

import android.content.Intent;
import android.support.annotation.NonNull;
import android.support.design.widget.BottomNavigationView;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.TabLayout;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.view.View;

import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Toast;

import com.andremion.counterfab.CounterFab;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;
import com.example.jai.orderit.myfragments.items.NonVegFragment;
import com.example.jai.orderit.myfragments.items.OffersFragment;
import com.example.jai.orderit.myfragments.items.VegFragment;
import com.example.jai.orderit.utils.AppController;
import com.example.jai.orderit.utils.BottomNavigationViewHelper;
import com.example.jai.orderit.utils.DatabaseHandler;
import com.example.jai.orderit.utils.SessionManager;
import com.example.jai.orderit.utils.Urls;
import com.example.jai.orderit.utils.Utils;

import java.util.HashMap;
import java.util.Map;

public class CustomerActivity extends AppCompatActivity implements View.OnClickListener {

    BottomNavigationView btnov;
    SessionManager sessionManager;
    CounterFab myfab;
    DatabaseHandler mycart;

    private Boolean isFabOpen = false;
    private FloatingActionButton helpfab, fab1, fab3, fab2;
    private Animation fab_open, fab_close, rotate_forward, rotate_backward;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_customer);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        helpfab = findViewById(R.id.Helpfab);
        fab1 = findViewById(R.id.fab1);
        fab2 =  findViewById(R.id.fab2);
        fab3 =  findViewById(R.id.fab3);
        fab_open = AnimationUtils.loadAnimation(getApplicationContext(), R.anim.fab_open);
        fab_close = AnimationUtils.loadAnimation(getApplicationContext(), R.anim.fab_close);
        rotate_forward = AnimationUtils.loadAnimation(getApplicationContext(), R.anim.rotate_forward);
        rotate_backward = AnimationUtils.loadAnimation(getApplicationContext(), R.anim.rotate_backward);
        helpfab.setOnClickListener(this);
        fab1.setOnClickListener(this);
        fab2.setOnClickListener(this);
        fab3.setOnClickListener(this);

        TabLayout tabLayout = (TabLayout) findViewById(R.id.tabs);
        replaceFragment(new VegFragment());
        btnov=findViewById(R.id.bottom_navigation);
        BottomNavigationViewHelper.disableShiftMode(btnov);
        sessionManager=new SessionManager(CustomerActivity.this);
        toolbar.setTitle("Mr. / Mrs."+sessionManager.getCustomerName());

        mycart=new DatabaseHandler(CustomerActivity.this);
        tabLayout.setOnTabSelectedListener(new TabLayout.OnTabSelectedListener() {
            @Override
            public void onTabSelected(TabLayout.Tab tab) {
                setCurrentTabFragment(tab.getPosition());
            }

            @Override
            public void onTabUnselected(TabLayout.Tab tab) {

            }

            @Override
            public void onTabReselected(TabLayout.Tab tab) {

            }
        });


        btnov.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                switch (item.getItemId()) {
                    case R.id.action_order:
                        startActivity(new Intent(CustomerActivity.this,CartActivity.class));
                        break;
                    case R.id.action_help:
                        Toast.makeText(CustomerActivity.this,"Help place",Toast.LENGTH_SHORT).show();
                        break;
                    case R.id.action_view_order:
                        startActivity(new Intent(CustomerActivity.this,ViewOrdersActivity.class));
                        break;
                    case R.id.action_checkout:
                        startActivity(new Intent(CustomerActivity.this,CheckOutActivity.class));
                        finish();
                        break;
                }
                return true;
            }
        });

        myfab=  findViewById(R.id.fab);
        myfab.setCount(mycart.getCartSize());
        myfab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
            startActivity(new Intent(CustomerActivity.this,CartActivity.class));
//                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
//                        .setAction("Action", null).show();
            }
        });

    }

    private void setCurrentTabFragment(int position) {
        switch (position)
        {
                case 0:
                    replaceFragment(new VegFragment());
                    break;

                case 1:
                    replaceFragment(new NonVegFragment());
                    break;
                case 2:
                    replaceFragment(new OffersFragment());
                    break;

        }
    }
    public void replaceFragment(Fragment fragment) {
        FragmentManager fm = getSupportFragmentManager();
        FragmentTransaction ft = fm.beginTransaction();
        ft.replace(R.id.container, fragment);
        ft.setTransition(FragmentTransaction.TRANSIT_FRAGMENT_OPEN);
        ft.commit();
    }

    @Override
    protected void onRestart() {
        super.onRestart();

        myfab.setCount(mycart.getCartSize());
    }

    @Override
    public void onClick(View v) {
        int id = v.getId();
        switch (id) {
            case R.id.Helpfab:
                animateFAB();
                break;
            case R.id.fab1:
                fabRequest("iswater");
                animateFAB();
                break;
            case R.id.fab2:
                fabRequest("isbowl");
                animateFAB();
                break;
            case R.id.fab3:
                fabRequest("ishelper");
                animateFAB();
        }
    }

    public void animateFAB() {

        if (isFabOpen) {

            helpfab.startAnimation(rotate_backward);
            fab1.startAnimation(fab_close);
            fab2.startAnimation(fab_close);
            fab3.startAnimation(fab_close);
            fab1.setClickable(false);
            fab2.setClickable(false);
            fab3.setClickable(false);
            isFabOpen = false;

        } else {
            helpfab.startAnimation(rotate_forward);
            fab1.startAnimation(fab_open);
            fab2.startAnimation(fab_open);
            fab3.startAnimation(fab_open);
            fab1.setClickable(true);
            fab2.setClickable(true);
            fab3.setClickable(true);
            isFabOpen = true;

        }
    }
    private void fabRequest(final String req) {

        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.fabAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        String msg="";
                        switch (req){
                            case "iswater": msg="Water will be served soon";
                                            break;
                            case "isbowl":  msg="Finger bowl will be served soon";
                                            break;
                            case "ishelper":msg="Helper will come soon";
                                            break;
                        }

                                Log.d("msg","sent");
                        Utils.setAlertMsg(CustomerActivity.this,msg,"OK",false,true);

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        VolleyLog.d("valley ", "Error: " + error.getMessage());
                        Log.e("Error Req", "Error: " + error.getMessage());
                        Utils.setAlertMsg(CustomerActivity.this,"DB not Connected","Try again",false,true);

                        // hide the progress dialog

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
                params.put(req, "true");
                params.put("tab_id",sessionManager.getTableId());

                return params;
            }

        };


        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(stringRequest);

    }

}
