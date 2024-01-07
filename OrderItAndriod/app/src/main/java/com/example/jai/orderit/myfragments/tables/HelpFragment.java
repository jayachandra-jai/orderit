package com.example.jai.orderit.myfragments.tables;

import android.app.Fragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.example.jai.orderit.R;

/**
 * Created by KEERTHI on 02-03-2018.
 */

public class HelpFragment  extends Fragment {

    View view;


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
// Inflate the layout for this fragment
        view = inflater.inflate(R.layout.help_home, container, false);
//        textView = view.findViewById(R.id.tv_fragment);
        return view;
    }
}