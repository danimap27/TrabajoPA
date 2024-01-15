# Sistema de Tickets de Soporte

## Introducción

Este proyecto de Sistema de Tickets de Soporte es desarrollado por Daniel Martín Pérez y Pablo Vilchez Rivas. La aplicación tiene como objetivo ofrecer a las empresas una herramienta integral para gestionar eficientemente las solicitudes y problemas de los clientes, mejorando así la experiencia del cliente y la eficiencia operativa.

## Usuarios de Prueba

Se proporciona un archivo llamado `login.txt` que contiene información sobre usuarios de prueba, incluyendo sus correos electrónicos y contraseñas. Este archivo facilita la autenticación en la aplicación durante las fases de desarrollo y prueba.

## Inicio del Proyecto

El punto de inicio del proyecto se encuentra en la página de inicio de sesión (`login/login.php`). Desde esta página, los usuarios pueden acceder al sistema utilizando sus credenciales.

---
## Matriz CRUD
| Rol              | Clientes                                    | Agentes                                      | Administradores                              |
|------------------|---------------------------------------------|----------------------------------------------|-----------------------------------------------|
| Clientes         | CRUD (Listar y Actualizar Propia Info)      | No aplica                                    | No aplica                                     |
| Agentes          | CRUD (Listar y Actualizar Propia Info)      | CRUD (Listar y Actualizar Propia Info)      | CRUD (Listar, Leer, Crear, Actualizar, Eliminar) |
| Administradores  | CRUD (Listar, Crear, Actualizar, Eliminar)  | CRUD (Listar, Crear, Actualizar, Eliminar)  | CRUD (Listar, Leer, Crear, Actualizar, Eliminar) |

---
## Contenido del Repositorio

El repositorio está estructurado de la siguiente manera:

- `login/`: Contiene los archivos relacionados con el inicio de sesión.
- `tickets/`: Incluye los archivos para la gestión de tickets.
- `agentes/`: Contiene archivos específicos para la administración de agentes.
- `clientes/`: Archivos relacionados con la gestión de clientes.

---
# Descripción de Uso del Sistema

El Sistema de Tickets de Soporte es una plataforma diseñada para simplificar y mejorar la gestión de solicitudes y problemas de clientes en entornos empresariales. A continuación, se proporciona una descripción detallada del uso del sistema:

## Inicio de Sesión

1. Accede a la página de inicio de sesión (`login/login.php`).
2. Utiliza las credenciales de prueba proporcionadas en `login.txt` o crea una cuenta.

## Interfaz Principal

### Agente

#### Gestión de Clientes

1. Después de iniciar sesión como agente, serás redirigido a la página principal del agente (`agentes/adminAgente.php`).
2. En esta página, se muestra una lista de clientes asignados al agente actual.
3. Para cada cliente, se muestran los tickets asociados.

#### Actualización de Prioridad y Estado de Tickets

1. Dentro de la sección de tickets para cada cliente, encontrarás un botón de "Actualizar" para cada ticket.
2. Al hacer clic en "Actualizar", podrás cambiar la prioridad y el estado del ticket.

### Cliente

#### Creación de Tickets

1. Después de iniciar sesión como cliente, serás redirigido a la página principal del cliente (`clientes/indexCliente.php`).
2. En esta página, puedes crear nuevos tickets proporcionando la información requerida.

#### Seguimiento de Tickets

1. El cliente puede ver una lista de sus tickets en la página principal.
2. Se muestra información relevante sobre cada ticket, como el estado y la prioridad.

### Administración de Agentes

#### Admin

1. La administración de agentes se realiza a través de la página principal de administración (`agentes/adminIndex.php`).
2. En esta página, se presenta una lista de todos los agentes registrados.
3. Puedes editar o eliminar agentes según sea necesario.

#### Edición y Eliminación de Agentes

1. Desde la página de administración de agentes, puedes hacer clic en "Editar" para modificar la información del agente.
2. También puedes hacer clic en "Eliminar" para eliminar al agente de forma permanente.

### Administración de Clientes

#### Admin

1. La administración de clientes se realiza a través de la página principal de administración (`clientes/adminClientes.php`).
2. En esta página, se presenta una lista de todos los clientes registrados.
3. Puedes editar o eliminar clientes según sea necesario.

#### Edición y Eliminación de Clientes

1. Desde la página de administración de clientes, puedes hacer clic en "Editar" para modificar la información del cliente.
2. También puedes hacer clic en "Eliminar" para eliminar al cliente de forma permanente.

### Administración de Tickets

#### Admin

1. La administración de tickets se realiza a través de la página principal de administración (`tickets/adminTickets.php`).
2. En esta página, se presenta una lista de todos los tickets registrados.
3. Puedes editar o eliminar tickets según sea necesario.

#### Edición y Eliminación de Tickets

1. Desde la página de administración de tickets, puedes hacer clic en "Editar" para modificar la información del ticket.
2. También puedes hacer clic en "Eliminar" para eliminar el ticket de forma permanente.

## Actualización de Prioridad y Estado de Tickets

1. Dentro de la sección de administración de tickets, encontrarás un botón de "Actualizar" para cada ticket.
2. Al hacer clic en "Actualizar", podrás cambiar la prioridad y el estado del ticket.

## Consideraciones Importantes

- Asegúrate de utilizar la información de prueba proporcionada para evitar posibles problemas de autenticación.
- Si tienes problemas técnicos o detectas errores, por favor, informa a los desarrolladores para su corrección.

Este sistema busca mejorar la eficiencia operativa y la satisfacción del cliente al proporcionar una herramienta fácil de usar para la gestión de tickets de soporte. ¡Gracias por utilizar nuestro Sistema de Tickets de Soporte!
