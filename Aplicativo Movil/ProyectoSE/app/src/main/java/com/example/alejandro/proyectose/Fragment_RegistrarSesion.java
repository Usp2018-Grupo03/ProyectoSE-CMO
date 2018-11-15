package com.example.alejandro.proyectose;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;

public class Fragment_RegistrarSesion extends Fragment implements Response.Listener<JSONObject>, Response.ErrorListener {

    RequestQueue rq;
    JsonRequest jrq;
    EditText txtNombres, txtApellidos, txtUsuario, txtPasswd, txtCorreo, txtDireccion;
    Button btnRegistrar;

    Global g = new Global();

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View vista = inflater.inflate(R.layout.fragment_fragment__registrar_sesion, container, false);

        txtNombres = (EditText) vista.findViewById(R.id.txtnombre);
        txtApellidos = (EditText) vista.findViewById(R.id.txtapellido);
        txtUsuario = (EditText) vista.findViewById(R.id.txtusu);
        txtPasswd = (EditText) vista.findViewById(R.id.txtcontra);
        txtCorreo = (EditText) vista.findViewById(R.id.txtcorreo);
        txtDireccion = (EditText) vista.findViewById(R.id.txtdirec);

        btnRegistrar = (Button) vista.findViewById(R.id.BtnRegistrar);
        rq = Volley.newRequestQueue(getContext());

        btnRegistrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                registrar_usuario();
            }
        });

        return vista;
    }

    @Override
    public void onErrorResponse(VolleyError error) {

        Toast.makeText(getContext(), "Error al registrar los datos: " + error.toString()
                , Toast.LENGTH_LONG).show();
    }

    @Override
    public void onResponse(JSONObject response) {

        Toast.makeText(getContext(), "Usuario registrado correctamente."
                , Toast.LENGTH_SHORT).show();
        limpiar();

        Intent intencion = new Intent(getContext(), MainActivity.class);
        startActivity(intencion);
    }

    void limpiar() {

        txtNombres.setText("");
        txtApellidos.setText("");
        txtUsuario.setText("");
        txtPasswd.setText("");
        txtCorreo.setText("");
        txtDireccion.setText("");
    }

    void registrar_usuario(){

        String url = "http://"+ g.DIRECCION +"/proyectose-php/reg_usuario.php" +
                "?nombres="+ txtNombres.getText().toString() +"" +
                "&apellidos="+ txtApellidos.getText().toString() +"" +
                "&usuario="+ txtUsuario.getText().toString() +"" +
                "&passwd="+ txtPasswd.getText().toString() +"" +
                "&correo="+ txtCorreo.getText().toString() +"" +
                "&direccion="+ txtDireccion.getText().toString() +"";

        jrq = new JsonObjectRequest(Request.Method.GET, url, null, this, this);
        rq.add(jrq);
    }
}
