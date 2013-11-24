package com.example.bsharp;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Login extends Activity {

	EditText inputEmail;
	EditText inputPassword;
	Button login;
	String url = "http://ec2-54-200-98-78.us-west-2.compute.amazonaws.com/DB-GUI/web-src/AndroidLogin.php";

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_login);

		inputEmail = (EditText) findViewById(R.id.email_field);
		inputPassword = (EditText) findViewById(R.id.password_field);
		login = (Button) findViewById(R.id.login);

		/**
		 * Login button click event A Toast is set to alert when the Email and
		 * Password field is empty
		 **/
		login.setOnClickListener(new View.OnClickListener() {

			public void onClick(View view) {

				if ((!inputEmail.getText().toString().equals(""))
						&& (!inputPassword.getText().toString().equals(""))) {
					List<NameValuePair> pairs = new ArrayList<NameValuePair>(2);
					ArrayList<String> p = new ArrayList<String>();
					p.add(inputEmail.getText().toString());
					p.add(inputPassword.getText().toString());
					
					pairs.add(new BasicNameValuePair("userName", inputEmail
							.getText().toString()));
					pairs.add(new BasicNameValuePair("password", inputPassword
							.getText().toString()));
					new UserCheck().execute(p);
				} else if ((!inputEmail.getText().toString().equals(""))) {
					Toast.makeText(getApplicationContext(),
							"Password field empty", Toast.LENGTH_SHORT).show();
				} else if ((!inputPassword.getText().toString().equals(""))) {
					Toast.makeText(getApplicationContext(),
							"Email field empty", Toast.LENGTH_SHORT).show();
				} else {
					Toast.makeText(getApplicationContext(),
							"Email and Password field are empty",
							Toast.LENGTH_SHORT).show();
				}
			}
		});

	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.login, menu);
		return true;
	}

	private class UserCheck extends AsyncTask<ArrayList<String>, Void, String> {

		public UserCheck() {
			// TODO Auto-generated constructor stub
		}

		@Override
		protected String doInBackground(ArrayList<String>... credentials) {

			String result = "";
			String[] bandName;
			int[] bandID;

			HttpClient httpclient = new DefaultHttpClient();
			HttpPost httpPost = new HttpPost(url);

			try {

				String test = Integer.toString(credentials.length);
				List<NameValuePair> pairs = new ArrayList<NameValuePair>(2);
				Log.w("warning", test);
				pairs.add(new BasicNameValuePair("userName", credentials[0]
						.get(0)));
				pairs.add(new BasicNameValuePair("password", credentials[0]
						.get(1)));

				httpPost.setEntity(new UrlEncodedFormEntity(pairs));

				HttpResponse response = httpclient.execute(httpPost);
				HttpEntity entity = response.getEntity();
				if (null != entity) {
					String json = EntityUtils.toString(response.getEntity());
					JSONObject user = new JSONObject(json);
					int valid = user.getInt("valid");

					if (valid != -1) {

						bandName = new String[user.length()];
						bandID = new int[user.length()];

						for (int i = 0; i < user.length() - 1; i++) {
							JSONObject bandinfo = user.getJSONObject(Integer
									.toString(i));
							String bName = bandinfo.getString("name");
							int bID = bandinfo.getInt("id");

							// band = new Band(valid, bID, bName);
							bandName[i] = bName;
							bandID[i] = bID;

							// Log.d("test", bName);

						}

						Intent i = new Intent(Login.this, BandPage.class);
						Bundle b = new Bundle();

						b.putStringArray("bName", bandName);
						b.putIntArray("bID", bandID);
						b.putInt("userID", valid);
						i.putExtras(b);
						startActivity(i);
					}

					else {
						// onPostExecute();

					}

				} else {
					Log.d("test", "no entity");
				}

			} catch (ClientProtocolException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			return result;
		}
		/*
		 * protected void onPostExecute() {
		 * Toast.makeText(getApplicationContext(),"Incorrect info",
		 * Toast.LENGTH_SHORT).show(); Log.d("blah", "is this working"); }
		 */

		/*
		 * protected void onProgressUpdate(Integer... values) {
		 * Toast.makeText(getApplicationContext(),"Incorrect info",
		 * Toast.LENGTH_SHORT).show(); //super.onProgressUpdate(values);
		 */
		// }

	}

}
