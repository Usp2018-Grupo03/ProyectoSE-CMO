package com.example.alejandro.proyectose;

public class ClassDiagnostico {

    private String id_diagnosticofinal;
    private String dif_nombre;
    private String dif_enfermedad;
    private String dif_porcentaje;
    private String dif_fecha;

    public ClassDiagnostico(String id_diagnosticofinal, String dif_nombre, String dif_enfermedad, String dif_porcentaje, String dif_fecha) {
        this.id_diagnosticofinal = id_diagnosticofinal;
        this.dif_nombre = dif_nombre;
        this.dif_enfermedad = dif_enfermedad;
        this.dif_porcentaje = dif_porcentaje;
        this.dif_fecha = dif_fecha;
    }

    public String getId_diagnosticofinal() {
        return id_diagnosticofinal;
    }

    public String getDif_nombre() {
        return dif_nombre;
    }

    public String getDif_enfermedad() {
        return dif_enfermedad;
    }

    public String getDif_porcentaje() {
        return dif_porcentaje;
    }

    public String getDif_fecha() {
        return dif_fecha;
    }
}
