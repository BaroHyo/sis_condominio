CREATE OR REPLACE FUNCTION "ate"."ft_invitados_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_invitados_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tinvitados'
 AUTOR:          (admin)
 FECHA:            21-05-2024 04:12:21
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                21-05-2024 04:12:21    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_invitados    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_invitados_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_INV_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 04:12:21
    ***********************************/

    IF (p_transaccion='ATE_INV_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tinvitados(
            estado_reg,
            id_solicitud,
            revisar,
            nombre,
            ap_paterno,
            ap_materno,
            fecha_nacimiento,
            tipo_documento,
            codigo_documento,
            informacion_adicional,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_solicitud,
            v_parametros.revisar,
            v_parametros.nombre,
            v_parametros.ap_paterno,
            v_parametros.ap_materno,
            v_parametros.fecha_nacimiento,
            v_parametros.tipo_documento,
            v_parametros.codigo_documento,
            v_parametros.informacion_adicional,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_invitados into v_id_invitados;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Invitados almacenado(a) con exito (id_invitados'||v_id_invitados||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_invitados',v_id_invitados::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_INV_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 04:12:21
    ***********************************/

    ELSIF (p_transaccion='ATE_INV_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tinvitados SET
            id_solicitud = v_parametros.id_solicitud,
            revisar = v_parametros.revisar,
            nombre = v_parametros.nombre,
            ap_paterno = v_parametros.ap_paterno,
            ap_materno = v_parametros.ap_materno,
            fecha_nacimiento = v_parametros.fecha_nacimiento,
            tipo_documento = v_parametros.tipo_documento,
            codigo_documento = v_parametros.codigo_documento,
            informacion_adicional = v_parametros.informacion_adicional,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_invitados=v_parametros.id_invitados;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Invitados modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_invitados',v_parametros.id_invitados::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_INV_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 04:12:21
    ***********************************/

    ELSIF (p_transaccion='ATE_INV_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tinvitados
            WHERE id_invitados=v_parametros.id_invitados;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Invitados eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_invitados',v_parametros.id_invitados::varchar);
              
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
ALTER FUNCTION "ate"."ft_invitados_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
