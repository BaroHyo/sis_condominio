CREATE OR REPLACE FUNCTION "ate"."ft_mascota_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_mascota_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tmascota'
 AUTOR:          (admin)
 FECHA:            14-05-2024 15:34:01
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                14-05-2024 15:34:01    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_mascota    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_mascota_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_MAS_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:34:01
    ***********************************/

    IF (p_transaccion='ATE_MAS_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tmascota(
            estado_reg,
            id_propietario,
            nombre,
            id_especie,
            raza,
            genero,
            informacion_adicional,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_propietario,
            v_parametros.nombre,
            v_parametros.id_especie,
            v_parametros.raza,
            v_parametros.genero,
            v_parametros.informacion_adicional,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_mascota into v_id_mascota;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mascota almacenado(a) con exito (id_mascota'||v_id_mascota||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mascota',v_id_mascota::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_MAS_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:34:01
    ***********************************/

    ELSIF (p_transaccion='ATE_MAS_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tmascota SET
            id_propietario = v_parametros.id_propietario,
            nombre = v_parametros.nombre,
            id_especie = v_parametros.id_especie,
            raza = v_parametros.raza,
            genero = v_parametros.genero,
            informacion_adicional = v_parametros.informacion_adicional,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_mascota=v_parametros.id_mascota;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mascota modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mascota',v_parametros.id_mascota::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_MAS_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:34:01
    ***********************************/

    ELSIF (p_transaccion='ATE_MAS_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tmascota
            WHERE id_mascota=v_parametros.id_mascota;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Mascota eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_mascota',v_parametros.id_mascota::varchar);
              
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
ALTER FUNCTION "ate"."ft_mascota_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
