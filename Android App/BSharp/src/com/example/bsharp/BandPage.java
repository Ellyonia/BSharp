package com.example.bsharp;

import java.util.ArrayList;

import android.app.ListActivity;
import android.os.Bundle;
import android.view.Menu;
import android.widget.ArrayAdapter;

public class BandPage extends ListActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		//setContentView(R.layout.activity_band_page);
		
		String[] bands = getResources().getStringArray(R.array.BandList);
		ArrayList<String> bandList = new ArrayList<String>();
		
		for (int i = 0; i < bands.length; i++) {
			bandList.add(bands[i]);
		}
		
		ArrayAdapter<String> bandAdapter = new ArrayAdapter<String>(this,
				R.layout.activity_band_page, R.id.band, bandList);
		
		setListAdapter(bandAdapter);
		
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.band_page, menu);
		return true;
	}

}
