CREATE OR REPLACE FUNCTION "ate"."ft_solicitud_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_solicitud_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tsolicitud'
 AUTOR:          (admin)
 FECHA:            15-05-2024 22:06:23
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                15-05-2024 22:06:23    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_solicitud    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_solicitud_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_SOA_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:06:23
    ***********************************/

    IF (p_transaccion='ATE_SOA_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tsolicitud(
            estado_reg,
            id_propietario,
            fecha,
            estado,
            nro_tramite,
            id_proceso_wf,
            id_estado_wf,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_propietario,
            v_parametros.fecha,
            v_parametros.estado,
            v_parametros.nro_tramite,
            v_parametros.id_proceso_wf,
            v_parametros.id_estado_wf,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_solicitud into v_id_solicitud;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Solicitud almacenado(a) con exito (id_solicitud'||v_id_solicitud||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_solicitud',v_id_solicitud::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_SOA_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:06:23
    ***********************************/

    ELSIF (p_transaccion='ATE_SOA_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tsolicitud SET
            id_propietario = v_parametros.id_propietario,
            fecha = v_parametros.fecha,
            estado = v_parametros.estado,
            nro_tramite = v_parametros.nro_tramite,
            id_proceso_wf = v_parametros.id_proceso_wf,
            id_estado_wf = v_parametros.id_estado_wf,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_solicitud=v_parametros.id_solicitud;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Solicitud modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_solicitud',v_parametros.id_solicitud::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_SOA_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:06:23
    ***********************************/

    ELSIF (p_transaccion='ATE_SOA_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tsolicitud
            WHERE id_solicitud=v_parametros.id_solicitud;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Solicitud eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_solicitud',v_parametros.id_solicitud::varchar);
              
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
ALTER FUNCTION "ate"."ft_solicitud_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
