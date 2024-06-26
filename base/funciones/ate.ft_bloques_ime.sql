CREATE OR REPLACE FUNCTION "ate"."ft_bloques_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_bloques_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tbloques'
 AUTOR:          (admin)
 FECHA:            12-05-2024 17:24:28
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                12-05-2024 17:24:28    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_bloques    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_bloques_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_BLO_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 17:24:28
    ***********************************/

    IF (p_transaccion='ATE_BLO_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tbloques(
            estado_reg,
            id_condominio,
            nombre,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_condominio,
            v_parametros.nombre,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_bloques into v_id_bloques;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Bloques almacenado(a) con exito (id_bloques'||v_id_bloques||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_bloques',v_id_bloques::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_BLO_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 17:24:28
    ***********************************/

    ELSIF (p_transaccion='ATE_BLO_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tbloques SET
            id_condominio = v_parametros.id_condominio,
            nombre = v_parametros.nombre,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_bloques=v_parametros.id_bloques;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Bloques modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_bloques',v_parametros.id_bloques::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_BLO_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 17:24:28
    ***********************************/

    ELSIF (p_transaccion='ATE_BLO_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tbloques
            WHERE id_bloques=v_parametros.id_bloques;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Bloques eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_bloques',v_parametros.id_bloques::varchar);
              
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
ALTER FUNCTION "ate"."ft_bloques_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
