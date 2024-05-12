CREATE OR REPLACE FUNCTION "ate"."ft_areas_comunes_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_areas_comunes_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tareas_comunes'
 AUTOR:          (admin)
 FECHA:            12-05-2024 03:48:04
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                12-05-2024 03:48:04    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_areas_comunes    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_areas_comunes_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_ARE_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 03:48:04
    ***********************************/

    IF (p_transaccion='ATE_ARE_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tareas_comunes(
            estado_reg,
            id_condominio,
            nombre,
            descripcion,
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
            v_parametros.descripcion,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_areas_comunes into v_id_areas_comunes;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Areas Comunes almacenado(a) con exito (id_areas_comunes'||v_id_areas_comunes||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_areas_comunes',v_id_areas_comunes::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_ARE_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 03:48:04
    ***********************************/

    ELSIF (p_transaccion='ATE_ARE_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tareas_comunes SET
            id_condominio = v_parametros.id_condominio,
            nombre = v_parametros.nombre,
            descripcion = v_parametros.descripcion,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_areas_comunes=v_parametros.id_areas_comunes;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Areas Comunes modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_areas_comunes',v_parametros.id_areas_comunes::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_ARE_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        12-05-2024 03:48:04
    ***********************************/

    ELSIF (p_transaccion='ATE_ARE_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tareas_comunes
            WHERE id_areas_comunes=v_parametros.id_areas_comunes;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Areas Comunes eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_areas_comunes',v_parametros.id_areas_comunes::varchar);
              
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
ALTER FUNCTION "ate"."ft_areas_comunes_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
