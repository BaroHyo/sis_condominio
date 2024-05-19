CREATE OR REPLACE FUNCTION "ate"."ft_solicitud_detalle_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_solicitud_detalle_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tsolicitud_detalle'
 AUTOR:          (admin)
 FECHA:            15-05-2024 22:30:44
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                15-05-2024 22:30:44    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_solicitud_detalle    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_solicitud_detalle_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_DTS_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:30:44
    ***********************************/

    IF (p_transaccion='ATE_DTS_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tsolicitud_detalle(
            estado_reg,
            id_solicitud,
            id_areas_comunes,
            hr_desde,
            hr_hasta,
            importer,
            justificativo,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_solicitud,
            v_parametros.id_areas_comunes,
            v_parametros.hr_desde,
            v_parametros.hr_hasta,
            v_parametros.importer,
            v_parametros.justificativo,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_solicitud_detalle into v_id_solicitud_detalle;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Solicitud Detalle almacenado(a) con exito (id_solicitud_detalle'||v_id_solicitud_detalle||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_solicitud_detalle',v_id_solicitud_detalle::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_DTS_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:30:44
    ***********************************/

    ELSIF (p_transaccion='ATE_DTS_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tsolicitud_detalle SET
            id_solicitud = v_parametros.id_solicitud,
            id_areas_comunes = v_parametros.id_areas_comunes,
            hr_desde = v_parametros.hr_desde,
            hr_hasta = v_parametros.hr_hasta,
            importer = v_parametros.importer,
            justificativo = v_parametros.justificativo,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_solicitud_detalle=v_parametros.id_solicitud_detalle;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Solicitud Detalle modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_solicitud_detalle',v_parametros.id_solicitud_detalle::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_DTS_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:30:44
    ***********************************/

    ELSIF (p_transaccion='ATE_DTS_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tsolicitud_detalle
            WHERE id_solicitud_detalle=v_parametros.id_solicitud_detalle;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Solicitud Detalle eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_solicitud_detalle',v_parametros.id_solicitud_detalle::varchar);
              
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
ALTER FUNCTION "ate"."ft_solicitud_detalle_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
