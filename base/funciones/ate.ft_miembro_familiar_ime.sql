CREATE OR REPLACE FUNCTION "ate"."ft_miembro_familiar_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_miembro_familiar_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tmiembro_familiar'
 AUTOR:          (admin)
 FECHA:            14-05-2024 15:36:36
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                14-05-2024 15:36:36    admin             Creacion    
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

    v_nombre_funcion = 'ate.ft_miembro_familiar_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_MIE_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:36:36
    ***********************************/

    IF (p_transaccion='ATE_MIE_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tmiembro_familiar(
            estado_reg,
            id_propietario,
            id_tipo_relacion,
            nombre,
            apellido_paterno,
            apellido_materno,
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
            v_parametros.id_tipo_relacion,
            v_parametros.nombre,
            v_parametros.apellido_paterno,
            v_parametros.apellido_materno,
            v_parametros.informacion_adicional,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_vehiculo into v_id_vehiculo;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Miembro Familiar almacenado(a) con exito (id_vehiculo'||v_id_vehiculo||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_vehiculo',v_id_vehiculo::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_MIE_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:36:36
    ***********************************/

    ELSIF (p_transaccion='ATE_MIE_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tmiembro_familiar SET
            id_propietario = v_parametros.id_propietario,
            id_tipo_relacion = v_parametros.id_tipo_relacion,
            nombre = v_parametros.nombre,
            apellido_paterno = v_parametros.apellido_paterno,
            apellido_materno = v_parametros.apellido_materno,
            informacion_adicional = v_parametros.informacion_adicional,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_vehiculo=v_parametros.id_vehiculo;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Miembro Familiar modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_vehiculo',v_parametros.id_vehiculo::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_MIE_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:36:36
    ***********************************/

    ELSIF (p_transaccion='ATE_MIE_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tmiembro_familiar
            WHERE id_vehiculo=v_parametros.id_vehiculo;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Miembro Familiar eliminado(a)'); 
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
ALTER FUNCTION "ate"."ft_miembro_familiar_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
