package org.example.crud_proyecto;

public class Integridad_Exception extends RuntimeException {
    public Integridad_Exception() {
        super("Este usuario tambien pertenece a Anunciante, ves a la tabla Anunciante para borrarlo!");
    }
}
