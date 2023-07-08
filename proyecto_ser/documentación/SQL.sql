

-- Registro, consulta, modificacion y desactivación de personas y usuarios

select * from persona;

select * from usuario where email = "asd" and password = "123" and estado = 1;

select id_usuario, email, rol, usuario.estado, nombres, apellidos, numero_documento, tipo_documento from usuario inner join persona on usuario.id_persona = persona.id_persona;

select id_usuario, email, password, rol, usuario.estado, persona.id_persona, nombres, apellidos, fecha_nacimiento, numero_documento, tipo_documento from usuario inner join persona on usuario.id_persona = persona.id_persona where usuario.id_usuario = 1;

insert into persona 
(nombres, apellidos, fecha_nacimiento, numero_documento, tipo_documento, estado) 
values 
('Andres', 'Ricardo', '31/10/2003', '1000939202', 'cc', 1);
SELECT LAST_INSERT_ID();

insert into usuario
(id_persona, email, password, rol, estado)
values
(1, 'wwandresbeltran@gmail.com', '123', 'Administrador', 1);

update usuario
set email = 'wwandres@gmail.com', password = '1234', rol = 'Contratista', estado = 0
where id_usuario = 1;

update persona
set nombres = 'Ricardo', apellidos = 'Sarta', fecha_nacimiento = '30/10/2003', numero_documento = '1000000', tipo_documento = ' TI', estado = 0
where id_persona = 1;

update usuario
set estado = 0
where id_usuario = 1;



-- Registro, consulta, modificacion y desactivación de categorias

select * from categoria;

select * from categoria where estado = 1;

insert into categoria (nombre, estado) values ('Tecnología', 1);

update categoria
set nombre = 'Lenguaje', estado = 1
where id_categoria = 1;

update categoria
set estado = 0
where id_categoria = 1;



-- Registro, consulta, modificacion y desactivación de servicios

select servicio.id_servicio, servicio.id_categoria, categoria.nombre, servicio.id_persona, persona.nombres, persona.apellidos, servicio.nombre, descripcion, precio, fecha_publicacion, fecha_modificacion, servicio.estado, id_calificacion, porcentaje, fecha, calificacion.estado from servicio inner join categoria on servicio.id_categoria = categoria.id_categoria inner join calificacion on servicio.id_servicio = calificacion.id_servicio inner join persona on servicio.id_persona = persona.id_persona;

select servicio.id_servicio, servicio.id_categoria, categoria.nombre, servicio.id_persona, persona.nombres, persona.apellidos, servicio.nombre, descripcion, precio, fecha_publicacion, fecha_modificacion, servicio.estado, id_calificacion, porcentaje, fecha, calificacion.estado from servicio inner join categoria on servicio.id_categoria = categoria.id_categoria inner join calificacion on servicio.id_servicio = calificacion.id_servicio inner join persona on servicio.id_persona = persona.id_persona where servicio.id_categoria = 1;

select servicio.id_servicio, servicio.id_categoria, categoria.nombre, servicio.id_persona, persona.nombres, persona.apellidos, servicio.nombre, descripcion, precio, fecha_publicacion, fecha_modificacion, servicio.estado, id_calificacion, porcentaje, fecha, calificacion.estado from servicio inner join categoria on servicio.id_categoria = categoria.id_categoria inner join calificacion on servicio.id_servicio = calificacion.id_servicio inner join persona on servicio.id_persona = persona.id_persona where servicio.id_servicio = 1;

select servicio.id_servicio, servicio.id_categoria, categoria.nombre, servicio.id_persona, persona.nombres, persona.apellidos, servicio.nombre, descripcion, precio, fecha_publicacion, fecha_modificacion, servicio.estado, id_calificacion, porcentaje, fecha, calificacion.estado from servicio inner join categoria on servicio.id_categoria = categoria.id_categoria inner join calificacion on servicio.id_servicio = calificacion.id_servicio inner join persona on servicio.id_persona = persona.id_persona where servicio.id_persona = 1;

insert into servicio 
(id_categoria, id_persona, nombre, descripcion, precio, fecha_publicacion, fecha_modificacion, estado)
values
(1, 1, 'Traducción', 'Se traducen textos de español a inglés', 10000, '05/07/2023', '05/07/2023', 1);

update servicio
set id_categoria = 1, id_persona = 1, nombre = 'Desarrollo', descripcion = 'Se desarrollan apps', precio = 50000, fecha_publicacion = '2018-12-25 23:50:55.999', fecha_modificacion = '2018-12-25 23:50:55.999', estado = 0
where id_servicio = 1;

update servicio
set estado = 0, fecha_modificacion = '2019-12-25 23:50:55.999'
where id_servicio = 1;



-- Registro, consulta, modificacion y desactivación de chat

select * from chat;

select id_chat, servicio.nombre, fecha_creacion, chat.estado from chat inner join servicio on chat.id_servicio = servicio.id_servicio;

select id_persona_chat, persona_chat.id_chat, chat.estado, servicio.nombre from persona_chat inner join chat on persona_chat.id_chat = chat.id_chat inner join servicio on chat.id_servicio = servicio.id_servicio where persona_chat.id_persona = 1;

select id_conversacion, conversacion.id_persona, conversacion.id_chat, fecha, mensaje, persona.nombres, servicio.nombre from conversacion inner join persona on conversacion.id_persona = persona.id_persona inner join chat on conversacion.id_chat = chat.id_chat inner join servicio on chat.id_servicio = servicio.id_servicio where conversacion.id_chat = 1;

insert into chat
(id_servicio, fecha_creacion, estado)
values
(1, '2018-12-25 23:50:55.999', 1);

insert into persona_chat
(id_persona, id_chat)
values
(1, 1);

insert into conversacion
(id_persona, id_chat, fecha, mensaje)
values
(1, 1, '2018-12-25 23:50:55.999', 'Hola, como estas?');

update chat
set estado = 2
where id_chat = 1;

update chat
set estado = 3
where id_chat = 1;

delete from conversacion where id_chat = 1;

-- Registro, consulta, modificacion y desactivación de calificacion

select * from calificacion;

select * from calificacion where id_servicio = 1 and estado = 1;
select AVG(porcentaje) from calificacion where id_servicio = 1 and estado = 1;

insert into calificacion
(id_servicio, id_chat, porcentaje, fecha, estado)
values
(1, 1, 100, '2018-12-25 23:50:55.999', 1);

update calificacion
set estado = 0;
where id_calificacion = 1;