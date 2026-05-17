package org.example.crud_proyecto;

public class Anunciante extends Usuario {

    private String empresa;
    private double presupuesto;

    public Anunciante(String nombre, Integer id, String contrasena, String email, String empresa, double presupuesto) {
        super(nombre, id, contrasena, email);
        this.empresa = empresa;
        this.presupuesto = presupuesto;
    }

    public String getEmpresa() {
        return empresa;
    }

    public void setEmpresa(String empresa) {
        this.empresa = empresa;
    }

    public double getPresupuesto() {
        return presupuesto;
    }

    public void setPresupuesto(double presupuesto) {
        this.presupuesto = presupuesto;
    }

    @Override
    public String toString() {
        return "Anunciante{" +
                "empresa='" + empresa + '\'' +
                ", presupuesto=" + presupuesto +
                '}';
    }
}
