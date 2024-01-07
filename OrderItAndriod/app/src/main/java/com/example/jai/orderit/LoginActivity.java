package com.example.jai.orderit;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Typeface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.StringRequest;
import com.example.jai.orderit.utils.AppController;
import com.example.jai.orderit.utils.SessionManager;
import com.example.jai.orderit.utils.Urls;
import com.example.jai.orderit.utils.Utils;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class LoginActivity extends AppCompatActivity {
    EditText tab_id, tab_pass;
    Button tab_login;
    private ProgressDialog pDialog;
    SessionManager sessionManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        tab_id = findViewById(R.id.tab_id);
        tab_pass = findViewById(R.id.tab_pass);
        tab_login = findViewById(R.id.tab_login);
        pDialog = new ProgressDialog(this);
        sessionManager = new SessionManager(LoginActivity.this);
        Utils.hideKeyBoard(LoginActivity.this);

        tab_pass.setTypeface(Typeface.DEFAULT);
        pDialog.setMessage("Please wait...");
        pDialog.setCancelable(false);

        tab_login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showpDialog();
                loginTable();
            }
        });


    }

    private void showpDialog() {
        if (!pDialog.isShowing())
            pDialog.show();
    }

    private void hidepDialog() {
        if (pDialog.isShowing())
            pDialog.dismiss();
    }

    private void loginTable() {

        StringRequest stringRequest = new StringRequest(
                Request.Method.POST,
                Urls.requestAPi,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Log.d("res", response.toString());
                        hidepDialog();
                        try {
                            JSONObject jsonresponse = new JSONObject(response);
                            String message = jsonresponse.getString("message");
                            if (jsonresponse.getBoolean("status")) {
                                Log.d("info", jsonresponse.getJSONObject("tableinfo").toString());
                                JSONObject info = jsonresponse.getJSONObject("tableinfo");
                                sessionManager.createLoginSession(info.getString("table_id"),info.getString("name"));
                                Toast.makeText(getApplicationContext(),message,Toast.LENGTH_SHORT).show();

                                startActivity(new Intent(getApplicationContext(),HomeActivity.class));
                                finish();
                            }
                            else{
//                                Toast.makeText(getApplicationContext(),message,Toast.LENGTH_SHORT).show();
                                Utils.setAlertMsg(LoginActivity.this,message,"Try again",false,true);
                            }



                        } catch (JSONException e) {
                            e.printStackTrace();
                            Utils.setAlertMsg(LoginActivity.this,"Database Error","Try again",false,true);

                        }


                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        hidepDialog();
                        VolleyLog.d("valley ", "Error: " + error.getMessage());
                        Utils.setAlertMsg(LoginActivity.this,"Database not Connected","Try again",false,true);

                    }
                }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<>();
             params.put("userLogin", "true");
             params.put("table_id", ""+tab_id.getText());
             params.put("password", ""+tab_pass.getText());
                return params;
            }

        };


        // Adding request to request queue
        AppController.getInstance().addToRequestQueue(stringRequest);
    }

}
