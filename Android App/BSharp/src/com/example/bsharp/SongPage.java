package com.example.bsharp;

import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;

import android.app.ListActivity;
import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

public class SongPage extends ListActivity {

	//String url = "http://ec2-54-200-98-78.us-west-2.compute.amazonaws.com/DB-GUI/web-src/AndroidGetPDF.php";
	String url = "www.bsharp.tk/BSharp/web-src/AndroidGetPDF.php";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		// setContentView(R.layout.activity_song_page);

		ArrayList<String> songList = new ArrayList<String>();

		Intent intent = getIntent();
		Bundle b = this.getIntent().getExtras();

		final String[] songName = b.getStringArray("songName");
		final int[] songID = b.getIntArray("songID");
		final String[] songURL = b.getStringArray("songURL");
		final int userID = b.getInt("userID");
		final int bandID = b.getInt("bandID");

		if (intent != null) {

			for (int i = 0; i < songName.length; i++) {
				songList.add(songName[i]);
			}

			ArrayAdapter<String> songAdapter = new ArrayAdapter<String>(this,
					R.layout.activity_song_page, R.id.song, songList);

			setListAdapter(songAdapter);
		}

		ListView listView = getListView();

		listView.setOnItemClickListener(new OnItemClickListener() {
			public void onItemClick(AdapterView<?> listView, View itemView,
					int itemPosition, long itemId) {
				new GetPDF(bandID, userID, songID[0]).execute();
			}
		});

	}

	private void getFile(String url) {
	
		try {
			Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
			startActivity(intent);
		} catch (ActivityNotFoundException e) {
			Toast.makeText(this, "Error: " + e.getMessage(), Toast.LENGTH_SHORT)
					.show();
			Log.e("ActivityNotFoundException", "Error: " + e.getMessage(), e);
		} catch (NullPointerException e) {
			Toast.makeText(this, "Error: " + e.getMessage(), Toast.LENGTH_SHORT)
					.show();
			Log.e("NullPointerException", "Error: " + e.getMessage(), e);
		}
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.song_page, menu);
		return true;
	}

	private class GetPDF extends AsyncTask<Void, Void, String> {

		int band_id;
		int user_id;
		int song_id;
		String surl;

		public GetPDF(int band_id, int user_id, int song_id) {
			this.band_id = band_id;
			this.user_id = user_id;
			this.song_id = song_id;
		}

		@Override
		protected String doInBackground(Void... params) {
			HttpClient httpclient = new DefaultHttpClient();
			HttpPost httpPost = new HttpPost(url);

			try {

				List<NameValuePair> pairs = new ArrayList<NameValuePair>(2);
				pairs.add(new BasicNameValuePair("bandID", Integer
						.toString(band_id)));
				pairs.add(new BasicNameValuePair("userID", Integer
						.toString(user_id)));
				pairs.add(new BasicNameValuePair("songID", Integer
						.toString(song_id)));

				httpPost.setEntity(new UrlEncodedFormEntity(pairs));
				HttpResponse response = httpclient.execute(httpPost);

				HttpEntity entity = response.getEntity();
				surl = EntityUtils.toString(response.getEntity());

			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
			onPostExecute(surl);

			return surl;
		}

		protected void onPostExecute(String results) {
			Log.d("testing", "it got here");
			getFile(results);
			
		}
	}
}
