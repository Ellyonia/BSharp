package com.example.bsharp;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Login extends Activity {

	EditText inputEmail;
	EditText inputPassword;
	Button login;

	private static String KEY_SUCCESS = "success";
	private static String KEY_UID = "uid";
	private static String KEY_USERNAME = "uname";
	private static String KEY_FIRSTNAME = "fname";
	private static String KEY_LASTNAME = "lname";
	private static String KEY_EMAIL = "email";
	private static String KEY_CREATED_AT = "created_at";

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
					Intent i = new Intent(Login.this, BandPage.class);
					 startActivity(i);
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

		/*
		 * //Testing BandPage.java 
		 * Intent i = new Intent(this, BandPage.class);
		 * startActivity(i);
		 */

		// Testing SongPage.java
		// Intent i = new Intent(this, SongPage.class);
		// startActivity(i);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.login, menu);
		return true;
	}

	private class NetCheck extends AsyncTask<String, Void, Boolean> {
		private ProgressDialog nDialog;

		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			nDialog = new ProgressDialog(Login.this);
			nDialog.setTitle("Checking Network");
			nDialog.setMessage("Loading..");
			nDialog.setIndeterminate(false);
			nDialog.setCancelable(true);
			nDialog.show();
		}

		@Override
		protected Boolean doInBackground(String... args) {

			/**
			 * Gets current device state and checks for working internet
			 * connection by trying Google.
			 **/
			ConnectivityManager cm = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
			NetworkInfo netInfo = cm.getActiveNetworkInfo();
			if (netInfo != null && netInfo.isConnected()) {
				try {
					URL url = new URL("http://ec2-54-200-98-78.us-west-2.compute.amazonaws.com/DB-GUI/web-src/index.php");
					HttpURLConnection urlc = (HttpURLConnection) url
							.openConnection();
					urlc.setConnectTimeout(3000);
					urlc.connect();
					if (urlc.getResponseCode() == 200) {
						return true;
					}
				} catch (MalformedURLException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				} catch (IOException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
			return false;

		}

//		@Override
//		protected void onPostExecute(Boolean th) {
//
//			if (th == true) {
//				nDialog.dismiss();
//				new ProcessLogin().execute();
//			} else {
//				nDialog.dismiss();
//				//loginErrorMsg.setText("Error in Network Connection");
//			}
//		}
	}

//	private class ProcessLogin extends AsyncTask<String, Void, JSONObject> {
//
//		private ProgressDialog pDialog;
//
//		String email, password;
//
//		@Override
//		protected void onPreExecute() {
//			super.onPreExecute();
//
//			inputEmail = (EditText) findViewById(R.id.email_field);
//			inputPassword = (EditText) findViewById(R.id.email_field);
//			email = inputEmail.getText().toString();
//			password = inputPassword.getText().toString();
//			pDialog = new ProgressDialog(Login.this);
//			pDialog.setTitle("Contacting Servers");
//			pDialog.setMessage("Logging in ...");
//			pDialog.setIndeterminate(false);
//			pDialog.setCancelable(true);
//			pDialog.show();
//		}
//
//		@Override
//		protected JSONObject doInBackground(String... args) {
////			return loadJSONFromNetwork(args[0]);
////			//UserFunctions userFunction = new UserFunctions();
////			JSONObject json = userFunction.loginUser(email, password);
////			return json;
//		}
////
////		@Override
////		protected void onPostExecute(JSONObject json) {
////			try {
////				
////			} catch (JSONException e) {
////				e.printStackTrace();
////			}
////		}
//	}
//
//	public void NetAsync(View view) {
//		new NetCheck().execute();
//	}

}
