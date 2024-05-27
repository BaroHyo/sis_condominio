CREATE OR REPLACE FUNCTION "ate"."ft_transacciones_sel"(    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_transacciones_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'ate.ttransacciones'
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

    v_consulta            VARCHAR;
    v_parametros          RECORD;
    v_nombre_funcion      TEXT;
    v_resp                VARCHAR;
                
BEGIN

    v_nombre_funcion = 'ate.ft_transacciones_sel';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_TRA_SEL'
     #DESCRIPCION:    Consulta de datos
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:46:33
    ***********************************/

    IF (p_transaccion='ATE_TRA_SEL') THEN
                     
        BEGIN
            --Sentencia de la consulta
            v_consulta:='SELECT
                        tra.id_transacciones,
                        tra.estado_reg,
                        tra.id_condominio,
                        tra.id_plan_cuenta_at,
                        tra.id_moneda,
                        tra.tipo,
                        tra.monto,
                        tra.concepto,
                        tra.id_usuario_reg,
                        tra.fecha_reg,
                        tra.id_usuario_ai,
                        tra.usuario_ai,
                        tra.id_usuario_mod,
                        tra.fecha_mod,
                        usu1.cuenta as usr_reg,
                        usu2.cuenta as usr_mod    
                        FROM ate.ttransacciones tra
                        JOIN segu.tusuario usu1 ON usu1.id_usuario = tra.id_usuario_reg
                        LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = tra.id_usuario_mod
                        WHERE  ';
            
            --Definicion de la respuesta
            v_consulta:=v_consulta||v_parametros.filtro;
            v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

            --Devuelve la respuesta
            RETURN v_consulta;
                        
        END;

    /*********************************    
     #TRANSACCION:  'ATE_TRA_CONT'
     #DESCRIPCION:    Conteo de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:46:33
    ***********************************/

    ELSIF (p_transaccion='ATE_TRA_CONT') THEN

        BEGIN
            --Sentencia de la consulta de conteo de registros
            v_consulta:='SELECT COUNT(id_transacciones)
                         FROM ate.ttransacciones tra
                         JOIN segu.tusuario usu1 ON usu1.id_usuario = tra.id_usuario_reg
                         LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = tra.id_usuario_mod
                         WHERE ';
            
            --Definicion de la respuesta            
            v_consulta:=v_consulta||v_parametros.filtro;

            --Devuelve la respuesta
            RETURN v_consulta;

        END;
                    
    ELSE
                         
        RAISE EXCEPTION 'Transaccion inexistente';
                             
    END IF;
                    
EXCEPTION
                    
    WHEN OTHERS THEN
            v_resp='';
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
            v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
            v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
            RAISE EXCEPTION '%',v_resp;
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "ate"."ft_transacciones_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
