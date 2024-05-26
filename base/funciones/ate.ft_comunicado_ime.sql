CREATE OR REPLACE FUNCTION "ate"."ft_comunicado_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_comunicado_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tcomunicado'
 AUTOR:          (admin)
 FECHA:            21-05-2024 05:16:20
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                21-05-2024 05:16:20    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_comunicado    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_comunicado_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_COM_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 05:16:20
    ***********************************/

    IF (p_transaccion='ATE_COM_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tcomunicado(
            estado_reg,
            id_condominio,
            asunto,
            contenido,
            estado,
            fecha,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_condominio,
            v_parametros.asunto,
            v_parametros.contenido,
            v_parametros.estado,
            v_parametros.fecha,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_comunicado into v_id_comunicado;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Comunicado almacenado(a) con exito (id_comunicado'||v_id_comunicado||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_comunicado',v_id_comunicado::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_COM_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 05:16:20
    ***********************************/

    ELSIF (p_transaccion='ATE_COM_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tcomunicado SET
            id_condominio = v_parametros.id_condominio,
            asunto = v_parametros.asunto,
            contenido = v_parametros.contenido,
            estado = v_parametros.estado,
            fecha = v_parametros.fecha,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_comunicado=v_parametros.id_comunicado;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Comunicado modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_comunicado',v_parametros.id_comunicado::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_COM_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        21-05-2024 05:16:20
    ***********************************/

    ELSIF (p_transaccion='ATE_COM_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tcomunicado
            WHERE id_comunicado=v_parametros.id_comunicado;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Comunicado eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_comunicado',v_parametros.id_comunicado::varchar);
              
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
ALTER FUNCTION "ate"."ft_comunicado_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
