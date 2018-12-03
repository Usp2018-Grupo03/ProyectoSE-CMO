package com.example.alejandro.proyectose;


import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.app.FragmentManager;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class ActivityMenu extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    ArrayList<ClassPregunta> alistPREGUNTA;
    PreguntaAdaptador mADAPTADORPREGUNTA;
    RecyclerView rvLISTARPREGUNTA;
    RequestQueue mREQUESTQUEUELISTAR;

    Global g = new Global();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.escenariomenu);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        /* FragmentManager fragmentManager = getSupportFragmentManager();
        fragmentManager.beginTransaction().replace(R.id.contenedor,new Fragment_IniciarSesion()).commit(); */

        String usuario=getIntent().getStringExtra("nombre");

        alistPREGUNTA = new ArrayList<ClassPregunta>();
        rvLISTARPREGUNTA = (RecyclerView) findViewById(R.id.rvListarPregunta);
        rvLISTARPREGUNTA.setHasFixedSize(true);
        rvLISTARPREGUNTA.setLayoutManager(new LinearLayoutManager(this));
        mREQUESTQUEUELISTAR = Volley.newRequestQueue(this);

        LlenarRecycler();
    }

    private void LlenarRecycler(){

        String URL = "http://"+ g.DIRECCION +"/proyectose-php/listarpregunta.php";

        JsonObjectRequest request = new JsonObjectRequest(Request.Method.GET, URL, null,
                new Response.Listener<JSONObject>(){
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            JSONArray jsonArray = response.getJSONArray("pregunta");

                            for (int i = 0; i < jsonArray.length(); i++) {
                                JSONObject pregunta = jsonArray.getJSONObject(i);

                                String id_pregunta = pregunta.getString("id_pregunta");
                                String pre_titulo = pregunta.getString("pre_titulo");
                                String pre_descripcion = pregunta.getString("pre_descripcion");
                                String pre_imagen = pregunta.getString("pre_imagen");
                                String pre_fecha = pregunta.getString("pre_fecha");
                                String pre_estado = pregunta.getString("pre_estado");
                                String pre_puntaje = pregunta.getString("pre_puntaje");

                                alistPREGUNTA.add(new ClassPregunta(id_pregunta, pre_titulo, pre_descripcion, pre_imagen, pre_fecha, pre_estado, pre_puntaje));

                            }

                            mADAPTADORPREGUNTA = new PreguntaAdaptador(ActivityMenu.this, alistPREGUNTA);
                            rvLISTARPREGUNTA.setAdapter(mADAPTADORPREGUNTA);

                            Toast.makeText(getApplicationContext(), "Lista de Preguntas.", Toast.LENGTH_LONG).show();

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                error.printStackTrace();
            }
        });

        mREQUESTQUEUELISTAR.add(request);
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.escenariomenu);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.activity_menu, menu);
        return true;
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        FragmentManager fragmentManager = getSupportFragmentManager();

        if (id == R.id.nav_camera) {
            fragmentManager.beginTransaction().replace(R.id.contenedor,new HistorialFragment()).commit();
        } else if (id == R.id.nav_gallery) {
            fragmentManager.beginTransaction().replace(R.id.contenedor,new DiagnosticoFragment()).commit();
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.escenariomenu);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }
}
