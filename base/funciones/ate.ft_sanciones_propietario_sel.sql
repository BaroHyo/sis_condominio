CREATE OR REPLACE FUNCTION "ate"."ft_sanciones_propietario_sel"(    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_sanciones_propietario_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'ate.tsanciones_propietario'
 AUTOR:          (admin)
 FECHA:            27-05-2024 01:48:15
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                27-05-2024 01:48:15    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_consulta            VARCHAR;
    v_parametros          RECORD;
    v_nombre_funcion      TEXT;
    v_resp                VARCHAR;
                
BEGIN

    v_nombre_funcion = 'ate.ft_sanciones_propietario_sel';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_SAP_SEL'
     #DESCRIPCION:    Consulta de datos
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:48:15
    ***********************************/

    IF (p_transaccion='ATE_SAP_SEL') THEN
                     
        BEGIN
            --Sentencia de la consulta
            v_consulta:='SELECT
                        sap.id_sanciones_propietario,
                        sap.estado_reg,
                        sap.id_propietario,
                        sap.id_sancion,
                        sap.fecha,
                        sap.justificacion,
                        sap.importe,
                        sap.id_moneda,
                        sap.estado,
                        sap.id_usuario_reg,
                        sap.fecha_reg,
                        sap.id_usuario_ai,
                        sap.usuario_ai,
                        sap.id_usuario_mod,
                        sap.fecha_mod,
                        usu1.cuenta as usr_reg,
                        usu2.cuenta as usr_mod    
                        FROM ate.tsanciones_propietario sap
                        JOIN segu.tusuario usu1 ON usu1.id_usuario = sap.id_usuario_reg
                        LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = sap.id_usuario_mod
                        WHERE  ';
            
            --Definicion de la respuesta
            v_consulta:=v_consulta||v_parametros.filtro;
            v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

            --Devuelve la respuesta
            RETURN v_consulta;
                        
        END;

    /*********************************    
     #TRANSACCION:  'ATE_SAP_CONT'
     #DESCRIPCION:    Conteo de registros
     #AUTOR:        admin    
     #FECHA:        27-05-2024 01:48:15
    ***********************************/

    ELSIF (p_transaccion='ATE_SAP_CONT') THEN

        BEGIN
            --Sentencia de la consulta de conteo de registros
            v_consulta:='SELECT COUNT(id_sanciones_propietario)
                         FROM ate.tsanciones_propietario sap
                         JOIN segu.tusuario usu1 ON usu1.id_usuario = sap.id_usuario_reg
                         LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = sap.id_usuario_mod
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
ALTER FUNCTION "ate"."ft_sanciones_propietario_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
