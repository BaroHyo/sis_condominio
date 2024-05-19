CREATE OR REPLACE FUNCTION "ate"."ft_pisos_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_pisos_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tpisos'
 AUTOR:          (admin)
 FECHA:            12-05-2024 17:24:36
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                12-05-2024 17:24:36    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_pisos    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_pisos_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_PIS_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 17:24:36
    ***********************************/

    IF (p_transaccion='ATE_PIS_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tpisos(
            estado_reg,
            id_bloques,
            id_condominio,
            numero_piso,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_bloques,
            v_parametros.id_condominio,
            v_parametros.numero_piso,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_pisos into v_id_pisos;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Pisos almacenado(a) con exito (id_pisos'||v_id_pisos||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_pisos',v_id_pisos::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_PIS_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 17:24:36
    ***********************************/

    ELSIF (p_transaccion='ATE_PIS_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tpisos SET
            id_bloques = v_parametros.id_bloques,
            id_condominio = v_parametros.id_condominio,
            numero_piso = v_parametros.numero_piso,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_pisos=v_parametros.id_pisos;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Pisos modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_pisos',v_parametros.id_pisos::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_PIS_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 17:24:36
    ***********************************/

    ELSIF (p_transaccion='ATE_PIS_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tpisos
            WHERE id_pisos=v_parametros.id_pisos;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Pisos eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_pisos',v_parametros.id_pisos::varchar);
              
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
ALTER FUNCTION "ate"."ft_pisos_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
