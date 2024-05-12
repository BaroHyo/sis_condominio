CREATE OR REPLACE FUNCTION "ate"."ft_condominio_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_condominio_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tcondominio'
 AUTOR:          (admin)
 FECHA:            12-05-2024 03:10:00
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                12-05-2024 03:10:00    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_condominio    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_condominio_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_CON_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 03:10:00
    ***********************************/

    IF (p_transaccion='ATE_CON_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tcondominio(
            estado_reg,
            id_lugar,
            codigo,
            nombre,
            direccion,
            informacion_adicional,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_lugar,
            v_parametros.codigo,
            v_parametros.nombre,
            v_parametros.direccion,
            v_parametros.informacion_adicional,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_condominio into v_id_condominio;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Condominio almacenado(a) con exito (id_condominio'||v_id_condominio||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_condominio',v_id_condominio::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_CON_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 03:10:00
    ***********************************/

    ELSIF (p_transaccion='ATE_CON_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tcondominio SET
            id_lugar = v_parametros.id_lugar,
            codigo = v_parametros.codigo,
            nombre = v_parametros.nombre,
            direccion = v_parametros.direccion,
            informacion_adicional = v_parametros.informacion_adicional,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_condominio=v_parametros.id_condominio;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Condominio modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_condominio',v_parametros.id_condominio::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_CON_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 03:10:00
    ***********************************/

    ELSIF (p_transaccion='ATE_CON_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tcondominio
            WHERE id_condominio=v_parametros.id_condominio;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Condominio eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_condominio',v_parametros.id_condominio::varchar);
              
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
ALTER FUNCTION "ate"."ft_condominio_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
