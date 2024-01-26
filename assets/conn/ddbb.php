<?php
class db
{
    public static $mysqli;
    private $registros = 0;
    public $id_panel;

    function __construct($id_panel)
    {
        $this->id_panel = 0;
        if (!isset(db::$mysqli[$this->id_panel])) {
            db::$mysqli[$this->id_panel] = mysqli_connect('www.tpv-e.es', 'tpv_e_0es', '*W218ia32;wA', 'tpv_e_0es');
        }
        if (mysqli_connect_errno()) {
            die('No se ha podido connectar.');
        }
        if(!empty($id_panel) && !isset(db::$mysqli[$id_panel])) {
            $datos = $this->query("SELECT dominio_base, base, usuario_base, password_base from identificacion_panel WHERE id=" . $id_panel . " AND bloqueado=0 LIMIT 1");

            $this->id_panel = $id_panel;
            db::$mysqli[$this->id_panel]= mysqli_connect($datos[0]['dominio_base'], $datos[0]['usuario_base'], $datos[0]['password_base'], $datos[0]['base']);
            if (mysqli_connect_errno()) {
                die('Error de Conexión externa.');
            }
        } elseif (!empty($id_panel)) {
            $this->id_panel = $id_panel;
        }
    }

    public function query($sql)
    {
        $datos = array();
        $this->registros = 0;
        $resultado = mysqli_query(db::$mysqli[$this->id_panel], $sql);
        if ($resultado && $resultado !== true) {
            $this->registros = $resultado->num_rows;
            while ($row = mysqli_fetch_assoc($resultado)) {
                $datos[] = $row;
            }
            mysqli_free_result($resultado);
        }
        return $datos;
    }

    public function id_insert()
    {
        return db::$mysqli[$this->id_panel]->insert_id;
    }

    public function registros()
    {
        return $this->registros;
    }
}