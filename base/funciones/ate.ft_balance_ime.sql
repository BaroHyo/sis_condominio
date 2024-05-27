CREATE OR REPLACE FUNCTION "ate"."ft_balance_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_balance_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.tbalance'
 AUTOR:          (admin)
 FECHA:            27-05-2024 01:47:12
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                27-05-2024 01:47:12    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_balance    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_balance_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_BAL_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:47:12
    ***********************************/

    IF (p_transaccion='ATE_BAL_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.tbalance(
            estado_reg,
            id_condominio,
            id_moneda,
            total_ingresos,
            total_egresos,
            balance_neto,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_condominio,
            v_parametros.id_moneda,
            v_parametros.total_ingresos,
            v_parametros.total_egresos,
            v_parametros.balance_neto,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_balance into v_id_balance;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Balance almacenado(a) con exito (id_balance'||v_id_balance||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_balance',v_id_balance::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_BAL_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:47:12
    ***********************************/

    ELSIF (p_transaccion='ATE_BAL_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.tbalance SET
            id_condominio = v_parametros.id_condominio,
            id_moneda = v_parametros.id_moneda,
            total_ingresos = v_parametros.total_ingresos,
            total_egresos = v_parametros.total_egresos,
            balance_neto = v_parametros.balance_neto,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_balance=v_parametros.id_balance;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Balance modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_balance',v_parametros.id_balance::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_BAL_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:47:12
    ***********************************/

    ELSIF (p_transaccion='ATE_BAL_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.tbalance
            WHERE id_balance=v_parametros.id_balance;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Balance eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_balance',v_parametros.id_balance::varchar);
              
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
ALTER FUNCTION "ate"."ft_balance_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
