package com.example.bsharp;

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
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.ListActivity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.ListView;

public class BandPage extends ListActivity {

	//String url = "http://ec2-54-200-98-78.us-west-2.compute.amazonaws.com/DB-GUI/web-src/getAndroidParts.php";
	String url = "www.bsharp.tk/BSharp/web-src/getAndroidParts.php";
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		// setContentView(R.layout.activity_band_page);

		ArrayList<String> bandList = new ArrayList<String>();

		Intent intent = getIntent();
		Bundle b = this.getIntent().getExtras();

		final String[] bandName = b.getStringArray("bName");
		final int[] bandID = b.getIntArray("bID");
		final int userID = b.getInt("userID");

		if (intent != null) {

			for (int i = 0; i < bandName.length - 1; i++) {
				bandList.add(bandName[i]);
			}

			ArrayAdapter<String> bandAdapter = new ArrayAdapter<String>(this,
					R.layout.activity_band_page, R.id.band, bandList);

			setListAdapter(bandAdapter);
		}

		ListView listView = getListView(); // hear bind your listview

		// setListAdapter(new ArrayAdapter<String>(this,
		// android.R.layout.simple_selectable_list_item,getResources().getStringArray(R.array.countries)));

		// listView.setAdapter(bandAdapter);
		listView.setOnItemClickListener(new OnItemClickListener() {
			public void onItemClick(AdapterView<?> listView, View itemView,
					int itemPosition, long itemId) {
				new GetPieces(bandID[itemPosition], userID).execute();
			}
		});

	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.band_page, menu);
		return true;
	}

	private class GetPieces extends AsyncTask<Void, Void, Void> {

		int band_id;
		int user_id;

		public GetPieces(int band_id, int user_id) {
			this.band_id = band_id;
			this.user_id = user_id;
		}

		@Override
		protected Void doInBackground(Void... params) {

			HttpClient httpclient = new DefaultHttpClient();
			HttpPost httpPost = new HttpPost(url);
			String[] songName;
			int[] songID;
			String[] songURL;

			try {

				List<NameValuePair> pairs = new ArrayList<NameValuePair>(2);
				pairs.add(new BasicNameValuePair("bandID", Integer
						.toString(band_id)));
				pairs.add(new BasicNameValuePair("userID", Integer
						.toString(user_id)));

				httpPost.setEntity(new UrlEncodedFormEntity(pairs));
				HttpResponse response = httpclient.execute(httpPost);

				HttpEntity entity = response.getEntity();

				if (null != entity) {
					String json = EntityUtils.toString(response.getEntity());
					JSONObject song = new JSONObject(json);
					JSONArray songinfo = song.getJSONArray("pieces");
					
					songName = new String[songinfo.length()];
					songID = new int[songinfo.length()];
					songURL = new String[songinfo.length()];
					
					for (int i = 0; i < songinfo.length(); i++) {
						songName[i] = songinfo.getJSONObject(i).getString("pieceName");
						songID[i] = songinfo.getJSONObject(i).getInt("pieceID");
						songURL[i] = songinfo.getJSONObject(i).getString("forURL");
					
						
						Log.d("song stuff", songName[i] + " " + songID[i] + " " + songURL[i]);
						//String bName = songinfo.getString("name");
						//int bID = songinfo.getInt("id");
					}
					
					Intent i = new Intent(BandPage.this, SongPage.class);
					Bundle b = new Bundle();

					b.putStringArray("songName", songName);
					b.putIntArray("songID", songID);
					b.putStringArray("songURL", songURL);
					b.putInt("userID", user_id);
					b.putInt("bandID", band_id);
					i.putExtras(b);
					startActivity(i);
					
				}

			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			return null;
		}

	}

}
