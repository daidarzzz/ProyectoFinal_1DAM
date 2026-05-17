package org.example.crud_proyecto;

public class Usuario {

    private String nombre;
    private Integer id;
    private String contrasena;
    private String email;

    public Usuario(String nombre, Integer id, String contrasena, String email) {
        this.nombre = nombre;
        this.id = id;
        this.contrasena = contrasena;
        this.email = email;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getContrasena() {
        return contrasena;
    }

    public void setContrasena(String contrasena) {
        this.contrasena = contrasena;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    @Override
    public String toString() {
        return "Usuario{" +
                "nombre='" + nombre + '\'' +
                ", id=" + id +
                ", contrasena='" + contrasena + '\'' +
                ", email='" + email + '\'' +
                '}';
    }
}
