package org.example.crud_proyecto;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.*;
import java.sql.Connection;

public class Datos_Usuario {

    public static Connection conexion(){

        Connection conexion;
        String host = "jdbc:mariadb://localhost:3310/"; // Por definir
        String user = "root";
        String psw = "";
        String bd = "PLANIFY";
        System.out.println("Conectando...");

        try{

            conexion = DriverManager.getConnection(host + bd, user , psw);
            System.out.println("Conexión realizada con exito");

        }catch (SQLException e){

            System.out.println(e.getMessage());
            throw new RuntimeException();

        }

        return conexion;

    }

    public static void desconectar(Connection conexion) {

        System.out.println("Desconectando...");

        try {
            conexion.close();
            System.out.println("Conexión finalizada.");
        } catch (SQLException e) {
            System.out.println(e.getMessage());
            throw new RuntimeException(e);
        }
    }

    public static ObservableList<Usuario> consulta (Connection connection){

        ObservableList<Usuario> listaUsuarios = FXCollections.observableArrayList();

        String query = "SELECT * from USUARIO";

        Statement statement;

        try{

            statement = connection.createStatement();
            ResultSet respuesta = statement.executeQuery(query);

            while (respuesta.next()){

                int id = respuesta.getInt("idusuario");
                String nombre = respuesta.getString("nombre");
                String contrasena = respuesta.getString("contraseña");
                String email = respuesta.getString("email");
                listaUsuarios.add(new Usuario(nombre,id,contrasena,email));

            }


        }catch (SQLException e){

            System.out.println(e.getMessage());
            throw new RuntimeException(e);
        }

        return listaUsuarios;

    }

    public static void eliminar (Connection conexion,Usuario usuario){

        System.out.println("Eliminando...");

        String query = "Delete From USUARIO where idusuario = '" + usuario.getId() + "'";

        Statement statement;

        try {

            statement = conexion.createStatement();
            statement.executeQuery(query);


        }catch (SQLIntegrityConstraintViolationException e){

            throw new Integridad_Exception();

        } catch (SQLException e) {

            System.out.println(e.getMessage());
            throw new RuntimeException(e);

        }

    }

    public static void modificar (Connection conexion,Usuario usuario){

        System.out.println("Modificando...");

        String query = "Update USUARIO SET nombre = '" + usuario.getNombre() + "', " + "contraseña = '" +
                usuario.getContrasena() + "', " + "email = '" + usuario.getEmail()
                + "' WHERE idusuario = '" + usuario.getId() + "'";

        Statement statement;

        try {

            statement = conexion.createStatement();
            statement.executeQuery(query);


        } catch (SQLException e) {

            System.out.println(e.getMessage());
            throw new RuntimeException(e);

        }

    }


    public static void insertar (Connection conexion,Usuario usuario){

        System.out.println("Insertando...");

        String query = "Insert into USUARIO (nombre,contraseña,email) VALUES ('" + usuario.getNombre() + "', " +
                "'" + usuario.getContrasena() + "', " + " '" +
                usuario.getEmail() + "')";

        Statement statement;

        try {

            statement = conexion.createStatement();
            statement.executeQuery(query);
            System.out.println("Usuario insertado con exito.");


        } catch (SQLException e) {

            System.out.println(e.getMessage());
            throw new RuntimeException(e);

        }

    }


}
