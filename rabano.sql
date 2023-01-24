select descripcion from tipo_entidad
 where in_clasificacion_ent in ('CNT','ALM','LOC') and
       nu_tipo_entidad > 0