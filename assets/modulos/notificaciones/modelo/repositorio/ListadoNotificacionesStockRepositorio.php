<?php

class ListadoNotificacionesStockRepositorio
{
    protected $conn;
    protected $table = 'listado_notificaciones_stock';

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function hasNotificacionStock($producto, $email): bool
    {
        $query = /** @lang string */
            "SELECT count(*) as total FROM {$this->table} WHERE id_producto = %d AND email = '%s' AND notificado = 0 LIMIT 1;";

        $query = sprintf($query, addslashes($producto), addslashes($email));
        $result = $this->conn->query($query);
        $result = array_shift($result);
        return intval($result['total']) > 0;
    }

    public function getSearch(array $filters = [], array $orderBy = []): array
    {
        if (empty($orderBy)) {
            $orderBy['id'] = "id desc";
        }

        if (!empty($filters)) {
            if (!empty($filters['email'])) {
                $filters['email'] = sprintf("email = '%s'", addslashes($filters['email']));
            }
            if (!empty($filters['id_librador'])) {
                $filters['id_librador'] = sprintf("id_librador = %d", addslashes($filters['id_librador']));
            }
            if (!empty($filters['id_producto'])) {
                $filters['id_producto'] = sprintf("id_producto = %d", addslashes($filters['id_producto']));
            }
            if (!empty($filters['notificado'])) {
                $filters['notificado'] = sprintf("notificado = %d", addslashes($filters['notificado']));
            }
            $query = /** @lang string */
                "SELECT * FROM {$this->table} WHERE %s ORDER BY %s";
            $query = sprintf($query, implode(' AND ', $filters), implode(',', $orderBy));
        } else {
            $query = /** @lang string */
                "SELECT * FROM {$this->table} ORDER BY %s";
            $query = sprintf($query, implode(',', $orderBy));
        }

        return $this->conn->query($query);
    }

    public function addNotificacion(array $columns, array $values): int
    {
        $query = /** @lang string */
            "INSERT INTO {$this->table} (%s) VALUES (%s);";
        $query = sprintf($query, implode(',',$columns), implode(',',$values));
        $this->conn->query($query);
        return $this->conn->id_insert();
    }

}