CREATE OR REPLACE FUNCTION "ate"."ft_propietario_sel"(    
                p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:        Atenea
 FUNCION:         ate.ft_propietario_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'ate.tpropietario'
 AUTOR:          (admin)
 FECHA:            14-05-2024 15:32:39
 COMENTARIOS:    
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #0                14-05-2024 15:32:39    admin             Creacion    
 #
 ***************************************************************************/

DECLARE

    v_consulta            VARCHAR;
    v_parametros          RECORD;
    v_nombre_funcion      TEXT;
    v_resp                VARCHAR;
                
BEGIN

    v_nombre_funcion = 'ate.ft_propietario_sel';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************    
     #TRANSACCION:  'ATE_PRO_SEL'
     #DESCRIPCION:    Consulta de datos
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:32:39
    ***********************************/

    IF (p_transaccion='ATE_PRO_SEL') THEN
                     
        BEGIN
            --Sentencia de la consulta
            v_consulta:='SELECT
                        pro.id_propietario,
                        pro.estado_reg,
                        pro.id_persona,
                        pro.id_condominio,
                        pro.codigo,
                        pro.fecha_desde,
                        pro.fecha_hasta,
                        pro.id_usuario_reg,
                        pro.fecha_reg,
                        pro.id_usuario_ai,
                        pro.usuario_ai,
                        pro.id_usuario_mod,
                        pro.fecha_mod,
                        usu1.cuenta as usr_reg,
                        usu2.cuenta as usr_mod    
                        FROM ate.tpropietario pro
                        JOIN segu.tusuario usu1 ON usu1.id_usuario = pro.id_usuario_reg
                        LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = pro.id_usuario_mod
                        WHERE  ';
            
            --Definicion de la respuesta
            v_consulta:=v_consulta||v_parametros.filtro;
            v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

            --Devuelve la respuesta
            RETURN v_consulta;
                        
        END;

    /*********************************    
     #TRANSACCION:  'ATE_PRO_CONT'
     #DESCRIPCION:    Conteo de registros
     #AUTOR:        admin    
     #FECHA:        14-05-2024 15:32:39
    ***********************************/

    ELSIF (p_transaccion='ATE_PRO_CONT') THEN

        BEGIN
            --Sentencia de la consulta de conteo de registros
            v_consulta:='SELECT COUNT(id_propietario)
                         FROM ate.tpropietario pro
                         JOIN segu.tusuario usu1 ON usu1.id_usuario = pro.id_usuario_reg
                         LEFT JOIN segu.tusuario usu2 ON usu2.id_usuario = pro.id_usuario_mod
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
ALTER FUNCTION "ate"."ft_propietario_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
