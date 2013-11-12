package com.example.bsharp;

import java.util.ArrayList;

import android.app.ListActivity;
import android.os.Bundle;
import android.view.Menu;
import android.widget.ArrayAdapter;

public class SongPage extends ListActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		//setContentView(R.layout.activity_song_page);
		
		String[] songs = getResources().getStringArray(R.array.SongList);
		ArrayList<String> songList = new ArrayList<String>();
		
		for (int i = 0; i < songs.length; i++) {
			songList.add(songs[i]);
		}
		
		ArrayAdapter<String> songAdapter = new ArrayAdapter<String>(this,
				R.layout.activity_song_page, R.id.song, songList);
		
		setListAdapter(songAdapter);
		
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.song_page, menu);
		return true;
	}

}
