CREATE OR REPLACE FUNCTION "ate"."ft_vehiculo_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_vehiculo_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tvehiculo'
 AUTOR:          (admin)
 FECHA:            14-05-2024 15:37:08
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                14-05-2024 15:37:08    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_vehiculo    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_vehiculo_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_VEH_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:37:08
    ***********************************/

    IF (p_transaccion='ATE_VEH_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tvehiculo(
            estado_reg,
            id_propietario,
            tipo,
            marca,
            modelo,
            color,
            placa,
            informacion_adicional,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_propietario,
            v_parametros.tipo,
            v_parametros.marca,
            v_parametros.modelo,
            v_parametros.color,
            v_parametros.placa,
            v_parametros.informacion_adicional,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_vehiculo into v_id_vehiculo;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Vehiculo almacenado(a) con exito (id_vehiculo'||v_id_vehiculo||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_vehiculo',v_id_vehiculo::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_VEH_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:37:08
    ***********************************/

    ELSIF (p_transaccion='ATE_VEH_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tvehiculo SET
            id_propietario = v_parametros.id_propietario,
            tipo = v_parametros.tipo,
            marca = v_parametros.marca,
            modelo = v_parametros.modelo,
            color = v_parametros.color,
            placa = v_parametros.placa,
            informacion_adicional = v_parametros.informacion_adicional,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_vehiculo=v_parametros.id_vehiculo;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Vehiculo modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_vehiculo',v_parametros.id_vehiculo::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_VEH_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:37:08
    ***********************************/

    ELSIF (p_transaccion='ATE_VEH_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tvehiculo
            WHERE id_vehiculo=v_parametros.id_vehiculo;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Vehiculo eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_vehiculo',v_parametros.id_vehiculo::varchar);
              
            --Devuelve la respuesta
            RETURN v_resp;

        END;
         
    ELSE
     
        RAISE EXCEPTION 'Transaccion inexistente: %',p_transaccion;

    END IF;

EXCEPTION
                
    WHEN OTHERS THEN
        v_resp='';
        v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
        v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
        v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
        raise exception '%',v_resp;
                        
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "ate"."ft_vehiculo_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
