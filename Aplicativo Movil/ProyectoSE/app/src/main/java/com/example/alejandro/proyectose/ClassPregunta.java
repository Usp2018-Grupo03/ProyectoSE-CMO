package com.example.alejandro.proyectose;

public class ClassPregunta {
    String id_pregunta;
    String pre_titulo;
    String pre_descripcion;
    String pre_imagen;
    String pre_fecha;
    String pre_estado;
    String pre_puntaje;

    public ClassPregunta(String id_pregunta, String pre_titulo, String pre_descripcion, String pre_imagen, String pre_fecha, String pre_estado, String pre_puntaje) {
        this.id_pregunta = id_pregunta;
        this.pre_titulo = pre_titulo;
        this.pre_descripcion = pre_descripcion;
        this.pre_imagen = pre_imagen;
        this.pre_fecha = pre_fecha;
        this.pre_estado = pre_estado;
        this.pre_puntaje = pre_puntaje;
    }

    public String getId_pregunta() {
        return id_pregunta;
    }

    public String getPre_titulo() {
        return pre_titulo;
    }

    public String getPre_descripcion() {
        return pre_descripcion;
    }

    public String getPre_imagen() {
        return pre_imagen;
    }

    public String getPre_fecha() {
        return pre_fecha;
    }

    public String getPre_estado() {
        return pre_estado;
    }

    public String getPre_puntaje() {
        return pre_puntaje;
    }
}
