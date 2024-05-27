CREATE OR REPLACE FUNCTION "ate"."ft_transacciones_ime" (    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$

/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_transacciones_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'ate.ttransacciones'
 AUTOR:          (admin)
 FECHA:            27-05-2024 01:46:33
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                27-05-2024 01:46:33    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        INTEGER;
    v_parametros               RECORD;
    v_id_requerimiento         INTEGER;
    v_resp                     VARCHAR;
    v_nombre_funcion           TEXT;
    v_mensaje_error            TEXT;
    v_id_transacciones    INTEGER;
                
BEGIN

    v_nombre_funcion = 'ate.ft_transacciones_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_TRA_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:46:33
    ***********************************/

    IF (p_transaccion='ATE_TRA_INS') THEN
                    
        BEGIN
            --Sentencia de la insercion
            INSERT INTO ate.ttransacciones(
            estado_reg,
            id_condominio,
            id_plan_cuenta_at,
            id_moneda,
            tipo,
            monto,
            concepto,
            id_usuario_reg,
            fecha_reg,
            id_usuario_ai,
            usuario_ai,
            id_usuario_mod,
            fecha_mod
              ) VALUES (
            'activo',
            v_parametros.id_condominio,
            v_parametros.id_plan_cuenta_at,
            v_parametros.id_moneda,
            v_parametros.tipo,
            v_parametros.monto,
            v_parametros.concepto,
            p_id_usuario,
            now(),
            v_parametros._id_usuario_ai,
            v_parametros._nombre_usuario_ai,
            null,
            null            
            ) RETURNING id_transacciones into v_id_transacciones;
            
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Transacciones almacenado(a) con exito (id_transacciones'||v_id_transacciones||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_transacciones',v_id_transacciones::varchar);

            --Devuelve la respuesta
            RETURN v_resp;

        END;

    /*********************************    
     #TRANSACCION:  'ATE_TRA_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:46:33
    ***********************************/

    ELSIF (p_transaccion='ATE_TRA_MOD') THEN

        BEGIN
            --Sentencia de la modificacion
            UPDATE ate.ttransacciones SET
            id_condominio = v_parametros.id_condominio,
            id_plan_cuenta_at = v_parametros.id_plan_cuenta_at,
            id_moneda = v_parametros.id_moneda,
            tipo = v_parametros.tipo,
            monto = v_parametros.monto,
            concepto = v_parametros.concepto,
            id_usuario_mod = p_id_usuario,
            fecha_mod = now(),
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            WHERE id_transacciones=v_parametros.id_transacciones;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Transacciones modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_transacciones',v_parametros.id_transacciones::varchar);
               
            --Devuelve la respuesta
            RETURN v_resp;
            
        END;

    /*********************************    
     #TRANSACCION:  'ATE_TRA_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:46:33
    ***********************************/

    ELSIF (p_transaccion='ATE_TRA_ELI') THEN

        BEGIN
            --Sentencia de la eliminacion
            DELETE FROM ate.ttransacciones
            WHERE id_transacciones=v_parametros.id_transacciones;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Transacciones eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_transacciones',v_parametros.id_transacciones::varchar);
              
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
ALTER FUNCTION "ate"."ft_transacciones_ime"(integer, integer, character varying, character varying) OWNER TO postgres;
