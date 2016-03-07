# ExamenesOnline
***
##Equipo de Desarrollo: 
###Dead Developers
-Lozoya Rodríguez Oscar Ivan
-Pérez Plascencia Gerardo Noé
-Suarez Carrillo Jose Alberto  

##Ámbito del Proyecto:
***
“ExamenesOnline” pretende ser una plataforma de exámenes para la evaluación de candidatos y empleados de la empresa donde se quiera implementar.

##Requerimientos:
***
*Servidor Web
*PHP 5
*MySQL
*Licencias
**"ExamenesOline"** está diseñado bajo software libre, por lo que cualquier persona podrá mejorar el diseño y desempeño que este tenga al termino de sus desarrollo ya que el código estará disponible para su posterior modificación y/o adaptación.  

##Descripción del proyecto:
***
###Usuarios:
Existirán 3 roles de usuarios cada uno con permisos y limites definidos, los roles se listan y explican a continuación:
####Usuario común:
Este usuario utilizara la plataforma para contestar los exámenes que se le han asignado, podrá consultar sus resultados en cualquier momento, también tendrá un perfil que podrá actualizar (los datos del mismo serán vistos y gestionados por la empresa) este perfil podrá ser consultado por otros usuarios.

####Moderador:
El rol de moderador podrá gestionar la creación y asignación de exámenes, administrar el banco de reactivos, administrando las preguntas (creación, modificación y eliminación de reactivos) y solucionar conflictos de reactivos (**apartado Examen**). 

####Administrador:
Este usuario estará en la administración backend del sistema podrá dar de alta a usuarios de cualquier rol, asignar exámenes, administrar el banco de reactivos, categorías, resolución de conflictos de reactivos, así como la administración del slider de la página.

###Examen
***
####Creación:
Cuando el moderador/administrador crea un examen para un usuario lo único que hace es indicar la categoría, la cantidad de preguntas, la duración y el porcentaje mínimo aprobatorio, el sistema tomara de manera aleatoria esa cantidad de preguntas de la categoría.

####Calificación de exámenes:
Los exámenes se califican solo para las preguntas de opción múltiple, las preguntas con respuesta abierta tendrán que ser calificadas por el administrador o moderador.
Cuando un examen es calificado como aprobatorio le llega al usuario un correo de notificación felicitándole porque ha obtenido un puntaje aprobatorio en el examen.
El definir si un examen es o no aprobatorio se hará de manera general en la plataforma aunque por examen por usuario puede definir el mínimo puntaje para que sea aprobatorio.

####Preguntas:
Cuando se va a ingresar una pregunta al banco de reactivos tendrá que poner la pregunta, indicar a que categoría pertenece (puede pertenecer a más de una categoría), e indicar el tipo de respuesta, si es de opciones tiene que agregar todos los reactivos y seleccionar la respuesta correcta, si es abierta solo se marca como abierta sin marcar respuesta, ya que el administrador evaluara esta pregunta.
Las preguntas se podrán modificar o eliminar del banco de reactivos en cualquier momento.

###Liga
***
La plataforma está disponible para poder ser usada en la siguiente dirección:
<http://examenesonline.no-ip.org/> 