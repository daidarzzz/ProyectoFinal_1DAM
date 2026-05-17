package org.example.crud_proyecto;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

import java.sql.*;

import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.*;
import java.sql.Connection;

public class Datos_Anunciante {

    public static Connection conexion(){

            Connection conexion;
            String host = "jdbc:mariadb://localhost:3306/";
            String user = "root";
            String psw = "root";
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

        public static ObservableList<Anunciante> consulta (Connection connection){

            ObservableList<Anunciante> listaAnunciantes = FXCollections.observableArrayList();

            String query = "SELECT u.idusuario, u.nombre, u.contrasenia, u.email, a.empresa, a.presupuesto " +
                    "from USUARIO u inner join ANUNCIANTE a on u.idusuario = a.idusuario";

            Statement statement;

            try{

                statement = connection.createStatement();
                ResultSet respuesta = statement.executeQuery(query);

                while (respuesta.next()){

                    int id = respuesta.getInt("idusuario");
                    String nombre = respuesta.getString("nombre");
                    String contrasena = respuesta.getString("contrasenia");
                    String email = respuesta.getString("email");
                    String empresa = respuesta.getString("empresa");
                    double presupuesto = respuesta.getDouble("presupuesto");
                    listaAnunciantes.add(new Anunciante(nombre,id,contrasena,email,empresa,presupuesto));

                }


            }catch (SQLException e){

                System.out.println(e.getMessage());
                throw new RuntimeException(e);
            }

            return listaAnunciantes;

        }

        public static void eliminar (Connection conexion,Anunciante anunciante, Usuario usuario){

            System.out.println("Eliminando...");

            String queryAnunciante = "DELETE FROM ANUNCIANTE WHERE idUsuario = " + anunciante.getId();
            String queryUsuario = "DELETE FROM USUARIO WHERE idUsuario = " + anunciante.getId();

            Statement statement;

            try {
                Statement st = conexion.createStatement();

                st.executeUpdate(queryAnunciante);

                st.executeUpdate(queryUsuario);

            } catch (SQLException e) {

                throw new RuntimeException(e);

            }

        }

        public static void modificar (Connection conexion,Anunciante anunciante){

            System.out.println("Modificando...");

            String queryUsuario = "UPDATE USUARIO SET nombre = '" + anunciante.getNombre() + "', "
                    + "contrasenia = '" + anunciante.getContrasena() + "', email = '" + anunciante.getEmail() + "' "
                    + "WHERE idUsuario = " + anunciante.getId();

            String queryAnunciante = "UPDATE ANUNCIANTE SET empresa = '" + anunciante.getEmpresa() + "', "
                    + "presupuesto = " + anunciante.getPresupuesto() + " WHERE idUsuario = " + anunciante.getId();

            Statement statement;

            try {

                Statement st = conexion.createStatement();

                st.executeUpdate(queryUsuario);

                st.executeUpdate(queryAnunciante);

            } catch (SQLException e) {

                throw new RuntimeException(e);

            }

        }


        public static void insertar (Connection conexion,Anunciante anunciante){

            System.out.println("Insertando...");

            String query = "Insert into USUARIO (nombre,contrasenia,email) VALUES ('" + anunciante.getNombre() + "', " +
                    "'" + anunciante.getContrasena() + "', " + " '" + anunciante.getEmail() + "')";

            Statement statement;

            try {

                statement = conexion.createStatement();
                statement.executeUpdate(query, Statement.RETURN_GENERATED_KEYS);
                System.out.println("Usuario insertado con exito.");

                ResultSet resultSet = statement.getGeneratedKeys();
                int idGenerado = 0;
                if (resultSet.next()){

                    idGenerado = resultSet.getInt(1);

                }

                String queryAnunciante = "INSERT INTO ANUNCIANTE (idUsuario, empresa, presupuesto) VALUES ("
                        + idGenerado + ", '" + anunciante.getEmpresa() + "', " + anunciante.getPresupuesto() + ")";
                statement.executeUpdate(queryAnunciante);


            }catch (SQLIntegrityConstraintViolationException e){

            } catch (SQLException e) {

                System.out.println(e.getMessage());
                throw new RuntimeException(e);

            }

    }

}
