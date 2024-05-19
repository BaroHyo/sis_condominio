CREATE OR REPLACE FUNCTION "ate"."ft_directorio_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_directorio_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tdirectorio'
 AUTOR:          (admin)
 FECHA:            15-05-2024 22:33:12
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                15-05-2024 22:33:12    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_directorio    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_directorio_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_DIR_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:33:12
    ***********************************/

    IF (p_transaccion='ATE_DIR_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tdirectorio(
            estado_reg,
            id_condominio,
            id_cargo_directorio,
            id_propietario,
            fecha_desde,
            fecha_hasta,
            estado,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_condominio,
            v_parametros.id_cargo_directorio,
            v_parametros.id_propietario,
            v_parametros.fecha_desde,
            v_parametros.fecha_hasta,
            v_parametros.estado,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_directorio into v_id_directorio;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Directorio almacenado(a) con exito (id_directorio'||v_id_directorio||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_directorio',v_id_directorio::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_DIR_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:33:12
    ***********************************/

    ELSIF (p_transaccion='ATE_DIR_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tdirectorio SET
            id_condominio = v_parametros.id_condominio,
            id_cargo_directorio = v_parametros.id_cargo_directorio,
            id_propietario = v_parametros.id_propietario,
            fecha_desde = v_parametros.fecha_desde,
            fecha_hasta = v_parametros.fecha_hasta,
            estado = v_parametros.estado,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_directorio=v_parametros.id_directorio;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Directorio modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_directorio',v_parametros.id_directorio::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_DIR_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:33:12
    ***********************************/

    ELSIF (p_transaccion='ATE_DIR_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tdirectorio
            WHERE id_directorio=v_parametros.id_directorio;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Directorio eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_directorio',v_parametros.id_directorio::varchar);
              
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
ALTER FUNCTION "ate"."ft_directorio_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
