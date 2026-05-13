# Gestión contenedor

## Iniciar contenedor
````bash
docker compose up -d
````

## Cerrar contenedor 
````bash
docker compose down -v
````

## Reiniciar contenedor 
````bash
docker restart planify_web
````


# Comandos SQL

## Mostrar la base de datos 
````sql 
mysql -u root -proot PLANIFY -e "SHOW TABLES;"
````

## Hacer una consulta 
````sql
mysql -u root -proot PLANIFY -e "SHOW TABLES; SELECT * FROM USUARIO;"
````


