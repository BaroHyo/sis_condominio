CREATE OR REPLACE FUNCTION "ate"."ft_contactos_propietario_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_contactos_propietario_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tcontactos_propietario'
 AUTOR:          (admin)
 FECHA:            27-05-2024 01:45:45
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                27-05-2024 01:45:45    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_contactos_propietario    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_contactos_propietario_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_CNP_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:45:45
    ***********************************/

    IF (p_transaccion='ATE_CNP_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tcontactos_propietario(
            estado_reg,
            id_propietario,
            tipo,
            contacto,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_propietario,
            v_parametros.tipo,
            v_parametros.contacto,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_contactos_propietario into v_id_contactos_propietario;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Contactos Propietario almacenado(a) con exito (id_contactos_propietario'||v_id_contactos_propietario||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_contactos_propietario',v_id_contactos_propietario::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_CNP_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:45:45
    ***********************************/

    ELSIF (p_transaccion='ATE_CNP_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tcontactos_propietario SET
            id_propietario = v_parametros.id_propietario,
            tipo = v_parametros.tipo,
            contacto = v_parametros.contacto,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_contactos_propietario=v_parametros.id_contactos_propietario;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Contactos Propietario modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_contactos_propietario',v_parametros.id_contactos_propietario::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_CNP_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:45:45
    ***********************************/

    ELSIF (p_transaccion='ATE_CNP_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tcontactos_propietario
            WHERE id_contactos_propietario=v_parametros.id_contactos_propietario;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Contactos Propietario eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_contactos_propietario',v_parametros.id_contactos_propietario::varchar);
              
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
ALTER FUNCTION "ate"."ft_contactos_propietario_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
