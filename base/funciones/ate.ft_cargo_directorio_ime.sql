CREATE OR REPLACE FUNCTION "ate"."ft_cargo_directorio_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_cargo_directorio_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tcargo_directorio'
 AUTOR:          (admin)
 FECHA:            15-05-2024 22:32:10
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                15-05-2024 22:32:10    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_cargo_directorio    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_cargo_directorio_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_CAD_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:32:10
    ***********************************/

    IF (p_transaccion='ATE_CAD_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tcargo_directorio(
            estado_reg,
            cargo,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.cargo,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_cargo_directorio into v_id_cargo_directorio;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Cargo Directorio almacenado(a) con exito (id_cargo_directorio'||v_id_cargo_directorio||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cargo_directorio',v_id_cargo_directorio::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_CAD_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:32:10
    ***********************************/

    ELSIF (p_transaccion='ATE_CAD_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tcargo_directorio SET
            cargo = v_parametros.cargo,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_cargo_directorio=v_parametros.id_cargo_directorio;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Cargo Directorio modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cargo_directorio',v_parametros.id_cargo_directorio::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_CAD_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        15-05-2024 22:32:10
    ***********************************/

    ELSIF (p_transaccion='ATE_CAD_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tcargo_directorio
            WHERE id_cargo_directorio=v_parametros.id_cargo_directorio;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Cargo Directorio eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cargo_directorio',v_parametros.id_cargo_directorio::varchar);
              
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
ALTER FUNCTION "ate"."ft_cargo_directorio_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
