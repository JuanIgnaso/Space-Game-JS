# Space-Game-JS
Juego con aspecto retro,usando JS y framework CSS TailwindCSS para el estilo y estructuración.

## Objetivo de la aplicación
Recrear un juego de matamarcianos mediante uso de JS y PHP en Backend para guardar los resultados de las partidas.

## Modo de uso
Mueve el ratón dentro del recuadro y derriba a los enemigos para recoger la mayor puntuación posible.

### PowerUps
El juego dispone de 3 powerUps.
| Double Points  | Penetrating Bullets | Invencible |
| ------------- | ------------- | --------------|
| Recibes el doble de puntos  | Balas atraviensan enemigos  | invencible por 5s |

## Puesta en marcha
Clona el repositorio en tu carpeta de preferencia o bajate la carpeta de la aplicación y dentro de la carpeta raíz del proyecto ejecuta el siguiente comando:
```
docker compose up -d
```
Si la app te da error de que no tiene composer instalado, ejecuta el siguiente comando a continuación dentro de la carpeta raíz:
```
docker compose exec app composer install
```
Docker te construirá una imagen con un sencillo servicio PHP-Apache y un MYSQL con la Base de Datos para poder usarla.

## Requisitos
Tener **Docker CLI** o **Docker desktop** instalados en el equipo.
